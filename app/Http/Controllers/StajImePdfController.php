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


class StajImePdfController extends Controller
{
    public function stajBilgileriIndirPost(Request $request) {
        $bilgi = $request->input();

        $pdf = Pdf::loadView('stajbilgileripdf', $bilgi);
        return $pdf->download('stajbilgileri.pdf');
    }

    public function imeBilgileriIndirPost(Request $request) {
        $bilgi = $request->input();

        $pdf = Pdf::loadView('imebilgileripdf', $bilgi);
        return $pdf->download('imebilgileri.pdf');
    }
}
