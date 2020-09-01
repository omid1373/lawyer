<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    //
    public function info(Request $request){
        try {
            $userId = $request->route('user_id');
            $licence = User::find($userId)->educations()->get();
            return response()->json(['licence' => $licence], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Unable to select licences' , 'error' => $e->getTraceAsString()],400);
        }
    }
}
