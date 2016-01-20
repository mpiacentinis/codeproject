<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 08/01/16
 * Time: 21:28
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required',
        'note' => 'required'
    ];
}