<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StajBasvuruCreateRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImeBasvuruCreateRequest;
use App\Mail\ImeEmail;
use App\Mail\StajEmail;
use App\Models\Ime;
use App\Models\Staj;
use App\Models\User;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;



class KomisyonController extends Controller
{


    public function stajlarGet(Request $request)
    {
        $search = $request->input('search');
        $stajlar = DB::table('stajs')->join('users', 'stajs.ogrenci_id', '=', 'users.id')
            ->when($search, function ($query, $search) {
                $query->where([['firma', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['staj_tipi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['yil_donem', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['onay_durumu', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['gun_sayisi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['baslangic_tarihi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['bitis_tarihi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['users.name', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['users.surname', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['not', 'LIKE', "%" . $search . "%"]]);
            })->select('stajs.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')->paginate(5);
        //dd($stajlar);
        return view('komisyon.stajlar', compact('stajlar'));
    }

    public function stajGet($id)
    {
        $staj = Staj::where([["stajs.id", "=", $id]])
            ->join('users', 'stajs.ogrenci_id', '=', 'users.id')
            ->select('stajs.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')
            ->first() ?? abort(404, 'Staj Bulunamadı');
        $ogretmen = User::find($staj->ogretmen_id);
        $ogretmenler = User::whereIn('rol', ['ogretmen', 'komisyon', 'yonetici', 'superyonetici'])->get();
        return view('komisyon.staj', compact('staj', 'ogretmen', 'ogretmenler'));
    }

    public function stajPatch(Request $request, $id)
    {

        if ($request->has('onay_durumu')) {

            DB::table('stajs')
                ->where([["id", "=", $id]])
                ->update(['onay_durumu' => $request->onay_durumu, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('ogretmen_id')) {

            DB::table('stajs')
                ->where([["id", "=", $id]])
                ->update(['ogretmen_id' => $request->ogretmen_id, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('not')) {
            $yil_donem = '';

            $guz_array = ['September', 'October', 'November', 'December', 'January'];
            $bahar_array = ['February', 'March', 'April', 'May', 'June', 'July', 'August'];
            if (in_array(Carbon::now()->format('F'), $guz_array)) {
                $yil_donem = Carbon::now()->format('Y') . '-' . Carbon::now()->addYear()->format('Y') . ' ' . 'Güz';
            }

            if (in_array(Carbon::now()->format('F'), $bahar_array)) {
                $yil_donem = Carbon::now()->subYear()->format('Y') . '-' . Carbon::now()->format('Y') . ' ' . 'Bahar';
            }
            DB::table('stajs')
                ->where([["id", "=", $id]])
                ->update(['not' => $request->not, 'yil_donem' => $yil_donem, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('kabul_edilen_gun_sayisi')) {

            DB::table('stajs')
                ->where([["id", "=", $id]])
                ->update(['kabul_edilen_gun_sayisi' => $request->kabul_edilen_gun_sayisi, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        $staj = Staj::where([["stajs.id", "=", $id]])
            ->join('users', 'stajs.ogrenci_id', '=', 'users.id')
            ->select('stajs.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')
            ->first();

        /* if ($staj->ogrenci_telefon != null) {
            try {

                $vonageBasic  = new \Vonage\Client\Credentials\Basic("988c7668", "VUR7jlSlagW73IDV");

                $vonageClient = new \Vonage\Client($vonageBasic);

                $response = $vonageClient->sms()->send(
                    new \Vonage\SMS\Message\SMS("905398753595","905349699937", $message = "Onay Durumu: " . $staj->onay_durumu .
                        "Not: " . $staj->not .
                        "Kabul Edilen Gün Sayısı: " . $staj->kabul_edilen_gun_sayisi)
                );

                $message = $response->current();

                if ($message->getStatus() == 0) {
                    echo "The message was sent successfully\n";
                } else {
                    echo "The message failed with status: " . $message->getStatus() . "\n";
                }

                dd('SMS Sent Successfully.');
            } catch (Exception $e) {
                dd("Error: " . $e->getMessage());
            }
        } */

        Mail::to($staj->ogrenci_eposta)->send(new StajEmail($staj));

        return redirect()->route('komisyon.stajlarget')->withSuccess("Staj güncellendi.");
    }


    public function imesGet(Request $request)
    {
        $search = $request->input('search');
        $imes = DB::table('imes')->join('users', 'imes.ogrenci_id', '=', 'users.id')
            ->when($search, function ($query, $search) {
                $query->where([['firma', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['yil_donem', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['onay_durumu', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['gun_sayisi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['baslangic_tarihi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['bitis_tarihi', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['users.name', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['users.surname', 'LIKE', "%" . $search . "%"]])
                    ->orWhere([['not', 'LIKE', "%" . $search . "%"]]);
            })->select('imes.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')->paginate(5);

        return view('komisyon.imes', compact('imes'));
    }

    public function imeGet($id)
    {
        $ime = Ime::where([["imes.id", "=", $id]])
            ->join('users', 'imes.ogrenci_id', '=', 'users.id')
            ->select('imes.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')
            ->first() ?? abort(404, 'İşletmede Mesleki Eğitim Kaydı Bulunamadı');
        $ogretmen = User::find($ime->ogretmen_id);
        $ogretmenler = User::whereIn('rol', ['ogretmen', 'komisyon', 'yonetici', 'superyonetici'])->get();
        return view('komisyon.ime', compact('ime', 'ogretmen', 'ogretmenler'));
    }

    public function imePatch(Request $request, $id)
    {
        if ($request->has('ime_denetleme_formu')) {
            $request->validate([
                'ime_denetleme_formu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf'
            ]);

            $result = $request->ime_denetleme_formu->storeOnCloudinary();

            /*  $filenameDenetleme = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->ime_denetleme_formu->getClientOriginalName();
            $request->ime_degerlendirme_formu->move(public_path('ime'), $filenameDenetleme); */

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['ime_denetleme_formu' => $result->getSecurePath(), 'ime_denetleme_formu_id' => $request->getPublicId(), "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('onay_durumu')) {

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['onay_durumu' => $request->onay_durumu, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('ogretmen_id')) {

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['ogretmen_id' => $request->ogretmen_id, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('not')) {

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['not' => $request->not, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('kabul_edilen_gun_sayisi')) {

            DB::table('imes')
                ->where([["id", "=", $id]])
                ->update(['kabul_edilen_gun_sayisi' => $request->kabul_edilen_gun_sayisi, "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        $ime = Ime::where([["imes.id", "=", $id]])
            ->join('users', 'imes.ogrenci_id', '=', 'users.id')
            ->select('imes.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')
            ->first();

        Mail::to($ime->ogrenci_eposta)->send(new ImeEmail($ime));

        return redirect()->route('komisyon.imesget')->withSuccess("İME güncellendi.");
    }

    public function stajDelete($id)
    {
        $deleted = DB::table('stajs')->where('id', '=', $id)->delete();

        return redirect()->route('komisyon.stajlarget')->withSuccess("Staj silindi.");
    }

    public function imeDelete($id)
    {
        $deleted = DB::table('imes')->where('id', '=', $id)->delete();

        return redirect()->route('komisyon.imesget')->withSuccess("İME silindi.");
    }

    public function imeSecimGet(Request $request)
    {
        $ime_kayitlilar = DB::table('imes')->whereIn('onay_durumu', ['Öğrenci Başvurusu Gerekmektedir', "Komisyon Onayı Gerekmektedir"])->orWhere([["onay_durumu", "=", "Kabul Edildi"], ["not", "=", "Başarılı"]])->select('ogrenci_id')->get();
        //dd($ime_kayitlilar);
        $ime_kayitlilar_id = collect();
        foreach ($ime_kayitlilar as $ime_kayitli) {
            $ime_kayitlilar_id->add($ime_kayitli->ogrenci_id);
        }
        $search = $request->input('search');
        $ime_adaylari = DB::table('users')->where('rol', '=', 'ogrenci')->whereNotIn('id', $ime_kayitlilar_id)
            ->when($search, function ($query, $search) use ($ime_kayitlilar_id) {
                $query->where([['ogrenci_sicil_no', 'LIKE', "%" . $search . "%"], ['rol', '=', 'ogrenci']])->whereNotIn('id', $ime_kayitlilar_id)
                    ->orWhere([['bolum', 'LIKE', "%" . $search . "%"], ['rol', '=', 'ogrenci']])->whereNotIn('id', $ime_kayitlilar_id)
                    ->orWhere([['fakulte', 'LIKE', "%" . $search . "%"], ['rol', '=', 'ogrenci']])->whereNotIn('id', $ime_kayitlilar_id)
                    ->orWhere([['name', 'LIKE', "%" . $search . "%"], ['rol', '=', 'ogrenci']])->whereNotIn('id', $ime_kayitlilar_id)
                    ->orWhere([['surname', 'LIKE', "%" . $search . "%"], ['rol', '=', 'ogrenci']])->whereNotIn('id', $ime_kayitlilar_id);
            })->paginate(5);
        //dd($ime_adaylari);
        return view('komisyon.imesecim', compact('ime_adaylari'));
    }

    public function imeSecimPost(Request $request)
    {

        if ($request->has('ogrenci_numaralari')) {
            foreach ($request->ogrenci_numaralari as $key => $value) {
                DB::table('imes')->insert([
                    "ogrenci_id" => $value, "yil_donem" => $request->yil . " " . $request->donem, "onay_durumu" => "Öğrenci Başvurusu Gerekmektedir", "created_at" => Carbon::now("Europe/Istanbul"),
                    "updated_at" => Carbon::now("Europe/Istanbul"),
                ]);
            }
            return redirect()->route('komisyon.imesget')->withSuccess("Öğrenci İME listesine eklendi.");
        } else {
            return redirect()->route('komisyon.imesget')->withErrors("Öğrenci İME listesine eklenmedi.");
        }
    }
}
