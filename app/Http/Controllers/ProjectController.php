<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{


    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public  function __construct( ProjectRepository $repository, ProjectService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    public function index() {
        return $this->repository->findWhere(['owner_id' => Authorizer::getResourceOwnerId() ]);
    }

    public function store( Request $request) {
        return $this->service->create($request->all());
    }

    public function show($id) {

        if ( $this->checkProjectPermissions($id ) == false ) {
            return  ['error' => 'Acesso Negado' ];
        }
        return $this->repository->find($id);
    }

    public function destroy($id)
    {

        if ( count( self::show($id) ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            if ( count($this->repository->with(['project'])->findWhere(['id' => $id])) > 0 ) {
                return [
                    'error' => true,
                    'message' => 'Este Cliente tem Projetos'
                ];
            } else {
                return $this->repository->delete( $id);
            }
        }
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id );
    }

    private function checkProjectOwner( $projectId ){

        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember( $projectId ){

        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions( $projectId ) {
        if ( $this->checkProjectOwner( $projectId) or $this->checkProjectMember($projectId)) {
            return true;
        }
        return false;
    }
}
