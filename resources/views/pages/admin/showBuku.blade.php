<x-app-layout>
    <div class="py-12">
        <div class="mx-auto w-4/5 bg-white shadow-md p-5">
            <div class="flex">
                <div class="w-1/2">
                    <img src="{{ asset('/storage/cover/' . $buku->cover) }}" alt="">
                </div>
                <div class="w-1/2 p-5 space-y-3">
                    <h1 class="text-3xl font-bold">{{ $buku->judul }}</h1>
                    <div>
                        <p>Penulis : <b>{{ $buku->penulis }}</b></p>
                        <p>Penerbit : <b>{{ $buku->penerbit }}</b></p>
                        <p>Tahun Terbit : <b>{{ $buku->tahunTerbit }}</b></p>
                        <p>Genre : <b>{{ $buku->kategoriBukus->nama }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
