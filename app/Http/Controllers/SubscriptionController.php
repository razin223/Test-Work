<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\User;
use App\Website;

class SubscriptionController extends Controller {

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), Subscription::$Validator, Subscription::$ValidationMessage);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $Website = Website::where('website', $request->website)->first();
        $User = User::where('email', $request->email)->first();
        
        
        $Checking = Subscription::where('user_id',$User->id)->where('website_id',$Website->id)->first();
        
        if($Checking != null){
            return response()->json(['error' => ['User already subscribed.']], 401);
        }

        $Data = new Subscription();
        $Data->user_id = $User->id;
        $Data->website_id = $Website->id;
        $Data->save();



        return response()->json(['status' => true, 'success' => "User subscription completed to {$Website->website}."], 200);
    }

}
