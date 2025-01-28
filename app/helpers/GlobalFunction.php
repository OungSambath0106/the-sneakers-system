<?php

namespace App\helpers;

use App\Models\Notification;
use App\Models\PlasGate;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GlobalFunction
{
    public static function sendOTP($to,$otp){

        $plasGate   = PlasGate::first();
        $privateKey = $plasGate->private_key;
        $secretKey  = $plasGate->secret_key;
        $sender     = 'SMS Test';
        $url = "https://cloudapi.plasgate.com/rest/send?private_key=$privateKey";

        try {

            $response = Http::withHeaders([
                'X-Secret'     => $secretKey,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'sender'      => $sender,
                'to'          => $to,
                'content'     =>'Your OTP is'. $otp,
                'dlr'         => 'yes',
                'dlr_method'  => 'GET',
            ]);

            $responseBody = $response->json();

            return $responseBody;
        } catch (\Exception $e) {
            Log::error('SMS Sending Failed: ' . $e->getMessage());

            return false;
        }
    }

    public static function periodDate($startDate,$endDate,$day = true,$interval='1 day'){
        $begin = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        if($day){
            $end = $end->modify('+1 day');
        }
        $interval = \DateInterval::createFromDateString($interval);
        $period = new \DatePeriod($begin, $interval, $end);
        return $period;
    }

    public static function storeNotification($type, $id)
    {
        $notification                            = new Notification;
        $notification->notificationable_type     = $type;
        $notification->notificationable_id       = $id;
        $notification->save();
    }

    public static function countNotification($model)
    {
        // dd($model);
        // $notification_count = 0;
        // if ($model == 'Transaction') {
        //     // $notification_count = Notification::commentable()
        // }

        $notification_count = Notification::where('is_seen', 0)
                                ->when(($model == 'Transaction'), function ($query) {
                                    return $query->where('notificationable_type', 'App\Models\Transaction');
                                })
                                ->when(($model == 'ContactUs'), function ($query) {
                                    return $query->where('notificationable_type', 'App\Models\ContactUs');
                                })
                                ->when(($model == 'Comment'), function ($query) {
                                    return $query->where('notificationable_type', 'App\Models\Comment');
                                })
                                ->count();
        return $notification_count;
    }
    public static function seenNotification($model)
    {
        Notification::where('is_seen', 0)
            ->where('notificationable_type', $model)
            ->update(['is_seen' => 1]);

    }
}
