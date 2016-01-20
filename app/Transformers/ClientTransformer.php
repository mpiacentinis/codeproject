<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 17/01/16
 * Time: 21:48
 */

namespace CodeProject\Transformers;
use CodeProject\Entities\Client;
use CodeProject\Presenters\ProjectDadosPresenter;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projects'];
    
    public function transform( Client $client ) {
        return [
            'client_id'         => $client->id,
            'name'              => $client->name,
            'responsible'       => $client->responsible,
            'email'             => $client->email,
            'phone'             => $client->phone,
            'address'           => $client->address,
            'obs'               => $client->obs,
        ];
    }

    public function includeProjects( Client $client ) {
        return $this->collection($client->project, new ProjectDadosTransformer() );
    }

}