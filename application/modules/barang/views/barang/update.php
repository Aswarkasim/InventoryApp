<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">AA</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-warning"></i> ', '</div>');
                ?>

                <form action="<?= base_url('barang/update/' . $barang->id_barang) ?>" method="post">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">ID Barang</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" disabled name="id_barang" class="form-control" value="<?= $barang->id_barang ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Nama Barang</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" value="<?= $barang->nama_barang ?>" name="nama_barang" class="form-control" placeholder="Nama Barang">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Jenis Barang</label>
                            </div>
                            <div class="col-md-9">
                                <select name="id_jenis" id="" class="form-control select2">
                                    <option value="none">-- Jenis Barang --</option>
                                    <?php foreach ($jenis as $row) { ?>
                                        <option value="<?= $row->id_jenis ?>" <?php if (($row->id_jenis) == $barang->id_jenis) {
                                                                                    echo "selected";
                                                                                } ?>><?= $row->nama_jenis ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="pull-right">Satuan</label>
                            </div>
                            <div class="col-md-9">
                                <select name="id_satuan" id="" class="form-control select2">
                                    <option value="none">-- Satuan Barang --</option>
                                    <?php foreach ($satuan as $row) { ?>
                                        <option value="<?= $row->id_satuan ?>" <?php if (($row->id_satuan) == $barang->id_satuan) {
                                                                                    echo "selected";
                                                                                } ?>><?= $row->nama_satuan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-9">
                                <a href="<?= base_url($back) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>

                </form>



            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>