<x-layout>
    <x-page-heading>{{ $job->title }}</x-page-heading>

    <x-forms.form action="/jobs/{{ $job->id }}" method="POST">
         @method('PATCH')

        <x-forms.input label="Title" name="title" value="{{ $job->title}}" />
        <x-forms.input label="Salary" name="salary" value="{{ $job->salary }}" />
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" />

        <x-forms.select label="schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" value="{{ $job->url }}" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured"/>

        <x-forms.divider />

        <x-forms.input label="Tags (comma seperated)" name="tags" value="{{ implode(',', $job->tags->pluck('name')->toArray()) }}" />

        <x-forms.button>Update</x-forms.button>
    </x-forms.form>
</x-layout>