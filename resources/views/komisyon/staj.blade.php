<x-app-layout title='Staj'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('Staj') }} </h2>
    </x-slot>

    @if ($staj != null)
        <div class="card">
            <div class="card-body">
                <form action="{{ route('stajbilgileriindirpost') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" class="form-control" id="ogrenci_ad_soyad" name="ogrenci_ad_soyad"
                        value="{{ $staj->name . ' ' . $staj->surname }}">


                    <input type="hidden" class="form-control" id="ogrenci_sicil_no" name="ogrenci_sicil_no"
                        value="{{ $staj->ogrenci_sicil_no }}">


                    <input type="hidden" class="form-control" id="ogrenci_telefon" name="ogrenci_telefon"
                        value="{{ $staj->ogrenci_telefon }}">


                    <input type="hidden" class="form-control" id="ogrenci_eposta" name="ogrenci_eposta"
                        value="{{ $staj->ogrenci_eposta }}">


                    <input type="hidden" class="form-control" id="ogrenci_adres" name="ogrenci_adres"
                        value="{{ $staj->ogrenci_adres }}">


                    <input type="hidden" class="form-control" id="ogrenci_il" name="ogrenci_il"
                        value="{{ $staj->ogrenci_il }}">


                    <input type="hidden" class="form-control" id="ogrenci_ilce" name="ogrenci_ilce"
                        value="{{ $staj->ogrenci_ilce }}">

                    <input type="hidden" class="form-control" id="ogrenci_posta_kodu" name="ogrenci_posta_kodu"
                        value="{{ $staj->ogrenci_posta_kodu }}">



                    <input type="hidden" class="form-control" id="firma" name="firma"
                        value="{{ $staj->firma }}">



                    <input type="hidden" class="form-control" id="firma_faaliyet_alani" name="firma_faaliyet_alani"
                        value="{{ $staj->firma_faaliyet_alani }}">



                    <input type="hidden" class="form-control" id="firma_adres" name="firma_adres"
                        value="{{ $staj->firma_adres }}">


                    <input type="hidden" class="form-control" id="firma_il" name="firma_il"
                        value="{{ $staj->firma_il }}">


                    <input type="hidden" class="form-control" id="firma_ilce" name="firma_ilce"
                        value="{{ $staj->firma_ilce }}">


                    <input type="hidden" class="form-control" id="firma_posta_kodu" name="firma_posta_kodu"
                        value="{{ $staj->firma_posta_kodu }}">


                    <input type="hidden" class="form-control" id="firma_telefon" name="firma_telefon"
                        value="{{ $staj->firma_telefon }}">



                    <input type="hidden" class="form-control" id="firma_fax" name="firma_fax"
                        value="{{ $staj->firma_fax }}">



                    <input type="hidden" class="form-control" id="firma_eposta" name="firma_eposta"
                        value="{{ $staj->firma_eposta }}">



                    <input type="hidden" class="form-control" id="staj_tipi" name="staj_tipi"
                        value="{{ $staj->staj_tipi }}">



                    <input type="hidden" class="form-control" id="yil_donem" name="yil_donem"
                        value="{{ $staj->yil_donem }}">



                    <input type="hidden" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi"
                        value="{{ date('d/m/Y', strtotime($staj->baslangic_tarihi)) }}">



                    <input type="hidden" class="form-control" id="bitis_tarihi" name="bitis_tarihi"
                        value="{{ date('d/m/Y', strtotime($staj->bitis_tarihi)) }}">


                    <input type="hidden" class="form-control" id="gun_sayisi" name="gun_sayisi"
                        value="{{ $staj->gun_sayisi }}">


                    <input type="hidden" class="form-control" id="onay_durumu_text" name="onay_durumu_text"
                        value="{{ $staj->onay_durumu }}">


                    @if ($ogretmen != null)
                        <input type="hidden" class="form-control" id="ogretmen_ad_soyad" name="ogretmen_ad_soyad"
                            value="{{ $ogretmen->name . ' ' . $ogretmen->surname }}">
                    @else
                        <input type="hidden" class="form-control" id="ogretmen_ad_soyad" name="ogretmen_ad_soyad"
                            value="Yok">
                    @endif


                    <input type="hidden" class="form-control" id="not_text" name="not_text"
                        value="{{ $staj->not ? $staj->not : 'Girilmedi' }}">



                    <input type="hidden" class="form-control" id="kabul_edilen_gun_sayisi_text"
                        name="kabul_edilen_gun_sayisi_text"
                        value="{{ $staj->kabul_edilen_gun_sayisi ? $staj->kabul_edilen_gun_sayisi : 'Girilmedi' }}">


                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success">PDF Halinde İndir</button>
                    </div>
                </form>
                <form action="{{ route('komisyon.stajpatch', $staj->id) }}" method="post"
                    enctype="multipart/form-data">
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
                        <input type="text" class="form-control" id="firma_faaliyet_alani"
                            name="firma_faaliyet_alani" value="{{ $staj->firma_faaliyet_alani }}" disabled>
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
                        <label for="onay_durum_text" class="form-label">Başvuru Onay Durumu</label>
                        <input type="text" class="form-control" id="onay_durumu_text" name="onay_durumu_text"
                            value="{{ $staj->onay_durumu }}" disabled>
                    </div>
                    @if ($staj->onayli_staj_basvurusu)
                        <p>
                            <a href="{{ $staj->onayli_staj_basvurusu }}" target="_blank">
                                <b>Onaylı Staj Başvuru Kabul Formu </b>
                            </a>
                        </p>

                        <div class="mb-3">
                            <label for="onay_durumu" class="form-label">Başvuru Onay Durumu</label>
                            <select class="form-select" name="onay_durumu" id="onay_durumu">
                                <option value="Kabul Edildi" selected>
                                    Kabul Edildi</option>
                                <option value="Reddedildi">
                                    Reddedildi</option>
                            </select>
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
                        @endif


                        @if ($staj->staj_degerlendirme_formu)
                            <p>
                                <a href="{{ $staj->staj_degerlendirme_formu }}" target="_blank">
                                    <b>Staj Değerlendirme Formu</b>
                                </a>
                            </p>
                        @endif

                        @if ($staj->staj_devlet_katki_payi)
                            <p>
                                <a href="{{ $staj->staj_devlet_katki_payi }}" target="_blank">
                                    <b>Devlet Katkı Payı</b>
                                </a>
                            </p>
                        @endif

                        @if ($ogretmen != null)
                            <div class="mb-3">
                                <label for="ogretmen" class="form-label">Öğretmen</label>
                                <input type="text" class="form-control" id="ogretmen" name="ogretmen"
                                    value="{{ $ogretmen->name . ' ' . $ogretmen->surname }}" disabled>
                            </div>
                        @endif

                        @if ($staj->staj_degerlendirme_formu != null && $staj->staj_raporu != null)
                            <div class="mb-3">
                                <label for="ogretmen_id" class="form-label">Öğretmen Ata</label>
                                <select class="form-select" name="ogretmen_id" id="ogretmen_id" required>
                                    @foreach ($ogretmenler as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name . ' ' . $item->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="not_text" class="form-label">Not</label>
                            <input type="text" class="form-control" id="not_text" name="not_text"
                                value="{{ $staj->not ? $staj->not : 'Girilmedi' }}" disabled>
                        </div>

                        @if ($ogretmen != null && auth()->user()->id == $ogretmen->id)
                            <div class="mb-3">
                                <label for="not" class="form-label">Not</label>
                                <select class="form-select" name="not" id="not">
                                    <option value="Başarılı" selected>
                                        Başarılı</option>
                                    <option value="Başarısız">
                                        Başarısız</option>
                                    <option value="Eksik">
                                        Eksik</option>
                                </select>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="kabul_edilen_gun_sayisi_text" class="form-label">Kabul Edilen Gün
                                Sayısı</label>
                            <input type="text" class="form-control" id="kabul_edilen_gun_sayisi_text"
                                name="kabul_edilen_gun_sayisi_text"
                                value="{{ $staj->kabul_edilen_gun_sayisi ? $staj->kabul_edilen_gun_sayisi : 'Girilmedi' }}"
                                disabled>
                        </div>

                        @if ($ogretmen != null && auth()->user()->id == $ogretmen->id)
                            <div class="mb-3">
                                <label for="kabul_edilen_gun_sayisi" class="form-label">Kabul Edilen Gün
                                    Sayısı</label>
                                <input type="number" class="form-control" id="kabul_edilen_gun_sayisi"
                                    name="kabul_edilen_gun_sayisi"
                                    value="{{ $staj->kabul_edilen_gun_sayisi ? $staj->kabul_edilen_gun_sayisi : 'Girilmedi' }}">
                            </div>
                        @endif
                    @endif

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Stajı Güncelle</button>
                    </div>
                </form>
                <form class="text-end" action="{{ route('stajdosyalarinisil', $staj->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <button class="btn btn-danger my-2"><i class="bi bi-trash"></i>Staja ait Dosyaları Sil</button>
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
