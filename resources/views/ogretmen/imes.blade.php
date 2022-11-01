<x-app-layout title='İşletmede Mesleki Eğitim'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('İşletmede Mesleki Eğitim') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
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
                                <a href="{{ route('ogretmen.imesget') }}" class="btn btn-secondary">
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
                        <th scope="col">Yıl-Dönem</th>
                        <th scope="col">Onay Durumu</th>
                        <th scope="col">Başlangıç Tarihi</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($imes as $ime)
                        <tr>
                            <td scope="row">{{ $ime->name . " " . $ime->surname }}</td>
                            <td>{{ $ime->firma }}</td>
                            <td>
                                {{ $ime->yil_donem }}
                            </td>
                            <td>
                                {{ $ime->onay_durumu }}
                            </td>
                            <td>
                                {{ $ime->baslangic_tarihi ? date('d/m/Y', strtotime($ime->baslangic_tarihi)) : '-' }}
                            </td>
                            <td>
                                {{ $ime->bitis_tarihi ? date('d/m/Y', strtotime($ime->bitis_tarihi)) : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('ogretmen.imeget', $ime->id) }}" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i> İME Detayları</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $imes->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
