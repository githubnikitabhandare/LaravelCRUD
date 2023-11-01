<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class SendMailController extends Controller
{
    public function sendMailWithAttachment(Request $request)
    {
        $data["email"] = "nikitabhandare20@gmail.com";
        $data["title"] = "Techsolutionstuff";
        $data["body"] = "This is test mail with attachment";
 
        // $files = [
        //     public_path('images/1688618762.jpg'),
        //     //public_path('attachments/test_pdf.pdf'),
        // ];
  
        Mail::send('mail.test_mail', $data, function($message)use($data) {
            $message->to($data["email"])
                    ->subject($data["title"]);
 
            // foreach ($files as $file){
            //     $message->attach($file);
            // }            
        });

        echo "Mail send successfully !!";
    }
}