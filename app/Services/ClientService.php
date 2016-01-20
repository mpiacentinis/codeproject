<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 08/01/16
 * Time: 20:18
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{

    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientValidator
     */
    private $validator;

    public  function __construct( ClientRepository $repository, ClientValidator $validator ){

        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create( array $data ) {

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch( ValidatorException $e ) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update( array $data, $id ) {

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch( ValidatorException $e ) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }
}