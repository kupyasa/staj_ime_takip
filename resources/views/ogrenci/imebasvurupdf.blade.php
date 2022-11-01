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
    <title>İME Kabul Formu</title>
</head>

<body>
    <h6 class="title">T.C.</h6>
    <h6 class="title">KOCAELİ ÜNİVERSİTESİ</h6>
    <h6 class="title">{{ $fakulte }} Fakültesi</h6>
    <h6 class="title">İşletmede Mesleki Eğitim Başvuru ve Kabul formu</h6>
    <h6 class="right">Tarih : {{ date('d/m/Y') }}</h6>
    <h6 class="title">İLGİLİ MAKAMA</h6>
    <p class="text center_text">{{ $fakulte }} Fakültesi {{ $bolum }} Bölümü {{ $ogrenci_no }} numaralı
        öğrencisiyim. Kurumunuzda İşletmede Mesleki Eğitimimi yapmamın uygun görülmesi halinde bu formun alttaki kısmını doldurularak fakültemiz ilgili bölüm başkanlığına gönderilmesini saygılarımla arz ederim.
        İşyeri uygulaması süresi içerisinde alınan rapor, istirahat vb. belgelerin aslını alınan gün içerisinde bölüm başkanlığına bildireceğimi <span class="bold"> beyan ve taahhüt ederim.</span></p>

    <table class="center">
        <tr>
            <th class="text">Ad Soyad</th>
            <td class="text" colspan="3">{{ $ad_soyad }}</td>
        </tr>
        <tr>
            <th class="text">T.C. Kimlik Numarası</th>
            <td class="text" colspan="3">{{ $tc_no }}</td>
        </tr>
        <tr>
            <th class="text">Ev Tel /GSM</th>
            <td class="text" colspan="1">{{ $ogrenci_telefon }}</td>
            <th class="text">E-Posta</th>
            <td class="text" colspan="1">{{ $ogrenci_eposta }}</td>
        </tr>
        <tr>
            <th class="text">IBAN No
                ZİRAAT BANKASI</th>
            <td class="text" colspan="3">{{ $iban }}</td>
        </tr>
        <tr>
            <th class="text" rowspan="2" colspan="1">Adres</th>
            <td class="text" colspan="3">{{ $ogrenci_adres }}</td>
        </tr>
        <tr>
            <td class="text" colspan="1">İl: {{ $ogrenci_il }}</td>
            <td class="text" colspan="1">İlçe: {{ $ogrenci_ilce }}</td>
            <td class="text" colspan="1">Posta Kodu: {{ $ogrenci_posta_kod }}</td>
        </tr>
    </table>

    <table class="center">
        <tr>
            <th class="text center_text" colspan="3">İşyeri Eğitimi Bilgileri* **</th>
        </tr>
        <tr>
            <th class="text" colspan="1">Başlama Tarihi: {{ date('d/m/Y', strtotime($ime_baslangic)) }}</th>
            <th class="text" colspan="1">Bitiş Tarihi: {{ date('d/m/Y', strtotime($bitis_tarihi)) }}</th>
            <th class="text" colspan="1">İş Günü : {{ $gun_sayisi }}</th>
        </tr>
    </table>

    <table class="center">
        <tr>
            <th class="text">Ailemden, Kendimden veya Anne-Baba Üzarinden Genel Sağlık Sigortası Kapsamında Sağlık
                Hizmeti Alıyorum</th>
            <th class="text">{{ $saglik_check ? 'Evet' : 'Hayır' }}</th>
        </tr>
        <tr>
            <th class="text">Genel Sağlık Sigortası (GSS) (Gelir Testi Yaptırdım
                Pirim Ödüyorum)</th>
            <th class="text">{{ $gss_check ? 'Evet' : 'Hayır' }}</th>
        </tr>
        <tr>
            <th class="text">25 Yaşını Doldurdum</th>
            <th class="text">{{ $yas_25_check ? 'Evet' : 'Hayır' }}</th>
        </tr>
    </table>

    <h6 class="right">Tarih : {{ date('d/m/Y') }}</h6>
    <h6 class="right">Ad Soyad:{{ $ad_soyad }}</h6>
    <h6 class="right" style="margin-right: 14.5em">İmza:</h6>

    <table class="center">
        <tr>
            <th class="text center_text" colspan="4">İşletmede Mesleki Eğitim Yapılacak Kurum Bilgileri</th>
        </tr>
        <tr>
            <th class="text" colspan="1">Resmi Adı</th>
            <td class="text" colspan="3">{{ $firma_resmi_ad }}</td>
        </tr>
        <tr>
            <th class="text" colspan="1">Faaliyet Alanı</th>
            <td class="text" colspan="3">{{ $firma_faaliyet_alani }}</td>
        </tr>
        <tr>
            <th class="text" rowspan="2" colspan="1">Firma Adres</th>
            <td class="text" colspan="3">{{ $firma_adres }}</td>
        </tr>
        <tr>
            <td class="text" colspan="1">İl: {{ $firma_il }}</td>
            <td class="text" colspan="1">İlçe: {{ $firma_ilce }}</td>
            <td class="text" colspan="1">Posta Kodu: {{ $firma_posta_kod }}</td>
        </tr>
        <tr>
            <th class="text" colspan="1">İletişim Bilgileri</th>
            <td class="text" colspan="1">Telefon: {{ $firma_telefon }}</td>
            <td class="text" colspan="1">Fax: {{ $firma_fax }}</td>
            <td class="text" colspan="1">Eposta: {{ $firma_eposta }}</td>
        </tr>
        <tr>
            <th class="text" colspan="1">İşyeri Sorumlusunun Unvanı</th>
            <td class="text" colspan="3">{{ $sorumlu_unvan }}</td>
        </tr>
    </table>
    <p class="text center_text" style="font-size: 0.6em">Yukarıda adı geçen öğrencinin ilgili tarihlerde İşyeri Eğitimi uygulamasını kurumumuzda yapması uygun görülmüştür.</p>
    <h6 class="right" style="margin-right: 14.5em">Ad Soyad:</h6>
    <h6 class="right" style="margin-right: 14.5em">Unvan:</h6>
    <h6 class="right" style="margin-right: 14.5em">İmza:</h6>
    <br>
    <p class="text center_text bold" style="font-size: 0.5em">*3308 sayılı Meslekî Eğitim Kanunu ve 5510 sayılı Sosyal Sigortalar ve Genel Sağlık Sigortası Kanununun 5 inci maddesinin (b) bendi gereğince zorunlu staja tabi tüm öğrencilere "İş Kazası ve Meslek Hastalığı Sigortası" yapılması ve sigorta primlerinin Üniversite tarafından ödenmesi gerekmektedir.  Staj süresi boyunca üniversitemiz tarafından öğrencimizin SGK’ya kaydı yaptırılacaktır.
    </p>
    <p class="text center_text bold" style="font-size: 0.5em">**Staja SGK sicil numarası alındıktan sonra başlayacaktır. Farklı firmalarda yapılacak stajlar için ayrı form doldurulacaktır. Öğrenci bu evraktan 2 nüsha düzenleyip firmaca onaylandıktan sonra bir tanesini belirlenen staj döneminden en az 1 ay önce ilgili bölüm başkanlığına teslim etmek zorundadır.</p>


    <table class="center">
        <tr>
            <th class="text center_text" colspan="1">T.C. Kocaeli Üniversitesi {{ $fakulte }} Fakültesi
                Bölüm İme ve Staj Komisyonu Onayı</th>
            <th class="text center_text" colspan="1" style="font-size: 0.5em">Yukarıda adı geçen öğrencinin ilgili
                tarihlerde
                İşyeri Eğitimi uygulamasını ilgili kurumda yapması <p style="display: inline-block;text-align:left">Uygundur
                <span style="margin-left:4em"> Uygun değildir</span>
                </p>

            </th>
            <th class="text" colspan="1">ONAY</th>
        </tr>
        <tr>
            <th class="text" colspan="3">Not: </th>
        </tr>
    </table>
</body>

</html>
