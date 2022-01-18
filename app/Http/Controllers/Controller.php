<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function mailer (Request $request) {
        $sender_name = $request->name;
        $sender_email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = 'potteryshedgiftcertificates@gmail.com'; // YOUR gmailemail
        $mail->Password = 'rycziV-8hogjy-pingax'; // YOUR gmail password
        $mail->setFrom('potteryshedgiftcertificates@gmail.com', 'RSIT Admin');
        // $mail->addAddress('admin@thepotteryshed.com.au', 'Admin');
        $mail->addAddress('pajicdejan09@gmail.com', 'Admin');
        // $mail->AddCC($sender_email, $sender_name);
        $mail->addReplyTo($sender_email, $sender_name); // to set the reply to
    
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = 'Customer name: '.$sender_name.'<br />'.'Customer email address: '.$sender_email.'<br />'.$message;
    
        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
        $mail->send();
        return redirect('/')->with('status', 'ok');

        
        
    }
}
