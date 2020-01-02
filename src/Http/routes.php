<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Yegobox\Referral\Mail\ReferralMail;

Route::get('generate_referral_code',function (){

    $model =\Yegobox\Referral\Models\ReferralCode::where('owner_id',request()->user()->id)->first();
    if($model){
        return env('APP_URL').'/'.config('referral.registration_end_point').'&referral_code='.$model->code;
    }
   $result = \Yegobox\Referral\Models\ReferralCode::create([
       'code'=>random_int(1000,5000)+ rand(10,20), //can be imploved!
       'owner_id'=>request()->user()->id
   ]) ;

    return env('APP_URL').'/'.config('referral.registration_end_point').'&referral_code='.$result->code;
})->middleware('web');
Route::get('referrals',function(){
    return \Yegobox\Referral\Models\Referral::where('owner_id',request()->user()->id)->first();
})->middleware('web');;
Route::post('emails',function(){
   $arr = explode(",",request()->get('emails'));
   $clean_arr=[];
   foreach($arr as $single){
    if(!in_array($single,$clean_arr)){
        $clean_arr[]= $single;
        $model =\Yegobox\Referral\Models\ReferralCode::where('owner_id',request()->user()->id)->first();
        if(filter_var($single,FILTER_VALIDATE_EMAIL)){
            Mail::to($single)->send(new ReferralMail(config('referral.registration_end_point').'&referral_code='.$model->code));
        }
    }
   }
})->middleware('web');
