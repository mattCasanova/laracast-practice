<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Project extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function tasksPath() 
    {
        return "{$this->path()}/tasks";
    }

    public function owner(): Relation 
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): Relation 
    {
        return $this->hasMany(Task::class);
    }

    public function addTask(string $body): Task
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity(): Relation
    {
        return $this->hasMany(Activity::class);
    }

    public function recordActivity(string $description): void {
        $this->activity()->create(compact('description'));
    }

}


