<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Monolog\Processor\WebProcessor;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');
    
        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title'       => ['required'],
            'salary'      => ['required'],
            'location'    => ['required'],
            'schedule'    => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url'         => ['required', 'active_url'],
            'tags'        => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
           foreach (explode(',', $attributes['tags']) as $tag) {
            $job->tag($tag);
           }
        }
        return redirect()->route('home')->with('posted', 'Job posted successfully.');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function edit(Job $job)
    {
        // authorize
        Gate::authorize('edit', $job);

        // redirect
        return view('jobs.edit', ['job' =>$job]);
    }


    public function update(Request $request, Job $job)
    {
        $attributes = $request->validate([
            'title'    => ['required'],
            'salary'   => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url'      => ['required', 'active_url'],
            'tags'     => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job->update(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
            $job->tags()->detach();
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect()->route('jobs.show', $job->id)
        ->with('updated', 'Job updated successfully.');
    }

    
    public function destroy(Job $job)
    {
        // authorize
        Gate::authorize('destroy', $job);

        // delete the job
        $job->delete();

        // redirect
        return redirect()->route('home')->with('success', 'Job deleted successfully.');
    }

}