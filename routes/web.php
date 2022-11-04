<?php

use App\Http\Controllers\DeleteFileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OgrenciController;
use App\Http\Controllers\KomisyonController;
use App\Http\Controllers\OgretmenController;
use App\Http\Controllers\StajImePdfController;
use App\Http\Controllers\YoneticiController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/anasayfa', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/public/staj/{filepath}', function ($filepath) {
    if (File::exists(public_path('staj/' . $filepath))) {
        return Response::download(public_path('staj/' . $filepath));
    }
    abort(404,"Dosya bulunamadı.");
})->middleware(['auth']);

Route::get('/public/ime/{filepath}', function ($filepath) {
    if (File::exists(public_path('ime/' . $filepath))) {
        return Response::download(public_path('ime/' . $filepath));
    }
    abort(404,"Dosya bulunamadı.");
})->middleware(['auth']);

Route::post('/stajbilgileripdf',[StajImePdfController::class, 'stajBilgileriIndirPost'])->middleware('auth')->name('stajbilgileriindirpost');
Route::post('/imebilgileripdf',[StajImePdfController::class, 'imeBilgileriIndirPost'])->middleware('auth')->name('imebilgileriindirpost');

Route::patch('/stajdosyalarinisil/{id}',[DeleteFileController::class, 'stajDosyalariniSil'])->whereNumber('id')->middleware('isKomisyon')->name('stajdosyalarinisil');
Route::patch('/imedosyalarinisil/{id}',[DeleteFileController::class, 'imeDosyalariniSil'])->whereNumber('id')->middleware('isKomisyon')->name('imedosyalarinisil');

Route::patch('/stajdosyalarinisil/{id}',[DeleteFileController::class, 'stajDosyalariniSil'])->whereNumber('id')->middleware('isYonetici')->name('stajdosyalarinisil');
Route::patch('/imedosyalarinisil/{id}',[DeleteFileController::class, 'imeDosyalariniSil'])->whereNumber('id')->middleware('isYonetici')->name('imedosyalarinisil');

Route::patch('/stajdosyalarinisil/{id}',[DeleteFileController::class, 'stajDosyalariniSil'])->whereNumber('id')->middleware('isSuperYonetici')->name('stajdosyalarinisil');
Route::patch('/imedosyalarinisil/{id}',[DeleteFileController::class, 'imeDosyalariniSil'])->whereNumber('id')->middleware('isSuperYonetici')->name('imedosyalarinisil');

Route::group(
    [
        'middleware' => ['auth','isOgrenci'],
        'prefix' => 'ogrenci'
    ],
    function () {
        Route::get('stajbasvurusuyap', [OgrenciController::class, 'stajBasvurusuYapGet'])->name('ogrenci.stajbasvurusuyapget');
        Route::post('stajbasvurusuyap', [OgrenciController::class, 'stajBasvurusuYapPost'])->name('ogrenci.stajbasvurusuyappost');
        Route::get('stajlar', [OgrenciController::class, 'stajlarGet'])->name('ogrenci.stajlarget');
        Route::get('staj/{id}', [OgrenciController::class, 'stajGet'])->whereNumber('id')->name('ogrenci.stajget');
        Route::patch('staj/{id}', [OgrenciController::class, 'stajPatch'])->whereNumber('id')->name('ogrenci.stajpatch');
        Route::get('staj/basvuruformunuindir',[OgrenciController::class, 'stajBasvuruFormunuIndirGet'])->name('ogrenci.stajbasvuruformunuindirget');
        Route::post('staj/basvuruformunuindir',[OgrenciController::class, 'stajBasvuruFormunuIndirPost'])->name('ogrenci.stajbasvuruformunuindirpost');

        Route::get('imebasvurusuyap', [OgrenciController::class, 'imeBasvurusuYapGet'])->name('ogrenci.imebasvurusuyapget');
        Route::post('imebasvurusuyap', [OgrenciController::class, 'imeBasvurusuYapPost'])->name('ogrenci.imebasvurusuyappost');
        Route::get('imes', [OgrenciController::class, 'imesGet'])->name('ogrenci.imesget');
        Route::get('ime/{id}', [OgrenciController::class, 'imeGet'])->whereNumber('id')->name('ogrenci.imeget');
        Route::patch('ime/{id}', [OgrenciController::class, 'imePatch'])->whereNumber('id')->name('ogrenci.imepatch');
        Route::get('ime/basvuruformunuindir',[OgrenciController::class, 'imeBasvuruFormunuIndirGet'])->name('ogrenci.imebasvuruformunuindirget');
        Route::post('ime/basvuruformunuindir',[OgrenciController::class, 'imeBasvuruFormunuIndirPost'])->name('ogrenci.imebasvuruformunuindirpost');
    }
);

Route::group(
    [
        'middleware' => ['auth','isKomisyon'],
        'prefix' => 'komisyon'
    ],
    function () {

        Route::get('stajlar', [KomisyonController::class, 'stajlarGet'])->name('komisyon.stajlarget');
        Route::get('staj/{id}', [KomisyonController::class, 'stajGet'])->whereNumber('id')->name('komisyon.stajget');
        Route::patch('staj/{id}', [KomisyonController::class, 'stajPatch'])->whereNumber('id')->name('komisyon.stajpatch');
        Route::delete('staj/{id}', [KomisyonController::class, 'stajDelete'])->whereNumber('id')->name('komisyon.stajdelete');

        Route::get('imes', [KomisyonController::class, 'imesGet'])->name('komisyon.imesget');
        Route::get('ime/{id}', [KomisyonController::class, 'imeGet'])->whereNumber('id')->name('komisyon.imeget');
        Route::patch('ime/{id}', [KomisyonController::class, 'imePatch'])->whereNumber('id')->name('komisyon.imepatch');
        Route::delete('ime/{id}', [KomisyonController::class, 'imeDelete'])->whereNumber('id')->name('komisyon.imedelete');

        Route::get('imesecim', [KomisyonController::class, 'imeSecimGet'])->name('komisyon.imesecimget');
        Route::post('imesecim', [KomisyonController::class, 'imeSecimPost'])->name('komisyon.imesecimpost');
    }
);

Route::group(
    [
        'middleware' => ['auth','isOgretmen'],
        'prefix' => 'ogretmen'
    ],
    function () {

        Route::get('stajlar', [OgretmenController::class, 'stajlarGet'])->name('ogretmen.stajlarget');
        Route::get('staj/{id}', [OgretmenController::class, 'stajGet'])->whereNumber('id')->name('ogretmen.stajget');
        Route::patch('staj/{id}', [OgretmenController::class, 'stajPatch'])->whereNumber('id')->name('ogretmen.stajpatch');

        Route::get('imes', [OgretmenController::class, 'imesGet'])->name('ogretmen.imesget');
        Route::get('ime/{id}', [OgretmenController::class, 'imeGet'])->whereNumber('id')->name('ogretmen.imeget');
        Route::patch('ime/{id}', [OgretmenController::class, 'imePatch'])->whereNumber('id')->name('ogretmen.imepatch');
    }
);

Route::group(
    [
        'middleware' => ['auth','isYonetici'],
        'prefix' => 'yonetici'
    ],
    function () {

        Route::get('stajlar', [YoneticiController::class, 'stajlarGet'])->name('yonetici.stajlarget');
        Route::get('staj/{id}', [YoneticiController::class, 'stajGet'])->whereNumber('id')->name('yonetici.stajget');
        Route::patch('staj/{id}', [YoneticiController::class, 'stajPatch'])->whereNumber('id')->name('yonetici.stajpatch');
        Route::delete('staj/{id}', [YoneticiController::class, 'stajDelete'])->whereNumber('id')->name('yonetici.stajdelete');

        Route::get('imes', [YoneticiController::class, 'imesGet'])->name('yonetici.imesget');
        Route::get('ime/{id}', [YoneticiController::class, 'imeGet'])->whereNumber('id')->name('yonetici.imeget');
        Route::patch('ime/{id}', [YoneticiController::class, 'imePatch'])->whereNumber('id')->name('yonetici.imepatch');
        Route::delete('ime/{id}', [YoneticiController::class, 'imeDelete'])->whereNumber('id')->name('yonetici.imedelete');

        Route::get('imesecim', [YoneticiController::class, 'imeSecimGet'])->name('yonetici.imesecimget');
        Route::post('imesecim', [YoneticiController::class, 'imeSecimPost'])->name('yonetici.imesecimpost');

        Route::get('kullaniciekle', [YoneticiController::class, 'kullaniciEkleGet'])->name('yonetici.kullaniciekleget');
        Route::post('kullaniciekle', [YoneticiController::class, 'kullaniciEklePost'])->name('yonetici.kullanicieklepost');

        Route::get('kullanicilar', [YoneticiController::class, 'kullanicilarGet'])->name('yonetici.kullanicilarget');
        Route::get('kullanici/{id}', [YoneticiController::class, 'kullaniciGet'])->whereNumber('id')->name('yonetici.kullaniciget');
        Route::patch('kullanici/{id}', [YoneticiController::class, 'kullaniciPatch'])->whereNumber('id')->name('yonetici.kullanicipatch');
        Route::delete('kullanici/{id}', [YoneticiController::class, 'kullaniciDelete'])->whereNumber('id')->name('yonetici.kullanicidelete');

        Route::get('kullanicilarekle', [YoneticiController::class, 'kullanicilarEkleGet'])->name('yonetici.kullanicilarekleget');
        Route::post('kullanicilarekle', [YoneticiController::class, 'kullanicilarEklePost'])->name('yonetici.kullanicilareklepost');
    }
);

Route::group(
    [
        'middleware' => ['auth','isSuperYonetici'],
        'prefix' => 'yonetici'
    ],
    function () {

        Route::get('stajlar', [YoneticiController::class, 'stajlarGet'])->name('yonetici.stajlarget');
        Route::get('staj/{id}', [YoneticiController::class, 'stajGet'])->whereNumber('id')->name('yonetici.stajget');
        Route::patch('staj/{id}', [YoneticiController::class, 'stajPatch'])->whereNumber('id')->name('yonetici.stajpatch');
        Route::delete('staj/{id}', [YoneticiController::class, 'stajDelete'])->whereNumber('id')->name('yonetici.stajdelete');

        Route::get('imes', [YoneticiController::class, 'imesGet'])->name('yonetici.imesget');
        Route::get('ime/{id}', [YoneticiController::class, 'imeGet'])->whereNumber('id')->name('yonetici.imeget');
        Route::patch('ime/{id}', [YoneticiController::class, 'imePatch'])->whereNumber('id')->name('yonetici.imepatch');
        Route::delete('ime/{id}', [YoneticiController::class, 'imeDelete'])->whereNumber('id')->name('yonetici.imedelete');

        Route::get('imesecim', [YoneticiController::class, 'imeSecimGet'])->name('yonetici.imesecimget');
        Route::post('imesecim', [YoneticiController::class, 'imeSecimPost'])->name('yonetici.imesecimpost');

        Route::get('kullaniciekle', [YoneticiController::class, 'kullaniciEkleGet'])->name('yonetici.kullaniciekleget');
        Route::post('kullaniciekle', [YoneticiController::class, 'kullaniciEklePost'])->name('yonetici.kullanicieklepost');

        Route::get('kullanicilar', [YoneticiController::class, 'kullanicilarGet'])->name('yonetici.kullanicilarget');
        Route::get('kullanici/{id}', [YoneticiController::class, 'kullaniciGet'])->whereNumber('id')->name('yonetici.kullaniciget');
        Route::patch('kullanici/{id}', [YoneticiController::class, 'kullaniciPatch'])->whereNumber('id')->name('yonetici.kullanicipatch');
        Route::delete('kullanici/{id}', [YoneticiController::class, 'kullaniciDelete'])->whereNumber('id')->name('yonetici.kullanicidelete');

        Route::get('kullanicilarekle', [YoneticiController::class, 'kullanicilarEkleGet'])->name('yonetici.kullanicilarekleget');
        Route::post('kullanicilarekle', [YoneticiController::class, 'kullanicilarEklePost'])->name('yonetici.kullanicilareklepost');
    }
);

