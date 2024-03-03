<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="pb-5">
                <h1 class="py-2 text-3xl">Berdasarkan Kategori <b>Action</b></h1>
                <hr>
                <div class="box-content flex flex-row w-full space-x-3 overflow-x-auto">
                    @foreach ($bukus->where('kategori_bukus_id', '1') as $buku)
                        <div
                            class="p-2 transition duration-500 delay-75 bg-white min-w-64 max-w-64 hover:bg-slate-500 hover:text-white">
                            <a href="{{ route('show.buku', $buku->id) }}">
                                <img src="{{ asset('/storage/cover/' . $buku->cover) }}" alt=""
                                    class="object-cover w-full h-40">
                                <p class="py-2">{{ $buku->judul }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h1 class="py-2 text-3xl">Yang Baru Ditambahkan</h1>
                <hr>
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
    </div>
</x-app-layout>
