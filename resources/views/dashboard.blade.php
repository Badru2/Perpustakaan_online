<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid w-full grid-cols-4 gap-3 overflow-hidden shadow-sm">
                @foreach ($bukus as $buku)
                    <div
                        class="p-3 transition duration-500 delay-75 bg-white shadow-md me-2 hover:bg-slate-500 hover:text-white">
                        <a href="{{ route('show.buku', $buku->id) }}">
                            <img src="{{ asset('/storage/cover/' . $buku->cover) }}" alt=""
                                class="object-cover w-full h-64">
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
