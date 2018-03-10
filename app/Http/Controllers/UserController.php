<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/10/18
 * Time: 10:14 PM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends \Laravel\Lumen\Routing\Controller
{
    public function register(Request $request)
    {
        $credentials = json_decode($request->getContent(), true);
        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::where('email', '=', $credentials['email'])->first();
        if ($user != null) {
            return response()->json([], 409);
        }

        User::create($credentials);

        return response()->json([], 201);
    }
}