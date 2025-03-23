<x-layout>
    @if(session('updated'))
        <div class="w-1/2 bg-green-500 text-white px-4 py-2 mb-2 rounded-md text-center">
            {{ session('updated') }}
        </div>
    @endif

    <div class="space-y-6">
        <x-job-card-wide :$job />
    </div>

    <div class="mt-6 flex items-center space-x-4 justify-between">
        <!-- Edit Job Button -->
        <div class="space-x-4">
            <x-anchor href="/jobs/{{ $job->id }}/edit">Edit Job</x-anchor>
            <x-anchor href="{{ $job->url }}" target="_blank">Visit Site</x-anchor>
        </div>
        
        <!-- Delete Job Form -->
        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 cursor-pointer">Delete Job</button>
        </form>
    </div>
</x-layout>
