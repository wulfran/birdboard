<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function getUrl()
    {
        return route('projects.show', ['project' => $this->id]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
