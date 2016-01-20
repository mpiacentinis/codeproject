<?php

namespace CodeProject\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ownerProject() {
        return $this->hasMany(Project::class, 'owner_id');
    }

    public function memberProject() {
        return $this->hasMany(ProjectMember::class, 'user_id');
    }

    public function project() {
        //tabela de relacionamento, busca os membros, e lista os usuarios, ( tabela de usuarios, tabela auxiliar, campo de busca na tabela auxiliar, campo de busca na tabela principal )
        return $this->belongsToMany(Project::class, 'project_members', 'user_id', 'project_id');
    }
}
