<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 17/01/16
 * Time: 21:48
 */

namespace CodeProject\Transformers;
use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['clients', 'owners', 'members'];

    public function transform( Project $project ) {
        return [
            'project_id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'project' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
        ];
    }
    public function includeOwners( Project $project) {
        return $this->item($project->owner, new UserTransformer() );
    }

    public function includeMembers( Project $project) {
        return $this->collection($project->member, new ProjectMemberTransformer() );
    }

    public function includeClients( Project $project) {
        return $this->item($project->client, new ClientTransformer() );
    }

}