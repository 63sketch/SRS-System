<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Analytics Dashboard</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        <h3>Headcount by Department</h3>
        @foreach($headcountByDept as $data)<div>{{ $data->name }}: {{ $data->total }}</div>@endforeach
    </div></div></div>
</x-app-layout>
