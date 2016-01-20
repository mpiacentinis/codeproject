<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 17/01/16
 * Time: 21:48
 */

namespace CodeProject\Transformers;
use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    
    public function transform( User $user ) {
        return [
            'user_id'           => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
        ];
    }

}