<?php
namespace App\Helpers;
use App\PaymentType;

class MyHelper{
	
	public static function getAuthorizeApiCredentials(){


		// ++++++++++++++test+++++++++++++++++++++
		// $login_id= '3H98caYa';
		// $transaction_key = '622q3v3vTS5AT59V';

		// $api_credentials= array(
		// 	"login_id"=>$login_id,
		// 	"transaction_key"=>$transaction_key
		// );

		// +++++++++++++++++++++live+++++++++++++++++++++
		// $login_id= '43gb7SzVx';
		// $transaction_key = '93Xkmq326Y4w7TLW';

		// $api_credentials= array(
		// 	"login_id"=>$login_id,
		// 	"transaction_key"=>$transaction_key
		// );


		


		$payment_type = PaymentType::where('id',1)->first();
		
		if($payment_type->active_account == "test")
		{
			$login_id = $payment_type->login_id_test;
			$transaction_key = $payment_type->transaction_key_test;
			$account_mode="test";
		}
		else if($payment_type->active_account == "live")
		{
			$login_id = $payment_type->login_id_live;
			$transaction_key = $payment_type->transaction_key_live;
			$account_mode="live";

		}

		$api_credentials= array(
			"login_id"=>$login_id,
			"transaction_key"=>$transaction_key,
			"account_mode"=>$account_mode
		);

		return $api_credentials;

	}
}