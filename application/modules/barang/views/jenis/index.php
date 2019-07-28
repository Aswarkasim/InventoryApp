<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manajemen Jenis</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <p>
                    <a href="<?= base_url('barang/jenis/add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                </p>
                <div class="table-responsive">
                    <table class="table DataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Jenis</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jenis as $row) { ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->nama_jenis ?></td>
                                    <td>
                                        <a href="<?= 'jenis/update/' . $row->id_jenis ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="<?= 'jenis/delete/' . $row->id_jenis ?>" class="btn btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>