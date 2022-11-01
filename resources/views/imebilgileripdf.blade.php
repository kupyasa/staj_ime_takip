<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .title {
            text-align: center;
            line-height: 0.25em;
            margin: 0.2em;
            padding: 0.2em;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
            margin-right: 7.5em;
        }


        .text {
            font-size: 0.75em;
            line-height: 0.75em;
            margin-left: auto;
            margin-right: auto;
        }

        .bold {
            font-weight: bold;
        }

        td,
        th {
            border: 1px solid silver;
            text-align: left;
            padding: 0.25em
        }

        .center {
            margin-left: auto;
            margin-right: auto;
            width: 85%;
        }

        table {
            border-spacing: 0;
            margin: 1em;
        }

        .center_text {
            text-align: center;
        }

        h6 {
            line-height: 0.25em;
            margin: 0.2em;
            padding: 0.2em;
        }
    </style>
    <title>İME Bilgileri</title>
</head>

<body>
    <h6 class="title">{{$ogrenci_ad_soyad}} İşletmede Mesleki Eğitim Bilgileri</h6>
    <table class="center">
        <tr>
            <th class="text">Ad Soyad</th>
            <td class="text" colspan="3">{{$ogrenci_ad_soyad}}</td>
        </tr>
        <tr>
            <th class="text">Öğrenci Numarası</th>
            <td class="text" colspan="3">{{$ogrenci_sicil_no}}</td>
        </tr>
        <tr>
            <th class="text">Ev Tel /GSM</th>
            <td class="text" colspan="3">{{ $ogrenci_telefon }}</td>
        </tr>
        <tr>
            <th class="text">E-Posta</th>
            <td class="text" colspan="3">{{ $ogrenci_eposta }}</td>
        </tr>
        <tr>
            <th class="text" rowspan="2" colspan="1">Öğrenci Adres</th>
            <td class="text" colspan="3">{{ $ogrenci_adres }}</td>
        </tr>
        <tr>
            <td class="text" colspan="1">İl: {{ $ogrenci_il }}</td>
            <td class="text" colspan="1">İlçe: {{ $ogrenci_ilce }}</td>
            <td class="text" colspan="1">Posta Kodu: {{ $ogrenci_posta_kodu }}</td>
        </tr>
        <tr>
            <th class="text">Firma</th>
            <td class="text" colspan="3">{{ $firma }}</td>
        </tr>
        <tr>
            <th class="text">Firma Faaliyet Alanı</th>
            <td class="text" colspan="3">{{ $firma_faaliyet_alani}}</td>
        </tr>
        <tr>
            <th class="text" rowspan="2" colspan="1">Firma Adres</th>
            <td class="text" colspan="3">{{ $firma_adres }}</td>
        </tr>
        <tr>
            <td class="text" colspan="1">İl: {{ $firma_il }}</td>
            <td class="text" colspan="1">İlçe: {{ $firma_ilce }}</td>
            <td class="text" colspan="1">Posta Kodu: {{ $firma_posta_kodu }}</td>
        </tr>
        <tr>
            <th class="text">Firma Telefon</th>
            <td class="text" colspan="3">{{ $firma_telefon  }}</td>
        </tr>
        <tr>
            <th class="text">Firma Fax</th>
            <td class="text" colspan="3">{{ $firma_fax }}</td>
        </tr>
        <tr>
            <th class="text">Firma Eposta</th>
            <td class="text" colspan="3">{{ $firma_eposta }}</td>
        </tr>
        <tr>
            <th class="text">Yıl Dönem</th>
            <td class="text" colspan="3">{{ $yil_donem }}</td>
        </tr>
        <tr>
            <th class="text">Başlangıç Tarihi</th>
            <td class="text" colspan="3">{{ $baslangic_tarihi }}</td>
        </tr>
        <tr>
            <th class="text">Bitiş Tarihi</th>
            <td class="text" colspan="3">{{ $bitis_tarihi }}</td>
        </tr>
        <tr>
            <th class="text">Gün Sayısı</th>
            <td class="text" colspan="3">{{ $gun_sayisi }}</td>
        </tr>
        <tr>
            <th class="text">Başvuru Onay Durumu</th>
            <td class="text" colspan="3">{{ $onay_durumu_text ? $onay_durumu_text : 'Yok' }}</td>
        </tr>
        <tr>
            <th class="text">Öğretmen</th>
            <td class="text" colspan="3">{{ $ogretmen_ad_soyad ? $ogretmen_ad_soyad : "Yok" }}</td>
        </tr>
        <tr>
            <th class="text">Not</th>
            <td class="text" colspan="3">{{ $not_text ? $not_text : 'Girilmedi' }}</td>
        </tr>
        <tr>
            <th class="text">Yıl Dönem</th>
            <td class="text" colspan="3">{{ $kabul_edilen_gun_sayisi_text ? $kabul_edilen_gun_sayisi_text : 'Girilmedi'}}</td>
        </tr>
    </table>
</body>

</html>
