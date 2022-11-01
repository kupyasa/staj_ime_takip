<x-app-layout title='İME Başvurusu Yap'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('İME Başvurusu Yap') }} </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('ogrenci.imebasvurusuyappost')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h4 class="text-center">Öğrenci Bilgileri</h4>
                <div class="mb-3">
                    <label for="fakulte" class="form-label">Fakülte</label>
                    <input type="text" class="form-control" id="fakulte" name="fakulte"
                        value="{{ old('fakulte') }}" required>
                </div>
                <div class="mb-3">
                    <label for="bolum" class="form-label">Bölüm</label>
                    <input type="text" class="form-control" id="bolum" name="bolum" value="{{ old('bolum') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_no" class="form-label">Öğrenci Numarası</label>
                    <input type="text" class="form-control" id="ogrenci_no" name="ogrenci_no"
                        value="{{ old('ogrenci_no') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ad_soyad" class="form-label">Ad Soyad</label>
                    <input type="text" class="form-control" id="ad_soyad" name="ad_soyad"
                        value="{{ old('ad_soyad') }}" required>
                </div>
                <div class="mb-3">
                    <label for="tc_no" class="form-label">TC Kimlik Numarası</label>
                    <input type="text" class="form-control" id="tc_no" name="tc_no" value="{{ old('tc_no') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_telefon" class="form-label">Öğrenci Telefon</label>
                    <input type="tel" class="form-control" id="ogrenci_telefon" name="ogrenci_telefon"
                        value="{{ old('ogrenci_telefon') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_eposta" class="form-label">Öğrenci Eposta</label>
                    <input type="email" class="form-control" id="ogrenci_eposta" name="ogrenci_eposta"
                        value="{{ old('ogrenci_eposta') }}" required>
                </div>
                <div class="mb-3">
                    <label for="iban" class="form-label">IBAN No
                        ZİRAAT BANKASI</label>
                    <input type="text" class="form-control" id="iban" name="iban"
                        value="{{ old('iban') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_adres" class="form-label">Öğrenci Adres</label>
                    <input type="text" class="form-control" id="ogrenci_adres" name="ogrenci_adres"
                        value="{{ old('ogrenci_adres') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_il" class="form-label">İl</label>
                    <input type="text" class="form-control" id="ogrenci_il" name="ogrenci_il"
                        value="{{ old('ogrenci_il') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_ilce" class="form-label">İlçe</label>
                    <input type="text" class="form-control" id="ogrenci_ilce" name="ogrenci_ilce"
                        value="{{ old('ogrenci_ilce') }}" required>
                </div>
                <div class="mb-3">
                    <label for="ogrenci_posta_kod" class="form-label">Posta kodu</label>
                    <input type="text" class="form-control" id="ogrenci_posta_kod" name="ogrenci_posta_kod"
                        value="{{ old('ogrenci_posta_kod') }}" required>
                </div>
                <h4 class="text-center">İşyeri Eğitimi Bilgileri</h4>
                <div class="mb-3">
                    <label for="ime_baslangic" class="form-label">İME Başlangıç Tarihi</label>
                    <input type="date" class="form-control" value="{{ old('ime_baslangic') }}"
                        id="ime_baslangic" name="ime_baslangic" required>
                </div>
                <div class="mb-3">
                    <label for="gun_sayisi" class="form-label">İş Günü</label>
                    <input type="number" class="form-control" id="gun_sayisi" name="gun_sayisi" min="0"
                        value="{{ old('gun_sayisi') }}" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" @if (old('saglik_check')) checked @endif id="saglik_check"
                        name="saglik_check">
                    <label for="saglik_check" class="form-label">Ailemden, Kendimden veya Anne-Baba Üzarinden Genel
                        Sağlık Sigortası Kapsamında Sağlık Hizmeti Alıyorum</label>
                </div>
                <div class="mb-3">
                    <input type="checkbox" @if (old('gss_check')) checked @endif id="gss_check"
                        name="gss_check">
                    <label for="gss_check" class="form-label">Genel Sağlık Sigortası (GSS) (Gelir Testi Yaptırdım
                        Pirim Ödüyorum)</label>
                </div>
                <div class="mb-3">
                    <input type="checkbox" @if (old('yas_25_check')) checked @endif id="yas_25_check"
                        name="yas_25_check">
                    <label for="yas_25_check" class="form-label">25 Yaşını Doldurdum</label>
                </div>
                <h4 class="text-center">İşletmede Mesleki Eğitim Yapılacak Kurum Bilgileri</h4>

                <div class="mb-3">
                    <label for="firma_resmi_ad" class="form-label">Resmi Adı</label>
                    <input type="text" class="form-control" id="firma_resmi_ad" name="firma_resmi_ad"
                        value="{{ old('firma_resmi_ad') }}" required>
                </div>

                <div class="mb-3">
                    <label for="firma_faaliyet_alani" class="form-label">Faaliyet Alanı</label>
                    <input type="text" class="form-control" id="firma_faaliyet_alani" name="firma_faaliyet_alani"
                        value="{{ old('firma_faaliyet_alani') }}" required>
                </div>

                <div class="mb-3">
                    <label for="firma_adres" class="form-label">Adres</label>
                    <input type="text" class="form-control" id="firma_adres" name="firma_adres"
                        value="{{ old('firma_adres') }}" required>
                </div>
                <div class="mb-3">
                    <label for="firma_il" class="form-label">İl</label>
                    <input type="text" class="form-control" id="firma_il" name="firma_il"
                        value="{{ old('firma_il') }}" required>
                </div>
                <div class="mb-3">
                    <label for="firma_ilce" class="form-label">İlçe</label>
                    <input type="text" class="form-control" id="firma_ilce" name="firma_ilce"
                        value="{{ old('firma_ilce') }}" required>
                </div>
                <div class="mb-3">
                    <label for="firma_posta_kod" class="form-label">Posta kodu</label>
                    <input type="text" class="form-control" id="firma_posta_kod" name="firma_posta_kod"
                        value="{{ old('firma_posta_kod') }}" required>
                </div>
                <div class="mb-3">
                    <label for="firma_telefon" class="form-label">Telefon</label>
                    <input type="tel" class="form-control" id="firma_telefon" name="firma_telefon"
                        value="{{ old('firma_telefon') }}" required>
                </div>

                <div class="mb-3">
                    <label for="firma_fax" class="form-label">Fax</label>
                    <input type="text" class="form-control" id="firma_fax" name="firma_fax"
                        value="{{ old('firma_fax') }}" required>
                </div>

                <div class="mb-3">
                    <label for="firma_eposta" class="form-label">Eposta</label>
                    <input type="email" class="form-control" id="firma_eposta" name="firma_eposta"
                        value="{{ old('firma_eposta') }}" required>
                </div>

                <div class="mb-3">
                    <label for="sorumlu_unvan" class="form-label">İşyeri Sorumlusunun Unvanı</label>
                    <select class="form-select" name="sorumlu_unvan" id="sorumlu_unvan" required>
                        <option value="Mühendis" selected>
                            Mühendis</option>
                        <option value="Teknik Öğretmen">
                            Teknik Öğretmen</option>
                        <option value="Hekim">
                            Hekim</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">İME Başvurusu Yap</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
