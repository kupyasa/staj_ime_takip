<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Anasayfa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="text-center">Staj ve İME İlgili Dosyalar</h2>
                <h3 class="text-center my-4">Staj Dosyaları</h3>
                <p class="text-center">
                    <a href="{{ asset('staj/StajAkisDiyagrami.pdf') }}" target="_blank">
                        <b>Staj Akış Diyagramı</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/StajEsaslari.pdf') }}" target="_blank">
                        <b>Staj Esasları</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/staj-I_II-takvimi.pdf') }}" target="_blank">
                        <b>Staj Takvimi</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/Staj-I_II-Isyeri-Egitimi-Beyani.pdf') }}" target="_blank">
                        <b>Staj-İşyeri Eğitimi Beyanı</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/sigorta-beyani.pdf') }}" target="_blank">
                        <b>Sigorta Beyanı</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/devletkatkitalepformu.xlsx') }}" target="_blank">
                        <b>Devlet Katkı Talep Formu</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/StajBasvuruKabulFormu.doc') }}" target="_blank">
                        <b>Staj Başvuru Kabul Formu</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/stajraporu.docx') }}" target="_blank">
                        <b>Staj Raporu</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('staj/stajdegerlendirmeformu.doc') }}" target="_blank">
                        <b>Staj Değerlendirme Formu</b>
                    </a>
                </p>
                <h3 class="text-center my-4">İME Dosyaları</h3>
                <p class="text-center">
                    <a href="{{ asset('ime/ime_akisDiyagrami.pdf') }}" target="_blank">
                        <b>İME Akış Diyagramı</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('ime/ime_yonerge.doc') }}" target="_blank">
                        <b>İME Yönerge</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('ime/isyerikabulformu.doc') }}" target="_blank">
                        <b>İME Kabul Formu</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('ime/Ek4-RaporYazimKurallari.doc') }}" target="_blank">
                        <b>İME Rapor Yazım Kuralları</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('ime/ime_DegerlendirmeFormu.doc') }}" target="_blank">
                        <b>İME Değerlendirme Formu</b>
                    </a>
                </p>
                <p class="text-center">
                    <a href="{{ asset('ime/ime_DenetimFormu.doc') }}" target="_blank">
                        <b>İME Denetim Formu</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
