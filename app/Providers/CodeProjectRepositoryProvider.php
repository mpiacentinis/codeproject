<?php

namespace CodeProject\Providers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Repositories\ClientRepositoryEloquent;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectFileRepositoryEloquent;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectMemberRepositoryEloquent;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectRepositoryEloquent;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Repositories\ProjectNoteRepositoryEloquent;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Repositories\ProjectTaskRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class CodeProjectRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryEloquent::class);
        $this->app->bind(
            ProjectRepository::class,
            ProjectRepositoryEloquent::class);
        $this->app->bind(
            ProjectNoteRepository::class,
            ProjectNoteRepositoryEloquent::class);
        $this->app->bind(
            ProjectTaskRepository::class,
            ProjectTaskRepositoryEloquent::class);
        $this->app->bind(
            ProjectMemberRepository::class,
            ProjectMemberRepositoryEloquent::class);
        $this->app->bind(
            ProjectFileRepository::class,
            ProjectFileRepositoryEloquent::class);
    }

}
