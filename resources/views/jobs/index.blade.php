<x-layout>
    <div class="space-y-10">
        
            @if(session('success'))
                <div class="w-1/2 bg-green-500 text-white px-4 py-2 rounded-md text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('posted'))
                <div class="w-1/2 bg-green-500 text-white px-4 py-2 rounded-md text-center">
                    {{ session('posted') }}
                </div>
            @endif
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl ">Let's Find Your Next Job</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="I'm looking for..." />
            </x-forms.form>
        </section>

        <section class="pt-10">
            <x-section-heading>Featured Jobs</x-section-heading>
    
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach ($featuredJobs as $job)
                    <x-job-card :$job />
                @endforeach
            </div>
    
        </section>
    
        <section>
            <x-section-heading>Tags</x-section-heading>

            <div class="mt-6 space-x-1">
                @foreach ($tags as $tag )
                    <x-tag :$tag />
                @endforeach
                
            </div>

        </section>
    
        <section>
            <x-section-heading>Recent Jobs</x-section-heading>

            <div class="mt-6 space-y-6">

                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
                
            </div>

        </section>

    </div>
</x-layout>