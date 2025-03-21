<x-layout>
    <div class="space-y-6">
        
        <x-job-card-wide :$job />

        
    </div>

    <div>
        <p class="mt-6">
            <x-anchor href="/jobs/{{ $job->id }}/edit">Edit Job</x-anchor>
        </p>
    </div>
    

</x-layout>