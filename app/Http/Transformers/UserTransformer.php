<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/11/18
 * Time: 2:30 PM
 */

namespace App\Http\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'firstName' => $user->id,
            'lastname'  => $user->lastname
        ];
    }
}