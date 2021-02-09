<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use SoapClient;



use DB;

class Sms{

    public function sendSms($message, $mobile){
        try{
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");

            $paramArray = array(
                'userName'        => "01980340482",
                'userPassword'    => "957e9d8234",
                'mobileNumber'	  => $mobile,
                'smsText'     	  => $message,
                'type'            => "1",
                'maskName'        => '',
                'campaignName'    => '',
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));
            //echo $value->OneToOneResult;
        }
        catch (Exception $e) {
            //return $e->getMessage();
        }
    }

}
