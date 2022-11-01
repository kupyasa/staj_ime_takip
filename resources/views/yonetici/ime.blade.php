<x-app-layout title='İşletmede Meslek Eğitimi'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">{{ __('İşletmede Meslek Eğitimi') }}
        </h2>
    </x-slot>

    @if ($ime != null)
        <div class="card">
            <div class="card-body">
                <form action="{{ route('imebilgileriindirpost') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" class="form-control" id="ogrenci_ad_soyad" name="ogrenci_ad_soyad"
                        value="{{ $ime->name . ' ' . $ime->surname }}">


                    <input type="hidden" class="form-control" id="ogrenci_sicil_no" name="ogrenci_sicil_no"
                        value="{{ $ime->ogrenci_sicil_no }}">


                    <input type="hidden" class="form-control" id="ogrenci_telefon" name="ogrenci_telefon"
                        value="{{ $ime->ogrenci_telefon }}">


                    <input type="hidden" class="form-control" id="ogrenci_eposta" name="ogrenci_eposta"
                        value="{{ $ime->ogrenci_eposta }}">


                    <input type="hidden" class="form-control" id="ogrenci_adres" name="ogrenci_adres"
                        value="{{ $ime->ogrenci_adres }}">


                    <input type="hidden" class="form-control" id="ogrenci_il" name="ogrenci_il"
                        value="{{ $ime->ogrenci_il }}">


                    <input type="hidden" class="form-control" id="ogrenci_ilce" name="ogrenci_ilce"
                        value="{{ $ime->ogrenci_ilce }}">

                    <input type="hidden" class="form-control" id="ogrenci_posta_kodu" name="ogrenci_posta_kodu"
                        value="{{ $ime->ogrenci_posta_kodu }}">



                    <input type="hidden" class="form-control" id="firma" name="firma"
                        value="{{ $ime->firma }}">



                    <input type="hidden" class="form-control" id="firma_faaliyet_alani" name="firma_faaliyet_alani"
                        value="{{ $ime->firma_faaliyet_alani }}">



                    <input type="hidden" class="form-control" id="firma_adres" name="firma_adres"
                        value="{{ $ime->firma_adres }}">


                    <input type="hidden" class="form-control" id="firma_il" name="firma_il"
                        value="{{ $ime->firma_il }}">


                    <input type="hidden" class="form-control" id="firma_ilce" name="firma_ilce"
                        value="{{ $ime->firma_ilce }}">


                    <input type="hidden" class="form-control" id="firma_posta_kodu" name="firma_posta_kodu"
                        value="{{ $ime->firma_posta_kodu }}">


                    <input type="hidden" class="form-control" id="firma_telefon" name="firma_telefon"
                        value="{{ $ime->firma_telefon }}">



                    <input type="hidden" class="form-control" id="firma_fax" name="firma_fax"
                        value="{{ $ime->firma_fax }}">



                    <input type="hidden" class="form-control" id="firma_eposta" name="firma_eposta"
                        value="{{ $ime->firma_eposta }}">


                    <input type="hidden" class="form-control" id="yil_donem" name="yil_donem"
                        value="{{ $ime->yil_donem ? $ime->yil_donem : 'Yok' }}">



                    <input type="hidden" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi"
                        value="{{ date('d/m/Y', strtotime($ime->baslangic_tarihi)) }}">



                    <input type="hidden" class="form-control" id="bitis_tarihi" name="bitis_tarihi"
                        value="{{ date('d/m/Y', strtotime($ime->bitis_tarihi)) }}">


                    <input type="hidden" class="form-control" id="gun_sayisi" name="gun_sayisi"
                        value="{{ $ime->gun_sayisi }}">


                    <input type="hidden" class="form-control" id="onay_durumu_text" name="onay_durumu_text"
                        value="{{ $ime->onay_durumu }}">


                    @if ($ogretmen != null)
                        <input type="hidden" class="form-control" id="ogretmen_ad_soyad" name="ogretmen_ad_soyad"
                            value="{{ $ogretmen->name . ' ' . $ogretmen->surname }}">
                    @else
                        <input type="hidden" class="form-control" id="ogretmen_ad_soyad" name="ogretmen_ad_soyad"
                            value="Yok">
                    @endif


                    <input type="hidden" class="form-control" id="not_text" name="not_text"
                        value="{{ $ime->not ? $ime->not : 'Girilmedi' }}">



                    <input type="hidden" class="form-control" id="kabul_edilen_gun_sayisi_text"
                        name="kabul_edilen_gun_sayisi_text"
                        value="{{ $ime->kabul_edilen_gun_sayisi ? $ime->kabul_edilen_gun_sayisi : 'Girilmedi' }}">


                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success">PDF Halinde İndir</button>
                    </div>
                </form>
                <form action="{{ route('yonetici.imepatch', $ime->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h4 class="text-center">İME Bilgileri</h4>
                    <div class="mb-3">
                        <label for="ogrenci_ad_soyad" class="form-label">Ad Soyad</label>
                        <input type="text" class="form-control" id="ogrenci_ad_soyad" name="ogrenci_ad_soyad"
                            value="{{ $ime->name . ' ' . $ime->surname }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="ogrenci_sicil_no" class="form-label">Öğrenci Numarası</label>
                        <input type="text" class="form-control" id="ogrenci_sicil_no" name="ogrenci_sicil_no"
                            value="{{ $ime->ogrenci_sicil_no }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_telefon" class="form-label">Öğrenci Telefon</label>
                        <input type="text" class="form-control" id="ogrenci_telefon" name="ogrenci_telefon"
                            value="{{ $ime->ogrenci_telefon }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_eposta" class="form-label">Öğrenci Eposta</label>
                        <input type="text" class="form-control" id="ogrenci_eposta" name="ogrenci_eposta"
                            value="{{ $ime->ogrenci_eposta }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_adres" class="form-label">Öğrenci Adres</label>
                        <input type="text" class="form-control" id="ogrenci_adres" name="ogrenci_adres"
                            value="{{ $ime->ogrenci_adres }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_il" class="form-label">Öğrenci İl</label>
                        <input type="text" class="form-control" id="ogrenci_il" name="ogrenci_il"
                            value="{{ $ime->ogrenci_il }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_ilce" class="form-label">Öğrenci İlçe</label>
                        <input type="text" class="form-control" id="ogrenci_ilce" name="ogrenci_ilce"
                            value="{{ $ime->ogrenci_ilce }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="ogrenci_posta_kod" class="form-label">Öğrenci Posta kodu</label>
                        <input type="text" class="form-control" id="ogrenci_posta_kod" name="ogrenci_posta_kod"
                            value="{{ $ime->ogrenci_posta_kodu }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma" class="form-label">Firma</label>
                        <input type="text" class="form-control" id="firma" name="firma"
                            value="{{ $ime->firma }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_faaliyet_alani" class="form-label">Firma Faaliyet Alanı</label>
                        <input type="text" class="form-control" id="firma_faaliyet_alani"
                            name="firma_faaliyet_alani" value="{{ $ime->firma_faaliyet_alani }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_adres" class="form-label">Firma Adres</label>
                        <input type="text" class="form-control" id="firma_adres" name="firma_adres"
                            value="{{ $ime->firma_adres }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_il" class="form-label">Firma İl</label>
                        <input type="text" class="form-control" id="firma_il" name="firma_il"
                            value="{{ $ime->firma_il }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_ilce" class="form-label">Firma İlçe</label>
                        <input type="text" class="form-control" id="firma_ilce" name="firma_ilce"
                            value="{{ $ime->firma_ilce }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_posta_kod" class="form-label">Firma Posta kodu</label>
                        <input type="text" class="form-control" id="firma_posta_kod" name="firma_posta_kod"
                            value="{{ $ime->firma_posta_kodu }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="firma_telefon" class="form-label">Firma Telefon</label>
                        <input type="text" class="form-control" id="firma_telefon" name="firma_telefon"
                            value="{{ $ime->firma_telefon }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_fax" class="form-label">Firma Fax</label>
                        <input type="text" class="form-control" id="firma_fax" name="firma_fax"
                            value="{{ $ime->firma_fax }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="firma_eposta" class="form-label">Firma Eposta</label>
                        <input type="text" class="form-control" id="firma_eposta" name="firma_eposta"
                            value="{{ $ime->firma_eposta }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="yil_donem" class="form-label">Yıl Dönem</label>
                        <input type="text" class="form-control" id="yil_donem" name="yil_donem"
                            value="{{ $ime->yil_donem }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                        <input type="text" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi"
                            value="{{ date('d/m/Y', strtotime($ime->baslangic_tarihi)) }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                        <input type="text" class="form-control" id="bitis_tarihi" name="bitis_tarihi"
                            value="{{ date('d/m/Y', strtotime($ime->bitis_tarihi)) }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="gun_sayisi" class="form-label">Gün Sayısı</label>
                        <input type="text" class="form-control" id="gun_sayisi" name="gun_sayisi"
                            value="{{ $ime->gun_sayisi }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="onay_durumu" class="form-label">Başvuru Onay Durumu</label>
                        <input type="text" class="form-control" id="onay_durumu" name="onay_durumu"
                            value="{{ $ime->onay_durumu }}" disabled>
                    </div>
                    @if ($ime->onayli_ime_basvurusu)
                        <p>
                            <a href="{{ $ime->onayli_ime_basvurusu }}" target="_blank">
                                <b>Onaylı İME Başvuru Kabul Formu</b>
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

                    @if (in_array($ime->onay_durumu, ['Kabul Edildi']))


                        <div class="mb-3">
                            <label for="belge_durumu" class="form-label">Belge Durumu</label>
                            <input type="text" class="form-control" id="belge_durumu" name="belge_durumu"
                                value=@if ($ime->ime_raporu && $ime->ime_degerlendirme_formu) "Bütün Belgeler Tam"
                    @else
                        "Eksik" @endif
                                disabled>
                        </div>

                        @if ($ime->ime_raporu)
                            <p>
                                <a href="{{ $ime->ime_raporu }}" target="_blank">
                                    <b>İME Raporu</b>
                                </a>
                            </p>
                        @endif


                        @if ($ime->ime_degerlendirme_formu)
                            <p>
                                <a href="{{ $ime->ime_degerlendirme_formu }}" target="_blank">
                                    <b>İME Değerlendirme Formu</b>
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

                        @if ($ime->ime_raporu != null && $ime->ime_degerlendirme_formu != null)
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

                        @if ($ime->ime_denetleme_raporu)
                            <p>
                                <a href="{{ $ime->ime_denetleme_raporu }}" target="_blank">
                                    <b>İME Denetleme Raporu</b>
                                </a>
                            </p>
                        @endif

                        @if ($ogretmen != null && auth()->user()->id == $ogretmen->id)
                            <div class="mb-3">
                                <label for="ime_denetleme_raporu" class="form-label">İME Denetleme Raporunu
                                    Yükle</label>
                                <input class="form-control" type="file" id="ime_denetleme_raporu"
                                    name="ime_denetleme_raporu"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.obt,.pdf">
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="not_text" class="form-label">Not</label>
                            <input type="text" class="form-control" id="not_text" name="not_text"
                                value="{{ $ime->not ? $ime->not : 'Girilmedi' }}" disabled>
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
                                value="{{ $ime->kabul_edilen_gun_sayisi ? $ime->kabul_edilen_gun_sayisi : 'Girilmedi' }}"
                                disabled>
                        </div>

                        @if ($ogretmen != null && auth()->user()->id == $ogretmen->id)
                            <div class="mb-3">
                                <label for="kabul_edilen_gun_sayisi" class="form-label">Kabul Edilen Gün
                                    Sayısı</label>
                                <input type="number" class="form-control" id="kabul_edilen_gun_sayisi"
                                    name="kabul_edilen_gun_sayisi"
                                    value="{{ $ime->kabul_edilen_gun_sayisi ? $ime->kabul_edilen_gun_sayisi : 'Girilmedi' }}">
                            </div>
                        @endif
                    @endif

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">İME'yi Güncelle</button>
                    </div>
                </form>
                <form class="text-end" action="{{ route('imedosyalarinisil', $staj->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <button class="btn btn-danger my-2"><i class="bi bi-trash"></i>İME'ye ait Dosyaları Sil</button>
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <p class="text-center">Sisteme dahil değilsiniz veya izniniz olmayan bir İME başvurusunu görüntülemeye
                    çalışıyorsunuz. Lütfen Sistem Yöneticisi ile iletişime geçiniz.
                </p>
            </div>
        </div>
    @endif
</x-app-layout>
