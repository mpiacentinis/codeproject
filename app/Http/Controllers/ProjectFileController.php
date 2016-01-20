<?php

namespace CodeProject\Http\Controllers;

use Carbon\Carbon;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;
use Illuminate\Http\Request;


class ProjectFileController extends Controller
{


    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectFileService
     */
    private $service;

    public  function __construct( ProjectFileRepository $repository, ProjectFileService $service){

        $this->repository = $repository;
        $this->service = $service;
    }
    public function index($id) {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store( Request $request, $id ) {

        $file = $request->file('file');
        $original_name = $file->getClientOriginalName();
        $original_extension = $file->getClientOriginalExtension();
        $date_upload = Carbon::now();
        $name = hash('md5', $original_name.$date_upload );
        $data['original_name'] = $original_name;
        $data['original_extension'] = $original_extension;
        $data['name'] = $name;
        $data['extension'] = $original_extension;
        $data['file'] = $file;
        $data['description'] = $request->description;
        $data['project_id'] = $id;

        return $this->service->createFile( $data );
    }

    public function show($id, $fileId) {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $fileId]);
    }

    public function destroy($id, $fileId)
    {
        $arquivos = self::show($id, $fileId);
        if ( count( $arquivos  ) == 0 ) {
            return [
                'error' => true,
                'message' => 'Nao encontrado'
            ];
        } else {
            return $this->service->destroyFile( $arquivos );
        }
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id );
    }
}

