<x-app-layout>
    <div class="py-12">
        <form action="{{ route('update.buku', $buku->id) }}" method="POST" enctype="multipart/form-data"
            class="flex w-4/5 p-5 mx-auto space-x-3 bg-white shadow-md">
            @csrf
            @method('PUT')
            <div class="relative w-1/2">
                <input type="file" class="w-full" name="cover" id="selectImage">

                <div class="mt-2">
                    <img id="imagePreview1" src="{{ asset('/storage/cover/' . $buku->cover) }}" alt="your image"
                        class="mx-auto mt-3" />
                    <img id="imagePreview" src="#" alt="your image" class="mx-auto mt-3 "
                        style="display:none;" />
                </div>
            </div>
            <div class="w-1/2 space-y-3">
                <input type="text" value="{{ $buku->judul }}" name="judul" placeholder="Judul" class="w-full">
                <input type="text" value="{{ $buku->penulis }}" name="penulis" placeholder="Penulis" class="w-full">
                <input type="text" value="{{ $buku->penerbit }}" name="penerbit" placeholder="Penerbit"
                    class="w-full">
                <input type="date" value="{{ $buku->tahunTerbit }}" name="tahunTerbit" class="w-full">
                <select class="w-full" name="kategori_bukus_id" id="">
                    <option>Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @if ($buku->kategori_bukus_id == $kategori->id) selected @endif>
                            {{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button>Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
