<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomBadgeQuote extends Model
{
    public function getCustomBadgeQuoteFile(){
        return $this->hasMany('App\CustomBadgeQuoteFile','custom_badge_quote_id','id');

    }
}
