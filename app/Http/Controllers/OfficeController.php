<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    //
    public function info(Request $request){
        try {
            $userId = $request->route('user_id');
            $offices = User::find($userId)->offices()->get();
            return response()->json(['offices' => $offices], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Unable to select offices' , 'error' => $e->getTraceAsString()],400);
        }
    }
}
