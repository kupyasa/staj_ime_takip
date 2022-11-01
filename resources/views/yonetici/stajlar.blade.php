<x-app-layout title='Stajlar'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('Stajlar') }} </h2>
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
                            <a href="{{ route('yonetici.stajlarget') }}" class="btn btn-secondary">
                                Sıfırla
                            </a>
                        </div>
                    @endif
                </form>
            </div>
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Öğrenci Ad Soyad</th>
                        <th scope="col">Firma</th>
                        <th scope="col">Staj Tipi</th>
                        <th scope="col">Yıl-Dönem</th>
                        <th scope="col">Onay Durumu</th>
                        <th scope="col">Başlangıç Tarihi</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stajlar as $staj)
                        <tr>
                            <td scope="row">{{ $staj->name . " " . $staj->surname }}</td>
                            <td>{{ $staj->firma }} </td>
                            <td>{{ $staj->staj_tipi  }}</td>
                            <td>
                                {{ $staj->yil_donem  ? $staj->yil_donem  : "-"  }}
                            </td>
                            <td>
                                {{ $staj->onay_durumu  }}
                            </td>
                            <td>
                                {{ $staj->baslangic_tarihi ? date('d/m/Y', strtotime($staj->baslangic_tarihi)) : '-' }}
                            </td>
                            <td>
                                {{ $staj->bitis_tarihi ? date('d/m/Y', strtotime($staj->bitis_tarihi)) : '-' }}
                            </td>
                            <td>
                                <a href="{{route('yonetici.stajget',$staj->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Staj Detayları</a>
                                <form action="{{ route('yonetici.stajdelete', $staj->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger my-2"><i class="bi bi-trash"></i> Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $stajlar->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
