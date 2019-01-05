<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('myPDF', $data);
        
        return $pdf->stream('recibo.pdf');
    }
    public function viewPDF()
    {
        return view('myPDF');
    }
    
    public function sendNotification($title = 'Título', $message = 'Mensaje', $token = "cbbUs2EP7cU:APA91bHWE7gWVDOssSPqu-NhmdtPBm_0TWsnhJ6kTLh-0zkn-C_IM8ccEYJcZXDVjjIluXBs2m_H6rcppqkRnb8cadqrjxI-tBksZDaD_bueeEYDVkdpHcYpuXUeYA7K6bqtKOs_Qkxz")
    {
        
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "cbbUs2EP7cU:APA91bHWE7gWVDOssSPqu-NhmdtPBm_0TWsnhJ6kTLh-0zkn-C_IM8ccEYJcZXDVjjIluXBs2m_H6rcppqkRnb8cadqrjxI-tBksZDaD_bueeEYDVkdpHcYpuXUeYA7K6bqtKOs_Qkxz";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        //return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:errror) - in production you should remove from your database the tokens
        return "Listooo " . Str::uuid();
    }
}
