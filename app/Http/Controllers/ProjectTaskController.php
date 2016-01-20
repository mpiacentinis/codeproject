<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{


    /**
     * @var ProjectTaskRepository
     */
    private $repository;
    /**
     * @var ProjectTaskService
     */
    private $service;

    public  function __construct( ProjectTaskRepository $repository, ProjectTaskService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    public function index($id) {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store( Request $request) {
        return $this->service->create($request->all());
    }

    public function show($id, $taskId) {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);
    }

    public function destroy($id, $taskId)
    {

        if ( count( self::show($id, $taskId) ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            $this->repository->delete( $taskId);
            return [
                'error' => true,
                'message' => 'Nota '.$taskId.' do Projeto Excluido'
            ];
        }
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id );
    }
}
