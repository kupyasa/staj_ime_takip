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
        Schema::create('stajs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ogrenci_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('ogretmen_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->string('onayli_staj_basvurusu')->nullable();
            $table->string('onayli_staj_basvurusu_id')->nullable();
            $table->string('firma');
            $table->string("staj_tipi");
            $table->string("yil_donem")->default('Girilmemiş');
            $table->string("onay_durumu");
            $table->string("gun_sayisi");
            $table->date("baslangic_tarihi");
            $table->date("bitis_tarihi");
            $table->string('ogrenci_adres');
            $table->string('ogrenci_il');
            $table->string('ogrenci_ilce');
            $table->string('ogrenci_posta_kodu');
            $table->string('ogrenci_eposta');
            $table->string('ogrenci_telefon');
            $table->string('firma_faaliyet_alani');
            $table->string('firma_adres');
            $table->string('firma_il');
            $table->string('firma_ilce');
            $table->string('firma_posta_kodu');
            $table->string('firma_fax');
            $table->string('firma_telefon');
            $table->string('firma_eposta');
            $table->string("not")->nullable();
            $table->string("kabul_edilen_gun_sayisi")->nullable();
            $table->string('staj_raporu')->nullable();
            $table->string('staj_degerlendirme_formu')->nullable();
            $table->string('staj_devlet_katki_payi')->nullable();
            $table->string('staj_raporu_id')->nullable();
            $table->string('staj_degerlendirme_formu_id')->nullable();
            $table->string('staj_devlet_katki_payi_id')->nullable();
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
        Schema::dropIfExists('stajs');
    }
};
