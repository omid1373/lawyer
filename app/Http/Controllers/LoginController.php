<?php

namespace App\Http\Controllers;

use App\Classes\Authentication;
use App\Classes\CenterAPIParser;
use App\Classes\CenterAPIServiceCall;
use App\Classes\FileUploader;
use App\Classes\OTP;
use App\Models\Competence;
use App\Models\Party;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\User;


class LoginController extends Controller
{
    //
    private $otpObject;

    public function __construct()
    {
        $this->otpObject = new OTP();
    }

    public function sendUserOTP(Request $request)
    {

        $nationalId = $request->input('national_id');
        $licenseNumber = $request->input('license_number');
        $userLogin = Party::where('national_id', $nationalId)
            ->whereHas('user.license', function (Builder $q) use ($licenseNumber) {
                $q->where('license_number', '=', $licenseNumber);
            })
            ->first();
        if (!empty($userLogin)) {
            try {
                return response(['otp' => $this->otpObject->sendOTP($userLogin->mobile_number),
                    'mobile_number' => $userLogin->mobile_number]);
            } catch (Exception $e) {
                return response(['message' => $e->getMessage()], 400);
            }
        } else {
            try{
                $derived_data = new CenterAPIServiceCall($nationalId, $licenseNumber);
                $apiData = (new CenterAPIParser($derived_data))->getParsedData();
                $party = Party::create([
                    'national_id' => $nationalId,
                    'name' => $apiData['name'],
                    'surname' => $apiData['surname'],
                    'father_name' => $apiData['father_name'],
                    'mobile_number' => $apiData['mobile_number']
                ]);
                $user = $party->user()->create([
                    'inquiry_reference' => $apiData['url'],
                    'inquiry_date' => now(),
                ]);
                FileUploader::base64FileUpload($apiData['profile_picture'], $user, 'profilePicture');

                $licence = $user->licence()->create([
                    'educational_purpose' => $apiData['expertise'],
                    'licence_number' => $apiData['licence_number'],
                    'issued_date' => date('Y-m-d', $apiData['issued_date']),
                    'expiration_date' => date('Y-m-d', $apiData['expiration_date'])
                ]);

                $address = $licence->addresses()->create([
                    'address' => $apiData['address'],
                    'province' => $apiData['province'],
                    'town' => $apiData['town'],
                    'city' => $apiData['city']
                ]);

                $licence->competences()->sync(Competence::find($apiData['competences']));

            } catch (\Exception $e){
                return response(['message' => $e->getMessage()], 400);
            }
        }
    }

    public function validateUserStats(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $otp = $request->input('otp');
        $party = Party::where('mobile_number', $phoneNumber)->first();
        try {
            $isCredentialsValid = $this->otpObject->checkOTP($phoneNumber, $otp);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
        if ($isCredentialsValid) {
            if (!empty($party)) {
                $user = $party->user()->first();
                $token = Authentication::encode(['userId' => $user->id]);
                return response(['token' => $token[0] . '.' . $token[1] . '.' . $token[2]])
                    ->cookie('jwt_header', $token[0], env('TOKEN_EXPIRATION_DURATION'), '/', null, false, true)
                    ->cookie('jwt_payload', $token[1], env('TOKEN_EXPIRATION_DURATION'), '/', null, false, true)
                    ->cookie('jwt_signature', $token[2], env('TOKEN_EXPIRATION_DURATION'), '/', null, false, false);
            } else {
                return response(['message' => 'You should register']);
            }
        }
        return response(['message' => 'Wrong otp for this phone number'], 401);
    }

    public function logOut(Request $request)
    {
        $token = Authentication::decode($request->input('token'));
        return response(['message' => 'Logout successful'], 200)
            ->cookie('jwt_header', $token[0], -1, '/', null, false, true)
            ->cookie('jwt_payload', $token[1], -1, '/', null, false, true)
            ->cookie('jwt_signature', $token[2], -1, '/', null, false, true);
    }
}
