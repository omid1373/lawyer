<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeachingController extends Controller
{
    //
    public function info(Request $request){
        try {
            $userId = $request->route('user_id');
            $teachings = User::find($userId)->teachings()->get();
            return response()->json(['teachings' => $teachings], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Unable to select teachings' , 'error' => $e->getTraceAsString()],400);
        }
    }
}
