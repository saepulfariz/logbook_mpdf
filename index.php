<?php

require_once __DIR__ . '/vendor/autoload.php';



function base_url()
{
    return 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
}



$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'default_font' => 'Serif']);

// Define the Header/Footer before writing anything so they appear on the first page

// <img src="' . base_url() . '/unsub.png">


$headeNew = '<table width="100%">
<tr>
    <td width="80px"><img width="100" style="" src="unsub.png"></td>
    <td width="" align="center"><div style="text-align: center;margin-left: -20px;">

    <p style="font-size: 17px; margin: 0;">UNIVERSITAS SUBANG</p>
    <p style="font-size: 22px; margin: 0;font-weight: bold;">FAKULTAS ILMU KOMPUTER</p>
    <p style="font-size: 13px; margin: 0;font-weight: bold;">Akreditasi: B SK BAN PT No: 6453/SK/BAN-PT/Akred/S/X/2020</p>
    <p style="font-size: 13px; margin: 0;">Jalan R.A Kartini KM 3 Telp (0260) 411415 Subang</p>
    <p style="font-size: 13px; margin: 0;">Email : <font color="blue"><a style="color: blue;" href"mailto:fasilkom@unsub.ac.id">fasilkom@unsub.ac.id</a></font></p>
    </div></td>
    </tr>
    </table>
    <hr style="height: 2px; background-color: #000;">
';


$headeOld = '
<div style="text-align: center;position: relative;">

    <p style="font-size: 17px; margin: 0;">UNIVERSITAS SUBANG</p>
    <p style="font-size: 22px; margin: 0;font-weight: bold;">FAKULTAS ILMU KOMPUTER</p>
    <p style="font-size: 13px; margin: 0;font-weight: bold;">Akreditasi: B SK BAN PT No: 6453/SK/BAN-PT/Akred/S/X/2020</p>
    <p style="font-size: 13px; margin: 0;">Jalan R.A Kartini KM 3 Telp (0260) 411415 Subang</p>
    <p style="font-size: 13px; margin: 0;">Email : <font color="blue"><a style="color: blue;" href"mailto:fasilkom@unsub.ac.id">fasilkom@unsub.ac.id</a></font></p>
    <hr style="height: 2px; background-color: #000;">
</div>

<img width="100" style="margin-top: -100px;" src="unsub.png">';

$mpdf->SetHTMLHeader($headeNew);
$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">By Saepulfariz</td>
    </tr>
</table>');

$list = '';
for ($i = 1; $i < 50; $i++) {
    $list .= '<tr>
    <td style="text-align: center;">' . $i . '</td>
    <td style="text-align: center;">13/04/2023</td>
    <td style="text-align: center;">08:00 </td>
    <td style="text-align: center;">16:00</td>
    <td style="text-align: center;">Tulisankan kegiatan apa yang kang rebahan lakukan</td>
    <td style="text-align: center;">
    <img width="50" style="" src="signature.png">
    </td>
</tr>';
}


$html = '
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>@page {
    margin: 50px;
   }</style>
</head>
<body>
<div style="margin-top: 40px">
<div style="float: right;">

<table>
        <tr>
            <td style="width: 550px"></td>
            <td>
            <table border="1" cellpadding="5" cellspacing="0">
        <tr >
            <td style="font-weight: bold;">FORM</td>
            <td style="font-weight: bold;">PI-01</td>
        </tr>   
    </table>
            
            </td>
        </tr>
    </table>

    
</div>

<div style="text-align: center; font-weight:bold;margin-top: 20px;">
    LOGBOOK AKTIVITAS HARIAN PROYEK STUDI/PROYEK INDEPENDEN
</div>

<div style="margin-top: 15px">
    <table>
        <tr>
            <td style="width: 250px">Nama</td>
            <td>:</td>
            <td>..................................................................................</td>
        </tr>
        <tr>
            <td style="width: 250px">NPM</td>
            <td>:</td>
            <td>..................................................................................</td>
        </tr>
    </table>
</div>


<div style="margin-top: 20px">
<table border="1" cellpadding="5" cellspacing="0">
<thead>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Mulai</th>
    <th>Selesai</th>
    <th>Penjelasan Kegiatan</th>
    <th>Paraf</th>
</tr>
</thead>
<tbody>

' . $list . '
</tbody>
</table>
</div>





</div>
</body>
</html>';
// $mpdf->AddPage();
// $mpdf->Image('unsub.png', 10, 6, 30, 30, 'png', '', true, false);


// $wm = base_url() . 'unsub.png';
// $mpdf->SetWatermarkImage($wm);
// $mpdf->showWatermarkImage = true;
$mpdf->AddPageByArray([
    'margin-left' => '15',
    'margin-right' => '20',
    'margin-top' => '45',
    'margin-bottom' => '15',
]);
$mpdf->WriteHTML($html);

// $mpdf->AddPage();
// $mpdf->Image('unsub.png', 10, 6, 30, 30, 'png', '', true, false);
// $mpdf->WriteHTML($html);


$mpdf->Output();
$mpdf->Output(date('Y-m-d') . '.pdf', 'F');
