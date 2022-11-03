<x-app-layout title='İşletmede Mesleki Eğitim Seçim'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('İşletmede Mesleki Eğitim Yapack Öğrencileri Seç') }}
        </h2>
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
                            <a href="{{ route('yonetici.imesecimget') }}" class="btn btn-secondary">
                                Sıfırla
                            </a>
                        </div>
                    @endif
                </form>
            </div>
            <form action={{route('yonetici.imesecimpost')}} method="POST">
                @csrf
                <table class="table table-bordered table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Seç</th>
                            <th scope="col">Ad</th>
                            <th scope="col">Soyad</th>
                            <th scope="col">Öğrenci Numarası</th>
                            <th scope="col">Bölüm</th>
                            <th scope="col">Sınıf</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ime_adaylari as $aday)
                            <tr>
                                <td scope="row"><input type="checkbox" name="ogrenci_numaralari[]" value={{$aday->id}}></td>
                                <td>
                                    {{ $aday->name ? $aday->name : "-" }}
                                </td>
                                <td>
                                    {{ $aday->surname ? $aday->surname : "-" }}
                                </td>
                                <td>
                                    {{ $aday->ogrenci_sicil_no ? $aday->ogrenci_sicil_no : "-" }}
                                </td>
                                <td>
                                    {{ $aday->bolum ? $aday->bolum : "-" }}
                                </td>
                                <td>
                                    {{ $aday->sinif ? $aday->sinif : "-" }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3">
                    <label for="yil" class="form-label">İME yıl</label>
                    <select class="form-select" name="yil" id="yil" required>
                        @for ($i = 2020; $i < 2050; $i++)
                            <option value="{{ $i }}-{{ $i + 1 }}">
                                {{ $i }}-{{ $i + 1 }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="donem" class="form-label">İME dönem</label>
                    <select class="form-select" name="donem" id="donem" required>
                        <option value="Güz">Güz</option>
                        <option value="Bahar">Bahar</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Öğrenci Seç</button>
                </div>
            </form>
            {{ $ime_adaylari->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
