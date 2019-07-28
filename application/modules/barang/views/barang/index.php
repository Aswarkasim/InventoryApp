<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Barang</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php
        if ($this->session->userdata('role') == "Admin") {
            ?>
            <p>
                <a href="<?= base_url('barang/barang/add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </p>
        <?php } ?>

        <form action="<?= base_url('barang/cari') ?>" method="post">
            <div class="row">
                <div class="col-md-offset-2 col-md-6">
                    <div class="form-gorup">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Cari Berdasarkan</label>
                            </div>
                            <div class="col-md-9">
                                <select name="cariberdasarkan" class="form-control" id="">
                                    <option value="">--Cari Berdasarkan--</option>
                                    <option value="id_barang">ID Barang</option>
                                    <option value="nama_barang">Nama Barang</option>
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <div class="form-gorup">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Cari</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="yangdicari" class="form-control">
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </div>
        </form>
        <?= form_close()  ?>

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
                        <?php if ($this->session->userdata('role') == "Admin") { ?>
                            <th></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody id="targetData">
                    <?php $no = 1;
                    foreach ($barang as $row) { ?>
                        <tr>
                            <td width="100px"><?= $no ?></td>
                            <td><?= $row->id_barang ?></td>
                            <td><?= $row->nama_barang ?></td>
                            <td><?= $row->nama_jenis ?></td>
                            <td><?= $row->nama_satuan ?></td>
                            <td><?= $row->stok ?></td>
                            <?php if ($this->session->userdata('role') == "Admin") { ?>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success"><i class="fa fa-cogs"></i></button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?= base_url('transaksi/barang/edit/' . $row->id_barang) ?>"><i class="fa fa-edit"></i> Edit</a></li>
                                            <li><a href="<?= base_url('transaksi/barang/delete/' . $row->id_barang) ?>" class="tombol-hapus"><i class="fa fa-trash"></i>Hapus</a></li>
                                        </ul>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php $no++;
                    } ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- /.box-body -->
</div>