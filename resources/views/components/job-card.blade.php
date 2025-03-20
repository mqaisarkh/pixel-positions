@props(['job'])

<x-panel class="flex flex-col text-center">

    <div class="self-start text-sm">{{ $job->employer->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
            <a href="/jobs/{{ $job->id }}">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm mt-4"> {{ $job->salary }} </p>
    </div>

    <div class="flex justify-between item-center mt-auto">
        <div class="space-x-1 flex items-center">

            @foreach ($job->tags as $tag )
                <x-tag :$tag size="small"/>
            @endforeach
            
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>

</x-panel>