<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ogrenci_id')->constrained('users')->cascadeOnUpdate();
            $table->string('onayli_ime_basvurusu')->nullable();
            $table->string('onayli_ime_basvurusu_id')->nullable();
            $table->string('firma')->nullable();
            $table->string("yil_donem")->nullable();
            $table->string("onay_durumu");
            $table->date("baslangic_tarihi")->nullable();
            $table->date("bitis_tarihi")->nullable();
            $table->string("gun_sayisi")->nullable();
            $table->string('ogrenci_adres')->nullable();
            $table->string('ogrenci_il')->nullable();
            $table->string('ogrenci_ilce')->nullable();
            $table->string('ogrenci_posta_kodu')->nullable();
            $table->string('ogrenci_eposta')->nullable();
            $table->string('ogrenci_telefon')->nullable();
            $table->string('firma_faaliyet_alani')->nullable();
            $table->string('firma_adres')->nullable();
            $table->string('firma_il')->nullable();
            $table->string('firma_ilce')->nullable();
            $table->string('firma_posta_kodu')->nullable();
            $table->string('firma_fax')->nullable();
            $table->string('firma_telefon')->nullable();
            $table->string('firma_eposta')->nullable();
            $table->foreignId('ogretmen_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->string("not")->nullable();
            $table->string("kabul_edilen_gun_sayisi")->nullable();
            $table->string('ime_raporu')->nullable();
            $table->string('ime_denetleme_formu')->nullable();
            $table->string('ime_degerlendirme_formu')->nullable();
            $table->string('ime_raporu_id')->nullable();
            $table->string('ime_denetleme_formu_id')->nullable();
            $table->string('ime_degerlendirme_formu_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imes');
    }
};
