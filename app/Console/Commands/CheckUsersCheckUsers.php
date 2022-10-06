<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Subscription;
use App\SubscriptionBilling;
use Carbon\Carbon;
use Mail;

class CheckUsersCheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkSubscribeBilling:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will regularly check if renewal is made or not';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $today = Carbon::parse($date)->format('Y-m-d H:i:s');

        $order_details=Subscription::where(['status'=>2])->orderBy('id','DESC')->get();
         /*$order_details=Subscription::where(['id'=>1])->first();
         $order_details->sort_1 = 'Mutahir';
         $order_details->save();*/
        foreach($order_details as $order_detail)
        {
            $billing=SubscriptionBilling::where('subscription_id',$order_detail->id)->orderBy('id','DESC')->first();
            $billing_end_date = Carbon::parse($billing->period_end)->format('Y-m-d H:i:s');
            if($today > $billing_end_date)
            {

                $message_body = '<p> Subscription ID: '.$order_detail->id.'
                <br>Billing ID:'.$billing->id.'
                <br>Subscriber Email: '.$order_detail->getUser->email;

                $data = array(
                'firstname'       => $order_detail->getUser->first_name,
                'lastname'        => $order_detail->getUser->last_name,
                'email'           => 'customerservice@dartsinabottle.com',
                'message_body'         => $message_body
                );


                Mail::send('emails.unsubscribe-order-email',  $data, function ($message) use ($data) {
                $message->to($data['email'])
                ->subject('dartsinabottle Subscribtion Period Over Information');
                });

                $subscription_billing                     = new SubscriptionBilling;
                $subscription_billing->subscription_id    = $order_detail->id;
                $subscription_billing->plan_created       = $billing->plan_created;
                $subscription_billing->period_start       = date("Y-m-d H:i:s");
                $subscription_billing->period_end         = date('Y-m-d H:i:s', strtotime("+30 days"));
                $subscription_billing->status             = '1';
                $subscription_billing->save();
            }
        }  
        echo 'Operation Done';
    }
}