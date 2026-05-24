<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Job Openings</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        @foreach($jobs as $job)<div>{{ $job->title }} ({{ $job->applicants_count }} applicants)</div>@endforeach
    </div></div></div>
</x-app-layout>
