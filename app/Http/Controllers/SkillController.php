<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SkillResource;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        
        return SkillResource::collection($skills);
    }
}
