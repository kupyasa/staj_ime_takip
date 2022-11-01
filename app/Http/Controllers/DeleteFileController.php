<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StajBasvuruCreateRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImeBasvuruCreateRequest;
use App\Models\Ime;
use App\Models\Staj;
use App\Models\User;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DeleteFileController extends Controller
{
    public function stajDosyalariniSil($id) {
        $staj = Staj::where([["stajs.id", "=", $id]])
        ->join('users','stajs.ogrenci_id','=','users.id')
        ->select('stajs.*','users.name','users.surname','users.email','users.ogrenci_sicil_no','users.rol','users.telefon','users.fakulte','users.bolum','users.sinif')
        ->first() ?? abort(404, 'Staj Bulunamadı');

        if ($staj->onayli_staj_basvurusu != null) {
            Cloudinary::destroy($staj->onayli_staj_basvurusu_id);

            DB::table('stajs')
                ->where([["id", "=", $id]])
                ->update(['onayli_staj_basvurusu' => null,'onayli_staj_basvurusu_id' => null ,"updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($staj->staj_raporu && $staj->staj_degerlendirme_formu) {

            Cloudinary::destroy($staj->staj_raporu_id);
            Cloudinary::destroy($staj->staj_degerlendirme_formu_id);

            DB::table('stajs')
            ->where([ ["id", "=", $id]])
            ->update(['staj_raporu' => null,'staj_raporu_id' =>null ,'staj_degerlendirme_formu' => null,'staj_degerlendirme_formu_id' => null , "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($staj->staj_devlet_katki_payi != null) {

            Cloudinary::destroy($staj->staj_devlet_katki_payi_id);

            DB::table('stajs')
                ->where([["id", "=", $id]])
                ->update(['staj_devlet_katki_payi' => null, 'staj_devlet_katki_payi_id' => null,"updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        return redirect()->route('dashboard')->withSuccess('Dosyalar silindi.');
    }

    public function imeDosyalariniSil($id) {
        $ime = Ime::where([["imes.id", "=", $id]])
        ->join('users','imes.ogrenci_id','=','users.id')
        ->select('imes.*','users.name','users.surname','users.email','users.ogrenci_sicil_no','users.rol','users.telefon','users.fakulte','users.bolum','users.sinif')
        ->first() ?? abort(404, 'İşletmede Mesleki Eğitim Kaydı Bulunamadı');

        if ($ime->onayli_ime_basvurusu != null) {
            Cloudinary::destroy($ime->onayli_ime_basvurusu_id);

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['onayli_ime_basvurusu' => null,'onayli_ime_basvurusu' => null ,"updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($ime->ime_raporu && $ime->ime_degerlendirme_formu) {

            Cloudinary::destroy($ime->ime_raporu_id);
            Cloudinary::destroy($ime->ime_degerlendirme_formu_id);

            DB::table('imes')
            ->where([ ["id", "=", $id]])
            ->update(['ime_raporu' => null,'ime_raporu_id' =>null ,'ime_degerlendirme_formu' => null,'ime_degerlendirme_formu_id' => null , "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($ime->ime_denetleme_formu != null) {

            Cloudinary::destroy($ime->ime_denetleme_formu_id);

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['ime_denetleme_formu' => null, 'ime_denetleme_formu_id' => null,"updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        return redirect()->route('dashboard')->withSuccess('Dosyalar silindi.');
    }

}
