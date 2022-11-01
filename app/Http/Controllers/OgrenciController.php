<?php

namespace App\Http\Controllers;

use App\Http\Requests\StajBasvuruCreateRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImeBasvuruCreateRequest;
use App\Models\Ime;
use App\Models\Staj;
use App\Models\User;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Cloudinary;


class OgrenciController extends Controller
{
    public function stajBasvurusuYapGet()
    {
        return view('ogrenci.stajbasvurusuyap');
    }

    public function stajBasvurusuYapPost(StajBasvuruCreateRequest $request)
    {

        $bitis_tarihi = Carbon::parse($request->staj_baslangic)->addBusinessDay($request->gun_sayisi);

        DB::table("stajs")->updateOrInsert(["ogrenci_id" => auth()->user()->id, "onay_durumu" => "Onaylı Staj Kabul Formu Gerekmektedir", "baslangic_tarihi" => Carbon::parse($request->staj_baslangic), "bitis_tarihi" => $bitis_tarihi,], [
            "ogrenci_id" => auth()->user()->id,
            "firma" => $request->firma_resmi_ad,
            "staj_tipi" => $request->staj_tipi,
            "onay_durumu" => "Onaylı Staj Kabul Formu Gerekmektedir",
            "gun_sayisi" => $request->gun_sayisi,
            "baslangic_tarihi" => Carbon::parse($request->staj_baslangic),
            "bitis_tarihi" => $bitis_tarihi,
            "ogrenci_adres" => $request->ogrenci_adres,
            "ogrenci_il" => $request->ogrenci_il,
            "ogrenci_ilce" => $request->ogrenci_ilce,
            "ogrenci_posta_kodu" => $request->ogrenci_posta_kod,
            "ogrenci_eposta" => $request->ogrenci_eposta,
            "ogrenci_telefon" => $request->ogrenci_telefon,
            "firma_faaliyet_alani" => $request->firma_faaliyet_alani,
            "firma_adres" => $request->firma_adres,
            "firma_il" => $request->firma_il,
            "firma_ilce" => $request->firma_ilce,
            "firma_posta_kodu" => $request->firma_posta_kod,
            "firma_fax" => $request->firma_fax,
            "firma_telefon" => $request->firma_telefon,
            "firma_eposta" => $request->firma_eposta,
            "firma" => $request->firma_resmi_ad,
            "created_at" => Carbon::now("Europe/Istanbul"),
            "updated_at" => Carbon::now("Europe/Istanbul"),
        ]);

        $request->merge(
            [
                "bitis_tarihi" => $bitis_tarihi,
                "saglik_check" => $request->has('saglik_check'),
                "gss_check" => $request->has('gss_check'),
                "yas_25_check" => $request->has('yas_25_check'),
                "devlet_katki_check" => $request->has('devlet_katki_check'),
            ]
        );


        $bilgi = $request->input();
        return redirect()->route('ogrenci.stajbasvuruformunuindirget')->with('bilgi',$bilgi);
        //$pdf = Pdf::loadView('ogrenci.stajbasvurupdf', $bilgi);
        //return $pdf->download('stajkabulform.pdf');
    }

    public function stajBasvuruFormunuIndirGet() {

        return view('ogrenci.stajbasvurukabulformunuindir');
    }

    public function stajBasvuruFormunuIndirPost(Request $request) {

        $bilgi = $request->input();
        $pdf = Pdf::loadView('ogrenci.stajbasvurupdf', $bilgi);
        return $pdf->download('stajkabulform.pdf');
    }

    public function stajlarGet(Request $request)
    {
        $search = $request->input('search');

        $stajlar = DB::table('stajs')->where([['ogrenci_id', '=', auth()->user()->id]])->when($search, function ($query, $search) {
            $query->where([['firma', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['staj_tipi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['yil_donem', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['onay_durumu', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['gun_sayisi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['baslangic_tarihi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['bitis_tarihi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                ->orWhere([['not', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]]);
        })->paginate(5);

        return view('ogrenci.stajlar', compact('stajlar'));
    }

    public function stajGet($id)
    {
        $staj = Staj::where([['ogrenci_id', '=', auth()->user()->id], ["stajs.id", "=", $id]])
        ->join('users','stajs.ogrenci_id','=','users.id')
        ->select('stajs.*','users.name','users.surname','users.email','users.ogrenci_sicil_no','users.rol','users.telefon','users.fakulte','users.bolum','users.sinif')
        ->first() ?? abort(404, 'Staj Bulunamadı');
        $ogretmen = User::find($staj->ogretmen_id);
        return view('ogrenci.staj', compact('staj', 'ogretmen'));
    }

    public function stajPatch(Request $request, $id)
    {

        if ($request->has('onayli_staj_basvurusu')) {
            $request->validate([
                'onayli_staj_basvurusu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf'
            ]);

            $result = $request->onayli_staj_basvurusu->storeOnCloudinary();
            //$filename = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->onayli_staj_basvurusu->getClientOriginalName();
            //$request->onayli_staj_basvurusu->move(public_path('staj'), $filename);

            DB::table('stajs')
                ->where([['ogrenci_id', '=', auth()->user()->id], ["id", "=", $id]])
                ->update(['onayli_staj_basvurusu' => $result->getSecurePath(),'onayli_staj_basvurusu_id' => $result->getPublicId() ,'onay_durumu' => "Komisyon Onayı Bekleniyor", "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('staj_raporu') && $request->has('staj_degerlendirme_formu')) {
            $request->validate([
                'staj_raporu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf',
                'staj_degerlendirme_formu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf'
            ]);

            $resultStajRaporu = $request->staj_raporu->storeOnCloudinary();
            //$filenameRapor = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->staj_raporu->getClientOriginalName();
            //$request->staj_raporu->move(public_path('staj'), $filenameRapor);

            $resultStajDegerlendirmeFormu = $request->onayli_staj_basvurusu->storeOnCloudinary();
            //$filenameDegerlendirme = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->staj_degerlendirme_formu->getClientOriginalName();
            //$request->staj_degerlendirme_formu->move(public_path('staj'), $filenameDegerlendirme);

            DB::table('stajs')
                ->where([['ogrenci_id', '=', auth()->user()->id], ["id", "=", $id]])
                ->update(['staj_raporu' => $resultStajRaporu->getSecurePath(),'staj_raporu_id' =>$resultStajRaporu->getPublicId() ,'staj_degerlendirme_formu' => $resultStajDegerlendirmeFormu->getSecurePath(),'staj_degerlendirme_formu_id' => $resultStajDegerlendirmeFormu->getPublicId() ,'not' => "Öğretmen Değerlendirmesi Bekleniyor", "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('staj_devlet_katki_payi')) {
            $request->validate([
                'staj_devlet_katki_payi' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf'
            ]);

            $result = $request->onayli_staj_basvurusu->storeOnCloudinary();

            //$filenameKatki = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->staj_devlet_katki_payi->getClientOriginalName();
            //$request->staj_devlet_katki_payi->move(public_path('staj'), $filenameKatki);

            DB::table('stajs')
                ->where([['ogrenci_id', '=', auth()->user()->id], ["id", "=", $id]])
                ->update(['staj_devlet_katki_payi' => $result->getSecurePath(), 'staj_devlet_katki_payi_id' => $result->getPublicId(),"updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        return redirect()->route('ogrenci.stajlarget')->withSuccess("Staj güncellendi.");
    }

    public function imeBasvurusuYapGet()
    {
        $ime = Ime::where([['ogrenci_id', '=', auth()->user()->id], ['onay_durumu', '=', 'Öğrenci Başvurusu Gerekmektedir']])->orderByDesc('updated_at')->first();
        if (is_null($ime)) {
            return redirect()->route('ogrenci.imesget')->withErrors("İME için komisyon tarafından seçilmediniz veya mevcut bir İME başvurunuz var.");
        }
        return view('ogrenci.imebasvurusuyap', compact('ime'));
    }

    public function imeBasvurusuYapPost(ImeBasvuruCreateRequest $request)
    {

        $staj = Staj::where([['ogrenci_id', '=', auth()->user()->id], ['onay_durumu', '=', 'Kabul Edildi']])->orderByDesc('updated_at')->first();

        $bitis_tarihi = Carbon::parse($request->ime_baslangic)->addBusinessDay($request->gun_sayisi);
        $ime = Ime::where([['ogrenci_id', '=', auth()->user()->id], ['onay_durumu', '=', 'Öğrenci Başvurusu Gerekmektedir']])->orderByDesc('updated_at')->first();
        if (!is_null($staj)) {
            if (Carbon::parse($request->ime_baslangic)->gt(Carbon::parse($staj->bitis_tarihi)) && Carbon::parse($request->ime_baslangic)->diffInDays(Carbon::parse($staj->bitis_tarihi)) >= 7) {
                DB::table("imes")->where([['id', '=', $ime->id]])->update([
                    "ogrenci_id" => auth()->user()->id,
                    "firma" => $request->firma_resmi_ad,
                    "onay_durumu" => "Onaylı İME Kabul Formu Gerekmektedir",
                    "gun_sayisi" => $request->gun_sayisi,
                    "baslangic_tarihi" => Carbon::parse($request->ime_baslangic),
                    "bitis_tarihi" => $bitis_tarihi,
                    "ogrenci_adres" => $request->ogrenci_adres,
                    "ogrenci_il" => $request->ogrenci_il,
                    "ogrenci_ilce" => $request->ogrenci_ilce,
                    "ogrenci_posta_kodu" => $request->ogrenci_posta_kod,
                    "ogrenci_eposta" => $request->ogrenci_eposta,
                    "ogrenci_telefon" => $request->ogrenci_telefon,
                    "firma_faaliyet_alani" => $request->firma_faaliyet_alani,
                    "firma_adres" => $request->firma_adres,
                    "firma_il" => $request->firma_il,
                    "firma_ilce" => $request->firma_ilce,
                    "firma_posta_kodu" => $request->firma_posta_kod,
                    "firma_fax" => $request->firma_fax,
                    "firma_telefon" => $request->firma_telefon,
                    "firma_eposta" => $request->firma_eposta,
                    "firma" => $request->firma_resmi_ad,
                    "created_at" => Carbon::now("Europe/Istanbul"),
                    "updated_at" => Carbon::now("Europe/Istanbul"),
                ]);

                $request->merge(
                    [
                        "bitis_tarihi" => $bitis_tarihi,
                        "saglik_check" => $request->has('saglik_check'),
                        "gss_check" => $request->has('gss_check'),
                        "yas_25_check" => $request->has('yas_25_check'),
                    ]
                );


                $bilgi = $request->input();
                return redirect()->route('ogrenci.imebasvuruformunuindirget')->with('bilgi',$bilgi);
                //$pdf = Pdf::loadView('ogrenci.imebasvurupdf', $bilgi);
                //return $pdf->download('imekabulform.pdf');
            } else {
                return redirect()->route('ogrenci.imebasvurusuyapget')->withErrors("İME başlangıcı ve staj bitişi arasında en az 7 gün olmalıdır.");
            }
        } else {
            DB::table("imes")->where([['id', '=', $ime->id]])->update([
                "ogrenci_id" => auth()->user()->id,
                "firma" => $request->firma_resmi_ad,
                "onay_durumu" => "Onaylı İME Kabul Formu Gerekmektedir",
                "gun_sayisi" => $request->gun_sayisi,
                "baslangic_tarihi" => Carbon::parse($request->ime_baslangic),
                "bitis_tarihi" => $bitis_tarihi,
                "ogrenci_adres" => $request->ogrenci_adres,
                "ogrenci_il" => $request->ogrenci_il,
                "ogrenci_ilce" => $request->ogrenci_ilce,
                "ogrenci_posta_kodu" => $request->ogrenci_posta_kod,
                "ogrenci_eposta" => $request->ogrenci_eposta,
                "ogrenci_telefon" => $request->ogrenci_telefon,
                "firma_faaliyet_alani" => $request->firma_faaliyet_alani,
                "firma_adres" => $request->firma_adres,
                "firma_il" => $request->firma_il,
                "firma_ilce" => $request->firma_ilce,
                "firma_posta_kodu" => $request->firma_posta_kod,
                "firma_fax" => $request->firma_fax,
                "firma_telefon" => $request->firma_telefon,
                "firma_eposta" => $request->firma_eposta,
                "firma" => $request->firma_resmi_ad,
                "created_at" => Carbon::now("Europe/Istanbul"),
                "updated_at" => Carbon::now("Europe/Istanbul"),
            ]);

            $request->merge(
                [
                    "bitis_tarihi" => $bitis_tarihi,
                    "saglik_check" => $request->has('saglik_check'),
                    "gss_check" => $request->has('gss_check'),
                    "yas_25_check" => $request->has('yas_25_check'),
                ]
            );

            $bilgi = $request->input();
            return redirect()->route('ogrenci.imebasvuruformunuindirget')->with('bilgi',$bilgi);
            //$pdf = Pdf::loadView('ogrenci.imebasvurupdf', $bilgi);
            //return $pdf->download('imekabulform.pdf');
        }
    }

    public function imeBasvuruFormunuIndirGet() {

        return view('ogrenci.imebasvurukabulformunuindir');
    }

    public function imeBasvuruFormunuIndirPost(Request $request) {

        $bilgi = $request->input();
        $pdf = Pdf::loadView('ogrenci.imebasvurupdf', $bilgi);
        return $pdf->download('imekabulform.pdf');
    }

    public function imesGet(Request $request)
    {
        $search = $request->input('search');
        $imes = DB::table('imes')->where([['ogrenci_id', '=', auth()->user()->id]])
            ->when($search, function ($query, $search) {
                $query->where([['firma', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                    ->orWhere([['yil_donem', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                    ->orWhere([['onay_durumu', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                    ->orWhere([['gun_sayisi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                    ->orWhere([['baslangic_tarihi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                    ->orWhere([['bitis_tarihi', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]])
                    ->orWhere([['not', 'LIKE', "%" . $search . "%"], ['ogrenci_id', '=', auth()->user()->id]]);
            })->paginate(5);

        return view('ogrenci.imes', compact('imes'));
    }

    public function imeGet($id)
    {
        $ime = Ime::where([['ogrenci_id', '=', auth()->user()->id], ["imes.id", "=", $id]])
        ->join('users','imes.ogrenci_id','=','users.id')
        ->select('imes.*','users.name','users.surname','users.email','users.ogrenci_sicil_no','users.rol','users.telefon','users.fakulte','users.bolum','users.sinif')
        ->first() ?? abort(404, 'İşletmede Mesleki Eğitim Kaydı Bulunamadı');
        $ogretmen = User::find($ime->ogretmen_id);
        return view('ogrenci.ime', compact('ime', 'ogretmen'));
    }

    public function imePatch(Request $request, $id)
    {

        $ime = Ime::where([['ogrenci_id', '=', auth()->user()->id], ["id", "=", $id]])->first();

        if ($ime->onay_durumu == "Öğrenci Başvurusu Gerekmektedir") {
            return redirect()->route('ogrenci.imesget')->withErrors("İME başvurusu yapmanız gerekmektedir.");
        }

        if ($request->has('onayli_ime_basvurusu')) {
            $request->validate([
                'onayli_ime_basvurusu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf'
            ]);

            $result = $request->onayli_ime_basvurusu->storeOnCloudinary();

            //$filename = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->onayli_ime_basvurusu->getClientOriginalName();
            //$request->onayli_ime_basvurusu->move(public_path('ime'), $filename);

            DB::table('imes')
                ->where([['ogrenci_id', '=', auth()->user()->id], ["id", "=", $id]])
                ->update(['onayli_ime_basvurusu' => $result->getSecurePath(),'onayli_ime_basvurusu_id' => $result->getPublicId() ,'onay_durumu' => "Komisyon Onayı Bekleniyor", "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        if ($request->has('ime_raporu') && $request->has('ime_degerlendirme_formu')) {
            $request->validate([
                'ime_raporu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf',
                'ime_denetleme_formu' => 'mimetypes:application/vnd.oasis.opendocument.text,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/x-pdf'
            ]);

            $resultImeRapor = $request->ime_raporu->storeOnCloudinary();
            $resultImeDenetlemeFormu = $request->ime_denetleme_formu->storeOnCloudinary();

            /* $filenameRapor = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->ime_raporu->getClientOriginalName();
            $request->ime_raporu->move(public_path('ime'), $filenameRapor);

            $filenameDegerlendirme = auth()->user()->name . "_" . auth()->user()->surname . "_" . date('dmYHi') . "_" . $request->ime_degerlendirme_formu->getClientOriginalName();
            $request->ime_degerlendirme_formu->move(public_path('ime'), $filenameDegerlendirme); */

            DB::table('imes')
                ->where([['ogrenci_id', '=', auth()->user()->id], ["id", "=", $id]])
                ->update(['ime_raporu' => $resultImeRapor->getSecurePath(),'ime_raporu_id' => $resultImeRapor->getPublicId() ,'ime_degerlendirme_formu' => $resultImeDenetlemeFormu->getSecurePath(),'ime_degerlendirme_formu_id'=>$resultImeDenetlemeFormu->getPublicId(),'not' => "Öğretmen Değerlendirmesi Bekleniyor", "updated_at" => Carbon::now("Europe/Istanbul")]);
        }

        return redirect()->route('ogrenci.imesget')->withSuccess("İME güncellendi.");
    }
}
