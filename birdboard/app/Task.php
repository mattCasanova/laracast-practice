<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    /**
     * Update the project relationship when this task is updated
     */
    protected $touches = ['project'];

    /**
     * Ensure fetched data is of the correct type
     */
    protected $casts = [
        'completed' => 'boolean'
    ];
    
    public function complete()
    {   
        $this->update(['completed' => true]);
        $this->project->recordActivity('completed_task');
    }

    public function incomplete()
    {   
        $this->update(['completed' => false]);
        $this->project->recordActivity('incompleted_task');
    }

    public function project() 
    {
        return $this->belongsTo(Project::class);
    }

    public function path() 
    {
        return "{$this->project->tasksPath()}/{$this->id}";
    }
}
