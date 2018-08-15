<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;

use App\User;

class MailController extends Controller
{
    //
    public function validateEmail($email)
    {
        $count = count(User::where('email', $email)->get());
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->input('email');

        if (!$this->validateEmail($email)) {
            return redirect()->back()->with('email', "Your email does not Match");
        }

        $code = md5($email);

        $user = User::where('email', $email)->get()->first();
        $user->remember_token = $code;
        $user->save();

        $mail = new PHPMailer(); // create a new object

        $url_name = $_SERVER['SERVER_NAME'];
        $link = "http://" . $url_name . "/password/reset/" . $code;
        //print "TEST2";

        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.yandex.ru";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "dumpsterondemand@yandex.ru";
        $mail->Password = "Dod123!@#";
        $mail->SetFrom("dumpsterondemand@yandex.ru");
        $mail->Subject = "Restore Password";
        $mail->Body = "Hello!<br><br>To recover your password, visit $link";
        $mail->AddAddress($email);

        $main_send = $mail->Send();

        if (!$main_send) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
            $json_data = array('code' => -3, 'error' => $mail->ErrorInfo);
            return json_encode($json_data);
        } else {
            return redirect()->back()->with('status', "Send to your email. Please check your inbox.");
        }
    }

    public function reset(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!$validator->fails()) {
            $email = $request->input('email');
            $users = User::where('email', $email)->get();
            if (count($users) > 0) {
                $password = $request->input('password');
                $user = $users->first();
                $user->password = md5($password);
                $user->save();

                return redirect()->route('login');

            } else {
                return redirect()->back()->withErrors(['email', 'The User does not match']);
            }
        } else {
            $error_msg = $validator->errors()->getMessages();
            return redirect()->back()->withInput($data)->withErrors($error_msg);
        }

    }

}
