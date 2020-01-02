<?php

namespace Yegobox\Referral\Observers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Yegobox\Referral\Models\Referral;
use Yegobox\Referral\Models\ReferralCode;

class ReferralModelObserver
{
    /**
     * Handle the model "created" event.
     *
     * @param $user
     * @return void
     * @throws \Exception
     */
    public function created($user)
    {
        Log::debug("debugCode:".request()->get('referral_code'));
        $model = ReferralCode::where('code',request()->get('referral_code'))->first();
        if($model){
            $referral =  Referral::where('owner_id',$model->owner_id)->first();
            if(!$referral){
                $referral = new Referral();
            }
            $referral->owner_id = $model->owner_id;
            if(config('referral.default_strategy') =='points'){
                $referral->point_earned +=  config('referral.strategies.points.earn');
            }
            else if(config('referral.default_strategy') =='cash'){
                $referral->amount_earned += config('referral.strategies.cash.earn');
            }else{
                throw new \Exception('invalid referral strategy');
            }
            $referral->save();

        }

    }
}
