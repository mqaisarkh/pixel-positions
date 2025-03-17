<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Http\Requests\StorejobRequest;
use App\Http\Requests\UpdatejobRequest;
use App\Models\Tag;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all()->groupBy('featured');
    
        return view('jobs.index', [
            'featuredJobs' => $jobs[0],
            'jobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorejobRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejobRequest $request, job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(job $job)
    {
        //
    }
}
