<x-app-layout title='Staj'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('Staj') }} </h2>
    </x-slot>

    @if ($staj != null)
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ogrenci.stajpatch', $staj->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h4 class="text-center">Staj Bilgileri</h4>

                    <div class="mb-3">
                        <label for="ogrenci_ad_soyad" class="form-label">Ad Soyad</label>
                        <input type="text" class="form-control" id="ogrenci_ad_soyad" name="ogrenci_ad_soyad"
                            value="{{ $staj->name . ' ' . $staj->surname }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="ogrenci_sicil_no" class="form-label">Öğrenci Numarası</label>
                        <input type="text" class="form-control" id="ogrenci_sicil_no" name="ogrenci_sicil_no"
                            value="{{ $staj->ogrenci_sicil_no }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_telefon" class="form-label">Öğrenci Telefon</label>
                        <input type="text" class="form-control" id="ogrenci_telefon" name="ogrenci_telefon"
                            value="{{ $staj->ogrenci_telefon }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_eposta" class="form-label">Öğrenci Eposta</label>
                        <input type="text" class="form-control" id="ogrenci_eposta" name="ogrenci_eposta"
                            value="{{ $staj->ogrenci_eposta }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_adres" class="form-label">Öğrenci Adres</label>
                        <input type="text" class="form-control" id="ogrenci_adres" name="ogrenci_adres"
                            value="{{ $staj->ogrenci_adres }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_il" class="form-label">Öğrenci İl</label>
                        <input type="text" class="form-control" id="ogrenci_il" name="ogrenci_il"
                            value="{{ $staj->ogrenci_il }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_ilce" class="form-label">Öğrenci İlçe</label>
                        <input type="text" class="form-control" id="ogrenci_ilce" name="ogrenci_ilce"
                            value="{{ $staj->ogrenci_ilce }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_posta_kod" class="form-label">Öğrenci Posta kodu</label>
                        <input type="text" class="form-control" id="ogrenci_posta_kod" name="ogrenci_posta_kod"
                            value="{{ $staj->ogrenci_posta_kodu }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma" class="form-label">Firma</label>
                        <input type="text" class="form-control" id="firma" name="firma"
                            value="{{ $staj->firma }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_faaliyet_alani" class="form-label">Firma Faaliyet Alanı</label>
                        <input type="text" class="form-control" id="firma_faaliyet_alani" name="firma_faaliyet_alani"
                            value="{{ $staj->firma_faaliyet_alani }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_adres" class="form-label">Firma Adres</label>
                        <input type="text" class="form-control" id="firma_adres" name="firma_adres"
                            value="{{ $staj->firma_adres }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_il" class="form-label">Firma İl</label>
                        <input type="text" class="form-control" id="firma_il" name="firma_il"
                            value="{{ $staj->firma_il }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_ilce" class="form-label">Firma İlçe</label>
                        <input type="text" class="form-control" id="firma_ilce" name="firma_ilce"
                            value="{{ $staj->firma_ilce }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_posta_kod" class="form-label">Firma Posta kodu</label>
                        <input type="text" class="form-control" id="firma_posta_kod" name="firma_posta_kod"
                            value="{{ $staj->firma_posta_kodu }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_telefon" class="form-label">Firma Telefon</label>
                        <input type="text" class="form-control" id="firma_telefon" name="firma_telefon"
                            value="{{ $staj->firma_telefon }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_fax" class="form-label">Firma Fax</label>
                        <input type="text" class="form-control" id="firma_fax" name="firma_fax"
                            value="{{ $staj->firma_fax }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_eposta" class="form-label">Firma Eposta</label>
                        <input type="text" class="form-control" id="firma_eposta" name="firma_eposta"
                            value="{{ $staj->firma_eposta }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="staj_tipi" class="form-label">Staj Tipi</label>
                        <input type="text" class="form-control" id="staj_tipi" name="staj_tipi"
                            value="{{ $staj->staj_tipi }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="yil_donem" class="form-label">Yıl Dönem</label>
                        <input type="text" class="form-control" id="yil_donem" name="yil_donem"
                            value="{{ $staj->yil_donem }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                        <input type="text" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi"
                            value="{{ date('d/m/Y', strtotime($staj->baslangic_tarihi)) }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                        <input type="text" class="form-control" id="bitis_tarihi" name="bitis_tarihi"
                            value="{{ date('d/m/Y', strtotime($staj->bitis_tarihi)) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="gun_sayisi" class="form-label">Gün Sayısı</label>
                        <input type="text" class="form-control" id="gun_sayisi" name="gun_sayisi"
                            value="{{ $staj->gun_sayisi }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="onay_durumu" class="form-label">Başvuru Onay Durumu</label>
                        <input type="text" class="form-control" id="onay_durumu" name="onay_durumu"
                            value="{{ $staj->onay_durumu }}" disabled>
                    </div>
                    @if ($staj->onayli_staj_basvurusu)
                        <p>
                            <a href="{{ $staj->onayli_staj_basvurusu }}" target="_blank">
                                <b>Onaylı Staj Başvuru Kabul Formu </b>
                            </a>
                        </p>
                    @else
                        <div class="mb-3">
                            <label for="onayli_staj_basvurusu" class="form-label">Onaylı Staj Başvuru Kabul Formu
                                Yükle</label>
                            <input class="form-control" type="file" id="onayli_staj_basvurusu"
                                name="onayli_staj_basvurusu"
                                accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.obt,.pdf">
                        </div>
                    @endif

                    @if (in_array($staj->onay_durumu, ['Kabul Edildi']))

                        <div class="mb-3">
                            <label for="belge_durumu" class="form-label">Belge Durumu</label>
                            <input type="text" class="form-control" id="belge_durumu" name="belge_durumu"
                                value=@if ($staj->staj_raporu && $staj->staj_degerlendirme_formu && $staj->staj_devlet_katki_payi == null) "Sadece Devlet Katkı Payı Eksik"
                            @elseif ($staj->staj_raporu && $staj->staj_degerlendirme_formu && $staj->staj_devlet_katki_payi)
                                "Bütün Belgeler Tam"
                            @else
                                "Eksik" @endif
                                disabled>
                        </div>

                        @if ($staj->staj_raporu)
                            <p>
                                <a href="{{ $staj->staj_raporu }}" target="_blank">
                                    <b>Staj Raporu</b>
                                </a>
                            </p>
                        @else
                            <div class="mb-3">
                                <label for="staj_raporu" class="form-label">Staj Raporunu Yükle</label>
                                <input class="form-control" type="file" id="staj_raporu" name="staj_raporu"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.obt,.pdf">
                            </div>
                        @endif


                        @if ($staj->staj_degerlendirme_formu)
                            <p>
                                <a href="{{ $staj->staj_degerlendirme_formu }}" target="_blank">
                                    <b>Staj Değerlendirme Formu</b>
                                </a>
                            </p>
                        @else
                            <div class="mb-3">
                                <label for="staj_degerlendirme_formu" class="form-label">Staj Değerlendirme Formunu
                                    Yükle</label>
                                <input class="form-control" type="file" id="staj_degerlendirme_formu"
                                    name="staj_degerlendirme_formu"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.obt,.pdf">
                            </div>
                        @endif

                        @if ($staj->staj_devlet_katki_payi)
                            <p>
                                <a href="{{ $staj->staj_devlet_katki_payi }}" target="_blank">
                                    <b>Devlet Katkı Payı</b>
                                </a>
                            </p>
                        @else
                            <div class="mb-3">
                                <label for="staj_devlet_katki_payi" class="form-label">Devlet Katkı Payı Formunu
                                    Yükle</label>
                                <input class="form-control" type="file" id="staj_devlet_katki_payi"
                                    name="staj_devlet_katki_payi"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.obt">
                            </div>
                        @endif


                    @endif
                    @if ($staj->ogretmen_id != null)
                        <div class="mb-3">
                            <label for="ogretmen_id" class="form-label">Öğretmen</label>
                            <input type="text" class="form-control" id="ogretmen_id" name="ogretmen_id"
                                value="{{ $ogretmen->name . ' ' . $ogretmen->surname }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="not" class="form-label">Not</label>
                            <input type="text" class="form-control" id="not" name="not"
                                value="{{ $staj->not ? $staj->not : 'Girilmedi' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="kabul_edilen_gun_sayisi" class="form-label">Kabul Edilen Gün Sayısı</label>
                            <input type="text" class="form-control" id="kabul_edilen_gun_sayisi"
                                name="kabul_edilen_gun_sayisi"
                                value="{{ $staj->kabul_edilen_gun_sayisi ? $staj->kabul_edilen_gun_sayisi : 'Girilmedi' }}"
                                disabled>
                        </div>
                    @endif
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Stajı Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <p class="text-center">Sisteme dahil değilsiniz veya izniniz olmayan bir staj başvurusunu görüntülemeye
                    çalışıyorsunuz. Lütfen Sistem Yöneticisi ile iletişime geçiniz.
                </p>
            </div>
        </div>
    @endif
</x-app-layout>
