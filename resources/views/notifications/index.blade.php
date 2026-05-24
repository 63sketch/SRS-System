<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Notifications</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        @foreach($notifications as $n)<div>{{ $n->title }}: {{ $n->message }}</div>@endforeach
    </div></div></div>
</x-app-layout>
