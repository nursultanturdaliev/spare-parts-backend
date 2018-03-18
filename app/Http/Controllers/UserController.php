<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/10/18
 * Time: 10:14 PM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;

class UserController extends \Laravel\Lumen\Routing\Controller
{
    public function register(Request $request)
    {
        $credentials = json_decode($request->getContent(), true);
        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::findByEmail($credentials['email']);
        if ($user != null) {
            return response()->json([], 409);
        }

        User::create($credentials);

        return response()->json([], 201);
    }

    public function reset(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $email = $content['email'];

        $user = User::findByEmail($email);

        if (!$user instanceof User) {
            return new JsonResponse([], 200);
        }

        $password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
        $password = substr(str_shuffle($password_string), 0, 12);

        $text             = "Ваш новый пароль - $password";
        $mail             = new PHPMailer(); // create a n
        $mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "your email@gmail.com";
        $mail->Password = "parol";
        $mail->SetFrom("your email@gmail.com", 'Tetik DB');
        $mail->Subject = "Test Subject";
        $mail->Body    = $text;
        $mail->AddAddress($user->email, "$user->firstname $user->lastname");
        if ($mail->Send()) {

            $user->update([
                'password' => Hash::make($password)
            ]);
            return 'Email Sent Successfully';
        } else {
            return 'Failed to Send Email';
        }
    }
}