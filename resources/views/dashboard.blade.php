<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm grid grid-cols-4 gap-3 w-full">
                @foreach ($bukus as $buku)
                    <div
                        class="p-3 bg-white shadow-md me-2 hover:bg-slate-500 hover:text-white duration-500 transition delay-75">
                        <a href="{{ route('show.buku', $buku->id) }}">
                            <img src="{{ asset('/storage/cover/' . $buku->cover) }}" alt=""
                                class="h-64 object-cover w-full">
                        </a>
                        <p class="py-2 font-bold">
                            <a href="{{ route('show.buku', $buku->id) }}">{{ $buku->judul }}</a>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
