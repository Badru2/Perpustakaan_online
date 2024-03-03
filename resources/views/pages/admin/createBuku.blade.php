<x-app-layout>
    <div class="w-3/4 p-5 mx-auto mt-5 bg-white shadow-md">
        <div class="flex space-x-3">
            {{-- <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
            </button> --}}

            <!-- Modal toggle -->
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah Kategori
            </button>
        </div>

        <form method="POST" action="{{ route('store.buku') }}" class="flex mt-3 space-x-3" enctype="multipart/form-data">
            @csrf
            <div class="w-1/2">
                <input type="file" class="w-full" name="cover" id="selectImage">

                <div class="mt-2">
                    <img id="imagePreview" src="#" alt="your image" class="mx-auto mt-3" style="display:none;" />
                </div>

            </div>

            <div class="w-1/2 space-y-3">
                <input type="text" class="w-full" name="judul" placeholder="Judul">
                <input type="text" class="w-full" name="penulis" placeholder="Penulis">
                <input type="text" class="w-full" name="penerbit" placeholder="Penerbit">
                <input type="date" class="w-full" name="tahunTerbit">
                <select class="w-full" name="kategori_bukus_id" id="">
                    <option>Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button type="submit">Create</button>
            </div>
        </form>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>
        document.getElementById('selectImage').onchange = function(evt) {
            const imagePreview = document.getElementById('imagePreview');

            imagePreview.style.display = 'none';

            const [file] = evt.target.files;

            if (file) {
                const fileURL = URL.createObjectURL(file);

                if (file.type.startsWith('image/')) {
                    // Show image preview
                    imagePreview.src = fileURL;
                    imagePreview.style.display = 'block';
                } else {
                    // Handle other file types as needed
                    console.error('Unsupported file type');
                }
            }
        };
    </script>

    <!-- Dropdown menu -->
    <div id="dropdownDotsHorizontal"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
            <li>
                <a href="#"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
            </li>
        </ul>
        <div class="py-2">
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated
                link</a>
        </div>
    </div>

    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Kategori
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('store.kategori') }}" class="p-4 md:p-5">
                    @csrf
                    <input type="text" name="nama" class="w-full mb-2 rounded-sm" placeholder="Nama Kategori">
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
