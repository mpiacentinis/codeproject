<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 08/01/16
 * Time: 20:18
 */

namespace CodeProject\Services;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectFileService
{


    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectFileValidator
     */
    private $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    public  function __construct( ProjectFileRepository $repository, ProjectFileValidator $validator, Filesystem $filesystem, Storage $storage ){


        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

    public function createFile( array $data ) {

        try {
            $this->validator->with($data)->passesOrFail();
            $this->storage->put($data['name'].'.'.$data['extension'],  $this->filesystem->get($data['file']));
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

    public function destroyFile( $data ) {

        foreach( $data  as $files ){
            $arquivo = $files->name.'.'.$files->extension;
            if( $this->storage->disk()->exists($arquivo) ) {
                $this->storage->disk()->delete( $arquivo );
                $this->repository->delete($files->id);
                return [
                    'error' => true,
                    'message' => 'Arquivo '.$arquivo.' do Projeto Excluido'
                ];
            }
        }

    }
}