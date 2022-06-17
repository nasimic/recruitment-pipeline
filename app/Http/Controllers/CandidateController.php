<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
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

    public function changeStatus(Candidate $candidate, ChangeStatusRequest $request)
    {
        $newStatus = Status::where('id',$request->status_id)->firstOrFail();

        $candidate->status_id = $newStatus->id;

        $candidate->statuses()->attach([
            $newStatus->id => [
                'comment' => $request->comment ?? null
            ]
        ]);

        return CandidateResource::make($candidate->load('statuses'));
    }

    public function getTimeline(Candidate $candidate)
    {
        $timeline = $candidate->statuses()->latest()->get();

        return CandidateResource::collection($timeline);
    }
}
