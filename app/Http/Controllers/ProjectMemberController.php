<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Services\ProjectMemberService;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{


    /**
     * @var ProjectMemberRepository
     */
    private $repository;
    /**
     * @var ProjectMemberService
     */
    private $service;

    public  function __construct( ProjectMemberRepository $repository, ProjectMemberService $service){

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
