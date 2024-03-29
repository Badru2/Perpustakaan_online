<x-app-layout>
    <div class="py-12">
        <div class="w-4/5 p-5 mx-auto bg-white shadow-md">
            <div>
                <div class="flex">
                    <div class="w-1/2">
                        <img src="{{ asset('/storage/cover/' . $buku->cover) }}" alt="" class="mx-auto">
                    </div>
                    <div class="w-1/2 p-5 space-y-3">
                        <h1 class="text-3xl font-bold">{{ $buku->judul }}</h1>
                        <div>
                            <p>Penulis : <b>{{ $buku->penulis }}</b></p>
                            <p>Penerbit : <b>{{ $buku->penerbit }}</b></p>
                            <p>Tahun Terbit : <b>{{ $buku->tahunTerbit }}</b></p>
                            <p>Genre : <b>{{ $buku->kategoriBukus->nama }}</b></p>
                            <a class="m-2 text-xl cursor-pointer " onclick="like({{ $buku->id }}, this)">
                                <iconify-icon
                                    icon="{{ $buku->is_liked() ? 'material-symbols-light:favorite' : 'material-symbols:favorite-outline' }}"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h1 class="text-2xl font-bold">Sinopsis :</h1>
                    <p>{{ $buku->sinopsis }}</p>
                </div>
            </div>

            @if ($bukusPenulis->contains('penulis', $buku->penulis))
                <div class="py-5">
                    <h1 class="py-2 text-2xl font-bold">Dari Penulis yang sama</h1>
                    <div class="box-content flex flex-row w-full space-x-3 overflow-x-auto">
                        @foreach ($bukusPenulis as $data)
                            <div
                                class="p-2 transition duration-500 delay-75 bg-white min-w-52 max-w-52 hover:bg-slate-500 hover:text-white">
                                <a href="{{ route('show.buku', $data->id) }}">
                                    <img src="{{ asset('/storage/cover/' . $data->cover) }}" alt=""
                                        class="object-cover w-full h-40">
                                    <p class="py-2">{{ $data->judul }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($bukusPenerbit->contains('penerbit', $buku->penerbit))
                <div>
                    <h1 class="py-2 text-2xl font-bold">Dari Penerbit yang sama</h1>
                    <div class="box-content flex flex-row w-full space-x-3 overflow-x-auto">
                        @foreach ($bukusPenerbit as $data)
                            <div
                                class="p-2 transition duration-500 delay-75 bg-white min-w-52 max-w-52 hover:bg-slate-500 hover:text-white">
                                <a href="{{ route('show.buku', $data->id) }}">
                                    <img src="{{ asset('/storage/cover/' . $data->cover) }}" alt=""
                                        class="object-cover w-full h-40">
                                    <p class="py-2">{{ $data->judul }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($bukusKategori->contains('kategori_bukus_id', $buku->kategori_bukus_id))
                <div>
                    <h1 class="py-2 text-2xl font-bold">Genre <b>{{ $buku->kategoriBukus->nama }}</b> Lainnya</h1>
                    <div class="box-content flex flex-row w-full space-x-3 overflow-x-auto">
                        @foreach ($bukusKategori as $data)
                            <div
                                class="p-2 transition duration-500 delay-75 bg-white min-w-52 max-w-52 hover:bg-slate-500 hover:text-white">
                                <a href="{{ route('show.buku', $data->id) }}">
                                    <img src="{{ asset('/storage/cover/' . $data->cover) }}" alt=""
                                        class="object-cover w-full h-40">
                                    <p class="py-2">{{ $data->judul }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
