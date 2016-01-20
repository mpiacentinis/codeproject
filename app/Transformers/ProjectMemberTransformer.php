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

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform( User $member ) {
        return [
            'member_id' => $member->id,
            'name'      => $member->name,
        ];
    }

}