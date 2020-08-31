<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    //
    public function info(Request $request){
        try {
            $userId = $request->route('user_id');
            $judgements = User::find($userId)->educations()->get();
            return response()->json(['judgements' => $judgements], 200);
        }catch (\Exception $e){
            return response()->json(['message'=>'Unable to select judgements' , 'error' => $e->getTraceAsString()],400);
        }
    }
}
