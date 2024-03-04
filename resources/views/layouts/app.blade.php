<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'node_modules/flowbite/dist/flowbite.min.js'])
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="py-24 mx-auto max-w-7xl">
            {{ $slot }}
        </main>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>
        function like(id, el) {
            fetch('/like/' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status == 'LIKE') {
                        el.innerHTML =
                            '<iconify-icon icon="material-symbols-light:favorite"></iconify-icon>';
                    } else {
                        el.innerHTML =
                            '<div class="text-danger"><iconify-icon icon="material-symbols:favorite-outline"></iconify-icon></div>';
                    }
                });
        }

        document.getElementById('selectImage').onchange = function(evt) {
            const imagePreview = document.getElementById('imagePreview');
            const imagePreview1 = document.getElementById('imagePreview1');

            imagePreview.style.display = 'none';

            const [file] = evt.target.files;

            if (file) {
                const fileURL = URL.createObjectURL(file);

                if (file.type.startsWith('image/')) {
                    // Show image preview
                    imagePreview.src = fileURL;
                    imagePreview.style.display = 'block';
                    imagePreview1.style.display = 'none';
                } else {
                    // Handle other file types as needed
                    console.error('Unsupported file type');
                }
            }
        };
    </script>
</body>

</html>
