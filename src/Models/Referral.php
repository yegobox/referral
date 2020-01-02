<?php


namespace Yegobox\Referral\Models;


use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referrals';
    protected $fillable = ['owner_id','amount_earned','point_earned'];
}
