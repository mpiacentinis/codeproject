<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function notes() {
        return $this->hasMany(ProjectNote::class);
    }

    public function task() {
        return $this->hasMany(ProjectTask::class);
    }

    public function member() {
        //tabela de relacionamento, busca os membros, e lista os usuarios, ( tabela de usuarios, tabela auxiliar, campo de busca na tabela auxiliar, campo de busca na tabela principal )
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
