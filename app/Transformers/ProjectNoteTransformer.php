<?php
/**
 * Created by PhpStorm.
 * User: mpiacentinis
 * Date: 17/01/16
 * Time: 21:48
 */

namespace CodeProject\Transformers;
use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{
    
    public function transform( ProjectNote $notes ) {
        return [
            'notes_id'          => $notes->id,
            'project_id'        => $notes->project_id,
            'title'             => $notes->title,
            'note'              => $notes->inote,
        ];
    }

}
