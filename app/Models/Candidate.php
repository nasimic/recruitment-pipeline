<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    // for current status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    //for timeline
    public function statuses()
    {
        return $this->belongsToMany(Status::class)
                    ->withPivot('comment')
                    ->withTimestamps();
    }
}
