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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased  overflow-hidden ">
    <div class="min-h-screen dark:text-gray-100 dark:bg-slate-800 text-gray-900 bg-slate-50 ">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-slate-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex justify-center max-w-7xl m-auto p-5 gap-5" {{ $attributes->merge(['class' => '']) }}>
            @include('layouts.menu')
            <div id="scrollable-component"
                class=" grow basis-[800px] max-w-[1024px]  overflow-scroll no-scrollbar h-[calc(100vh-64px)] ">
                {{ $slot }}
            </div>
            {{-- <x-sidebar :users='$users'></x-sidebar> --}}
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cible l'élément scrollable (modifie l'ID si nécessaire)
            const scrollableComponent = document.getElementById('scrollable-component');


            // Restaurer la position du scroll sur l'élément scrollable
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition && scrollableComponent && window.location.href === sessionStorage.getItem(
                    'pageBefore')) {
                scrollableComponent.scrollTo(0, parseInt(scrollPosition));
                //loguer l'url de la page
                console.log(sessionStorage.getItem(
                    'pageBefore'));
            }

            // Sauvegarder la position du scroll avant de quitter la page
            window.addEventListener('beforeunload', function() {
                if (scrollableComponent) {
                    sessionStorage.setItem('scrollPosition', scrollableComponent.scrollTop);
                    sessionStorage.setItem('pageBefore', window.location.href);
                }
            });
        });




        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".edit-btn").forEach((button) => {

                button.addEventListener("click", function() {
                    const commentId = this.dataset.commentId;
                    const form = document.querySelector(`#edit-form-${commentId}`);
                    const comment = document.querySelector(`#comment-${commentId}`);
                    comment.classList.toggle("hidden"); // Cache ou affiche le commentaire
                    form.classList.toggle("hidden"); // Cache ou affiche le formulaire
                });
            });
        });
    </script>

</body>

</html>
