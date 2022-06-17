<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Status;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();

        return CandidateResource::collection($candidates);
    }

    public function show(Candidate $candidate)
    {
        return CandidateResource::make($candidate);
    }

    public function store(StoreCandidateRequest $request)
    {   
        $initialStatus = Status::default()->first();

        $candidate = Candidate::create($request->validated() + ['status_id'=> $initialStatus->id]);

        if($request->skills){
            $candidate->skills()->attach($request->skills);
        }

        return CandidateResource::make($candidate);
    }

    public function listByStatus($status_id)
    {
        $candidates = Candidate::where('status_id', $status_id)->get();

        return CandidateResource::collection($candidates);
    }
}
