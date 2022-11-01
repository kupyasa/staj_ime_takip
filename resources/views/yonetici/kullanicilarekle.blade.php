<x-app-layout title="Kullanıcılar Ekle">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('Kullanıcılar Ekle') }}
        </h2>
    </x-slot>

    <div class="card" x-data="{ sinifAktif: true }">
        <div class="card-body">
            <h5 class="card-title text-center">Yeni Kullanıcılar Ekle</h5>
            <h5 class="card-title text-center">Kullanıcıları virgül (',') ile ayırınız.</h5>
            <form action="{{ route('yonetici.kullanicilareklepost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="red_nedeni" class="form-label">Ad Soyad</label>
                    <textarea class="form-control" id="ad_soyad" name="ad_soyad" rows="3" style="resize:vertical"></textarea>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_sicil_no" class="form-label">Öğrenci/Sicil Numarası</label>
                    <textarea class="form-control" id="ogrenci_sicil_no" name="ogrenci_sicil_no" rows="3" style="resize:vertical"></textarea>
                </div>
                <div class="mb-3">
                    <label for="telefon" class="form-label">Telefon Numarası</label>
                    <textarea class="form-control" id="telefon" name="telefon" rows="3" style="resize:vertical"></textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Eposta Adresi</label>
                    <textarea class="form-control" id="email" name="email" rows="3" style="resize:vertical"></textarea>
                </div>
                <div class="mb-3">
                    <label for="fakulte" class="form-label">Fakülte</label>
                    <input type="text" class="form-control" id="fakulte" name="fakulte" required>
                </div>
                <div class="mb-3">
                    <label for="bolum" class="form-label">Bölüm</label>
                    <input type="text" class="form-control" id="bolum" name="bolum" required>
                </div>
                <template x-if="sinifAktif">
                    <div class="mb-3" x-if="sinifAktif">
                        <label for="sinif" class="form-label">Sınıf</label>
                        <input type="text" class="form-control" id="sinif" name="sinif" required>
                    </div>
                </template>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-select" name="rol" id="rol"
                        x-on:change="$event.target.value == 'ogrenci' ? sinifAktif=true : sinifAktif=false">
                        <option value="ogrenci" selected>
                            Öğrenci
                        </option>
                        <option value="ogretmen">
                            Öğretmen
                        </option>
                        <option value="komisyon">
                            Komisyon
                        </option>
                        <option value="yonetici">
                            Yönetici
                        </option>
                    </select>
                </div>
                <div class="text-end my-4 my-2">
                    <button type="submit" class="btn btn-primary">Kullanıcıları Ekle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
