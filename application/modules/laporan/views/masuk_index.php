<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Laporan Barang Masuk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?= base_url('laporan/cetak_masuk') ?>" method="post" target="_blank">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="awal">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Sampai Dengan</label>
                            <input type="date" class="form-control" name="akhir">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>