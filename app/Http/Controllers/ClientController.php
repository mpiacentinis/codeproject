<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{


    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    public  function __construct( ClientRepository $repository, ClientService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    public function index() {
        return $this->repository->All();
    }

    public function store( Request $request) {
        return $this->service->create($request->all());
    }

    public function show($id) {
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
            /*

            return $this->repository->with(['project'])->findWhere(['id' => $id]);

            if ( count($this->repository->with(['project'])->findWhere(['client_id' => $id])) > 0 ) {
                return [
                    'error' => true,
                    'message' => 'Este Cliente tem Projetos'
                ];
            } else {
                return $this->repository->delete( $id);
            }*/

            try {
                return $this->repository->delete( $id);
                return ['status' => true, 'message' => 'Projeto excluído com sucesso'];
            } catch (\PDOException $e) {
                return ['status' => false, 'message' => 'Não foi possível excluir o cliente'];
            }
        }
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id );
    }
}
