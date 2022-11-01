<x-guest-layout>
    <body class="antialiased">
        @if (Route::has('login'))
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    @auth
                        <a href="{{ route('dashboard') }}" class="navbar-brand">Anasayfa</a>
                    @else
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a href="{{ route('login') }}" class="nav-link active" aria-current="page">Giriş
                                    Yap</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link" aria-current="page">Kayıt Ol</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth
            </nav>
        @endif
        {{-- <div
            class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline">Anasayfa</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Giriş
                            Yap</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Kayıt Ol</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div> --}}

        <div class="card mt-5">
            <div class="card-body text-center">
                <h1 class="mb-4">Yazılım Geliştirme Laboratuvarı I</h1>
                <h2 class="mb-4">STAJ / IME TAKİP ve DEĞERLENDİRME SİSTEMİ</h2>
                <p class="mb-4">Proje kapsamında kullanıcı girdilerine bağlı, dinamik olarak doküman (PDF)
                    oluşturabilen bir sistemin geliştirilmesi beklenmektedir. Kullanıcı bilgileri; staj
                    başvurusunda talep edilen öğrenci bilgileri, firma bilgileri, açık adres ve iletişim
                    bilgileridir. Bu bilgilerin kullanılması suretiyle dinamik bir başvuru dokümanı
                    oluşturulması ve oluşturulan bu doküman üzerinden staj başvuru işlemlerinin
                    yürütülmesi amaçlanmaktadır.
                </p>
            </div>
        </div>
    </body>
</x-guest-layout>
