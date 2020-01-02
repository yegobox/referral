<?php


namespace Yegobox\Referral\Models;


use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    protected $table = 'referral_codes';
    protected $fillable = ['owner_id','code'];
}
