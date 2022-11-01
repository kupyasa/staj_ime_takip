<x-app-layout title="Kullanıcı Düzenle">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('Kullanıcı Düzenle') }}
        </h2>
    </x-slot>

    <div class="card" x-data="{ sinifAktif: false }">
        <div class="card-body">
            <h5 class="card-title text-center">Kullanıcı Düzenle</h5>
            <form action="{{ route('yonetici.kullanicipatch',$kullanici->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Ad</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $kullanici->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Soyad</label>
                    <input type="text" class="form-control" id="surname" name="surname"
                        value="{{ $kullanici->surname }}" required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_sicil_no" class="form-label">Öğrenci/Sicil Numarası</label>
                    <input type="text" class="form-control" id="ogrenci_sicil_no" name="ogrenci_sicil_no"
                        value="{{ $kullanici->ogrenci_sicil_no }}" required>
                </div>
                <div class="mb-3">
                    <label for="telefon" class="form-label">Telefon Numarası</label>
                    <input type="text" class="form-control" id="telefon" name="telefon"
                        value="{{ $kullanici->telefon }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Eposta Adresi</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $kullanici->email }}" required>
                </div>
                <div class="mb-3">
                    <label for="fakulte" class="form-label">Fakülte</label>
                    <input type="text" class="form-control" id="fakulte" name="fakulte"
                        value="{{ $kullanici->fakulte ? $kullanici->bolum : '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="bolum" class="form-label">Bölüm</label>
                    <input type="text" class="form-control" id="bolum" name="bolum"
                        value="{{ $kullanici->bolum ? $kullanici->bolum : '' }}" required>
                </div>
                <template x-if="sinifAktif">
                    <div class="mb-3" x-if="sinifAktif">
                        <label for="sinif" class="form-label">Sınıf</label>
                        <input type="text" class="form-control" id="sinif" name="sinif"
                            value="{{ $kullanici->sinif ? $kullanici->sinif : '' }}" required>
                    </div>
                </template>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-select" name="rol" id="rol"
                        x-on:change="$event.target.value == 'ogrenci' ? sinifAktif=true : sinifAktif=false">
                        <option value="ogrenci" @if ($kullanici->rol == 'ogrenci') selected @endif>
                            Öğrenci
                        </option>
                        <option value="ogretmen" @if ($kullanici->rol == 'ogretmen') selected @endif>
                            Öğretmen
                        </option>
                        <option value="komisyon" @if ($kullanici->rol == 'komisyon') selected @endif>
                            Komisyon
                        </option>
                        <option value="yonetici" @if ($kullanici->rol == 'yonetici') selected @endif>
                            Yönetici
                        </option>
                    </select>
                </div>
                <div class="text-end my-4 my-2">
                    <button type="submit" class="btn btn-primary">Kullanıcı Düzenle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
