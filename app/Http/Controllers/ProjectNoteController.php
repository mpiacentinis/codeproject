<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{


    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    public  function __construct( ProjectNoteRepository $repository, ProjectNoteService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    public function index($id) {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store( Request $request) {
        return $this->service->create($request->all());
    }

    public function show($id, $noteId) {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
    }

    public function destroy($id, $noteId)
    {

        if ( count( self::show($id, $noteId) ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            $this->repository->delete( $noteId);
            return [
                'error' => true,
                'message' => 'Nota '.$noteId.' do Projeto Excluido'
            ];
        }
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id );
    }
}
