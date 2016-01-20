<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 17/01/16
 * Time: 22:04
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectDadosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectDadosPresenter extends  FractalPresenter
{
    public function getTransformer() {
        return new ProjectDadosTransformer();
    }

}