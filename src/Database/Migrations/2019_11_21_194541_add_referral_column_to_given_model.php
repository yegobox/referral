<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferralColumnToGivenModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('referral.tablename'), function (Blueprint $table) {
            $table->boolean('joined_referral')->default(false)
                ->comment('updated by referral program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('referral.tablename'), function (Blueprint $table) {
            $table->dropColumn('joined_referral');
        });
    }
}
