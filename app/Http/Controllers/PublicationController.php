<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    //
    public function info(Request $request){
        try {
            $userId = $request->route('user_id');
            $publications = User::find($userId)->offices()->get();
            return response()->json(['publications' => $publications], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Unable to select publications' , 'error' => $e->getTraceAsString()],400);
        }
    }
}
