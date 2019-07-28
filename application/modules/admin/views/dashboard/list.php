<p>
    <h4><i class="fa fa-warning"></i> Stok telah mencapai batas minimum</h4>
</p>
<div class="table-responsive">
    <table class="table DataTable table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody id="targetData">
            <?php $no = 1;
            foreach ($min_barang as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->id_barang ?></td>
                    <td><?= $row->nama_barang ?></td>
                    <td><?= $row->nama_jenis ?></td>
                    <td><?= $row->stok ?></td>
                    <td><?= $row->nama_satuan ?></td>
                </tr>
                <?php $no++;
            } ?>
        </tbody>
    </table>

</div>