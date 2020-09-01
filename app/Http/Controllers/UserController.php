<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function info(Request $request){
        try {
            $userId = $request->route('user_id');
            $party = User::find($userId)->party()->first();
            return response()->json(['user_party' => $party], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Unable to select party' , 'error' => $e->getTraceAsString()],400);
        }
    }
}
