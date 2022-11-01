<x-app-layout title='Kullanıcılar'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('Kullanıcılar') }} </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form class="row d-flex justify-content-between"" method="GET" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="col">
                        <input type="text" name="search" placeholder="Ara" class="form-control"
                            value="{{ request()->get('search') }}">
                    </div>
                    @if (request()->get('search'))
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('yonetici.kullanicilarget') }}" class="btn btn-secondary">
                                Sıfırla
                            </a>
                        </div>
                    @endif
                </form>
            </div>
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">Eposta</th>
                        <th scope="col">Telefon Numarası</th>
                        <th scope="col">Fakülte</th>
                        <th scope="col">Bölüm</th>
                        <th scope="col">Rol</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kullanicilar as $kullanici)
                        <tr>
                            <td scope="row">{{ $kullanici->name . ' ' . $kullanici->surname }}</td>
                            <td>{{ $kullanici->email }}</td>
                            <td>{{ $kullanici->telefon }}</td>
                            <td>
                                {{ $kullanici->fakulte }}
                            </td>
                            <td>
                                {{ $kullanici->bolum }}
                            </td>
                            @if ($kullanici->rol == 'ogrenci')
                                <td>Öğrenci</td>
                            @elseif($kullanici->rol == 'ogretmen')
                                <td>Öğretmen</td>
                            @elseif($kullanici->rol == 'komisyon')
                                <td>Komisyon</td>
                            @elseif($kullanici->rol == 'yonetici')
                                <td>Yönetici</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>
                                <a href="{{ route('yonetici.kullaniciget', $kullanici->id) }}"
                                    class="btn btn-primary"><i class="bi bi-pencil-square"></i> Kullanıcı Detayları</a>
                                <form action="{{ route('yonetici.kullanicidelete', $kullanici->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger my-2"><i class="bi bi-trash"></i> Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $kullanicilar->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
