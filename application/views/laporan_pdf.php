<?php
$barang = $this->Crud_model->listing('tbl_barang');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('times', '', 10);
$pdf->AddPage();
$html = '<table border="1" width="730">
            <thead>
                <tr align="center">
                    <th width="30">NO</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Stok Barang</th>
                    <th>Satuan Barang</th>
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
            <td></td>
            <td>' . $row->stok . '</td>
            <td></td>
        </tr>
    </tbody>
    ';
    $no++;
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output('example_006.pdf', 'I');
