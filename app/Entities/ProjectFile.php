<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'original_name',
        'original_extension',
        'name',
        'extension',
        'description',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

}
