<div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Manajemen User</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <p>
            <a href="<?= base_url('barang/barang/add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
        </p>

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
                        <th></th>
                    </tr>
                </thead>
                <tbody id="targetData">

                </tbody>
            </table>

        </div>
    </div>
    <!-- /.box-body -->
</div>


<script>
    dataBarang();

    function dataBarang() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() . "barang/barang/barangData"  ?>',
            dataType: 'json',
            success: function(data) {
                var baris = '';

                for (var i = 0; i < data.length; i++) {
                    baris += '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + data[i].id_barang + '</td>' +
                        '<td>' + data[i].nama_barang + '</td>' +
                        '<td>' + data[i].nama_jenis + '</td>' +
                        '<td>' + data[i].stok + '</td>' +
                        '<td>' + data[i].nama_satuan + '</td>' +
                        '<td>' +
                        '<a href="<?= base_url('barang/update/') ?>' + data[i].id_barang + '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>' +
                        '<a href="<?= base_url('barang/delete/') ?>' + data[i].id_barang + '" class="btn btn-danger btn-xs" onclick="return confirm()"><i class="fa fa-trash"></i></a>' +
                        '</td>' +
                        '</tr>';
                }
                $('#targetData').html(baris);
            }
        })
    }

    // Tommbol hapus
    $('.tombol-hapus').on('click', function(e) {
        // Mematikan href
        e.preventDefault();
        const href = $(this).attr('href');

        Swal({
            title: 'Apakah anda yakin ingin menghapus?',
            text: "data akan dihapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
</script>