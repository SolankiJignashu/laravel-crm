<?php

namespace App\Http\Controllers;

use App\Mail\CompanyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public static function sendCompanyEmail($data){
        $to = $data['email'];
        Mail::to($to)->send(new CompanyEmail($data));

        /**
         * Check if the email has been sent successfully, or not.
         * Return the appropriate message.
         */
        if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";
    }
}
