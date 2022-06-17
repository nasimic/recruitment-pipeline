<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    // inverse of current status
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function scopeDefault($query)
    {
        $query->where('is_default', 1);
        return $query;
    }
}
