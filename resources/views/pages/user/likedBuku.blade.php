<x-app-layout>
    <div class="w-full pb-12 mx-auto space-y-3 bg-gray-100 xl:w-3/6 dark:bg-gray-700 ">
        @foreach ($bukus as $buku)
            <p>{{ $buku->judul }}</p>
        @endforeach
    </div>
</x-app-layout>
