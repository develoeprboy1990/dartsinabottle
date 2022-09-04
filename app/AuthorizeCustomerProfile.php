<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizeCustomerProfile extends Model
{
    public function getAuthorizeTranscationDetail()
    {
        return $this->hasOne('App\AuthorizeTransactionDetail','authorize_customer_profile_id','id');
    }
}
