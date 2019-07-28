<?php

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('times', '', 10);
$pdf->AddPage();
$html = '<h2 align="center">LAPORAN STOK BARANG</h2><hr>
<table border="1" width="730" cellpadding="5">
            <thead>
                <tr align="center">
                    <th width="30"><b>NO</b></th>
                    <th><b>ID BARANG</b></th>
                    <th><b>NAMA BARANG</b></th>
                    <th><b>JENIS BARANG</b></th>
                    <th><b>STOK BARANG</b></th>
                </tr>
            </thead>';
$no = 1;
foreach ($barang as $row) {
    $html .= '
    <tbody>
        <tr align="center">
            <td width="30">' . $no . '</td>
            <td>' . $row->id_barang . '</td>
            <td>' . $row->nama_barang . '</td>
            <td>' . $row->nama_jenis . '</td>
            <td>' . $row->stok . ' ' . $row->nama_satuan . '</td>
        </tr>
    </tbody>
    ';
    $no++;
}
$html .= '</table><br><br><br><br><br><br>
<table align="left">
    <tr>
        <td>Makassar, 07 July 2019</td>
    </tr>
    <tr>
        <td>Pimpinan Perusahaan</td>
    </tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr>
        <td>Nama Anda</td>
    </tr>
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output('example_006.pdf', 'I');
