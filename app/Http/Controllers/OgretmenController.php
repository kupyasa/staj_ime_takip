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
use Illuminate\Support\Facades\Mail;
use Svg\Tag\Rect;

class OgretmenController extends Controller
{
    public function stajlarGet(Request $request)
    {
        $search = $request->input('search');
        $stajlar = DB::table('stajs')->join('users', 'stajs.ogrenci_id', '=', 'users.id')
            ->where([['ogretmen_id', '=', auth()->user()->id]])
            ->when($search, function ($query, $search) {
                $query->where([['firma', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['staj_tipi', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['yil_donem', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['onay_durumu', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['gun_sayisi', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['baslangic_tarihi', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['bitis_tarihi', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['users.name', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['users.surname', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['not', 'LIKE', "%" . $search . "%"]])
                    ->where([['ogretmen_id', '=', auth()->user()->id]]);
            })->select('stajs.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')->paginate(5);

        return view('ogretmen.stajlar', compact('stajlar'));
    }

    public function stajGet($id)
    {
        $staj = Staj::where([['ogretmen_id', '=', auth()->user()->id], ["stajs.id", "=", $id]])
            ->join('users', 'stajs.ogrenci_id', '=', 'users.id')
            ->select('stajs.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')
            ->first() ?? abort(404, 'Staj Bulunamadı');
        $ogretmen = User::find($staj->ogretmen_id);
        return view('ogretmen.staj', compact('staj', 'ogretmen'));
    }

    public function stajPatch(Request $request, $id)
    {

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

        Mail::to($staj->ogrenci_eposta)->send(new StajEmail($staj));

        return redirect()->route('ogretmen.stajlarget')->withSuccess("Staj güncellendi.");
    }

    public function imesGet(Request $request)
    {
        $search = $request->input('search');
        $imes = DB::table('imes')->join('users', 'imes.ogrenci_id', '=', 'users.id')->where([['ogretmen_id', '=', auth()->user()->id]])
            ->when($search, function ($query, $search) {
                $query->where([['firma', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['yil_donem', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['onay_durumu', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['gun_sayisi', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['baslangic_tarihi', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['bitis_tarihi', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['users.name', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['users.surname', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]])
                    ->orWhere([['not', 'LIKE', "%" . $search . "%"]])->where([['ogretmen_id', '=', auth()->user()->id]]);
            })->select('imes.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')->paginate(5);

        return view('ogretmen.imes', compact('imes'));
    }

    public function imeGet($id)
    {
        $ime = Ime::where([["imes.id", "=", $id], ["ogretmen_id", "=", auth()->user()->id]])
            ->join('users', 'imes.ogrenci_id', '=', 'users.id')
            ->select('imes.*', 'users.name', 'users.surname', 'users.email', 'users.ogrenci_sicil_no', 'users.rol', 'users.telefon', 'users.fakulte', 'users.bolum', 'users.sinif')
            ->first() ?? abort(404, 'İşletmede Mesleki Eğitim Kaydı Bulunamadı');
        $ogretmen = User::find($ime->ogretmen_id);
        return view('komisyon.ime', compact('ime', 'ogretmen'));
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

        return redirect()->route('ogretmen.imesget')->withSuccess("İME güncellendi.");
    }
}
