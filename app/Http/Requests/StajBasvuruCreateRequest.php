<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StajBasvuruCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "fakulte" => "required|min:3",
            "bolum" => "required|min:3",
            "ogrenci_no" => "required|min:3",
            "ad_soyad" => "required|min:3",
            "tc_no" => "required|min:3",
            "uyruk" => "required|min:3",
            "ogrenci_telefon" => "required|min:3",
            "ogrenci_eposta" => "required|min:3",
            "ogrenci_adres" => "required|min:3",
            "staj_tipi" => "required",
            "staj_baslangic" => "required",
            "gun_sayisi" => "required",
            "firma_resmi_ad" => "required|min:3",
            "firma_faaliyet_alani" => "required|min:3",
            "firma_adres" => "required|min:3",
            "firma_telefon" => "required|min:3",
            "firma_fax" => "required|min:3",
            "firma_eposta" => "required|min:3",
            "sorumlu_unvan" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "fakulte" => "Fakülte",
            "bolum" => "Bölüm",
            "ogrenci_no" => "Öğrenci Numarası",
            "ad_soyad" => "Ad Soyad",
            "tc_no" => "TC Kimlik Numarası",
            "uyruk" => "Uyruk",
            "ogrenci_telefon" => "Öğrenci Telefon Numarası",
            "ogrenci_eposta" => "Öğrenci Eposta",
            "ogrenci_adres" => "Öğrenci Adres",
            "staj_tipi" => "Staj Tipi",
            "staj_baslangic" => "Staj Başlangıç Tarihi",
            "gun_sayisi" => "Gün Sayısı",
            "firma_resmi_ad" => "Firma Resmi Adı",
            "firma_faaliyet_alani" => "Firma Faaliyet Alanı",
            "firma_adres" => "Firma Adres",
            "firma_telefon" => "Firma Telefon",
            "firma_fax" => "Firma Fax",
            "firma_eposta" => "Firma Eposta",
            "sorumlu_unvan" => "Sorumlu Unvan",
        ];
    }
}
