<?php


namespace App\Classes;
use App\Models\Otp as Model;

class OTP
{
    private function hash($otp){
        return md5(strval($otp * 4 - 1));
    }
    public function sendOTP($phoneNumber){
        if(!preg_match('/^09[0-9]{9}$/', $phoneNumber))
            throw new \Exception('Invalid phone number!');
        $randomNumber = rand(10000, 99999);
        Model::create([
            'mobile_number' => $phoneNumber,
            'verification_code' => $this->hash($randomNumber)
        ]);
        $send_verification = new VerificationCodeClass('87a7542bda9eb9d0ae35542b', 'dq_s9S<{A4E`T(b^');
//        $send_verification->VerificationCode($randomNumber, $phoneNumber);
        return $randomNumber;
    }

    public function checkOTP($phoneNumber, $otp){
        if(!preg_match('/^09[0-9]{9}$/', $phoneNumber))
            throw new \Exception('Invalid phone number!');
        if(!preg_match('/^[0-9]{5}$/', $otp))
            throw new \Exception('Invalid OTP structure!');

        $expiration_time = date('Y-m-d h:i:s', time() - 120);
        $record = Model::where('mobile_number', $phoneNumber)
            ->whereRaw("created_at > '$expiration_time'")
            ->orderBy('created_at', 'desc')->first();
        if(is_null($record))
            return false;
        $hash = $this->hash(intval($otp));
        return $record->verification_code === $hash;
    }}
