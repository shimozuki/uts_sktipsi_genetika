<?php $this->app->extend('template/dosen') ?>

<?php $this->app->setVar('title', 'Seminar Akhir') ?>

<?php $this->app->section() ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Cari Mahasiswa : </div>
        <form id="form_cari" action="<?= base_url('hasil-pencarian-mahasiswa'); ?>" method="POST" onsubmit="disableBtn()">
            <input type="hidden" name="level" value="Dosen">
            <select class="select2" name="id" required id="wadah_select2">

            </select>
            <button class="btn btn-primary mt-3 btn-act" type="sumbit">Lihat Selengkapnya <i class="fa fa-chevron-right"></i></button>
        </form>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <div class="card-title">Seminar Akhir / Skripsi</div>
            </div>
            <!-- <div class="col text-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
            </div> -->
        </div>
        <div class="card-tools mt-2">
            <span class="badge badge-success"><i class="fa fa-check"></i> Disetujui</span>
            <span class="badge badge-danger ml-3"><i class="fa fa-times"></i> Belum/Tidak Disetujui</span>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <small>(Klik tombol X untuk menyetujui atau tombol Ceklis untuk batal menyetujui</small><br />
            <small>Dosen hanya dapat mengkonfirmasi seminar akhir / skripsi mahasiswa bimbingannya</small>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="data-skripsi">
                <thead>
                    <tr>
                    <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Status</th>
                        <th>Judul Skripsi</th>
                        <th>Dosen Pembimbing</th>
                        <th>Dosen Penguji 1</th>
                        <th>Dosen Penguji 2</th>
                        <th>Jadwal Skripsi</th>
                        <th>Persetujuan</th>
                        <th>File Skripsi</th>
                        <th>Ruangan</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="setujui">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="setujui">
                <div class="modal-header">
                    <div class="modal-title">Status Skripsi</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <input type="hidden" class="status">
                    <p>Anda yakin <span class="status">mengetujui / batal menyetujui</span> skripsi <strong class="judul">Judul Proposal</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        getDataSelect()
        show = () => {
            $('#data-skripsi').DataTable().destroy();
            $('#data-skripsi').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/skripsi/admin_index",
                    "method": "POST",
                    "data": {
                        user_id: "<?= $this->session->userdata('id') ?>"
                    },
                    "dataSrc": "data"
                },
                "columns": [
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "nim"
                    },
                    {
                        data: "siswa"
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (data.status == '1') {
                                status = '\
                            <button class="btn btn-sm btn-setuju btn-success" type="button" data-id="' + data.id + '" data-judul_skripsi="' + data.judul_skripsi + '" data-status="' + data.status + '" data-toggle="modal" data-target="#setujui">\
                                <i class="fa fa-check"></i>\
                            </button>\
                            ';
                            } else {
                                status = '\
                            <button class="btn btn-sm btn-setuju btn-danger" type="button" data-id="' + data.id + '" data-judul_skripsi="' + data.judul_skripsi + '" data-status="' + data.status + '" data-toggle="modal" data-target="#setujui">\
                                <i class="fa fa-times"></i>\
                            </button>\
                            ';
                            }
                            return '\
                            <div class="text-center">' + status + '</div>\
                            ';
                        }
                    },
                    {
                        data: "judul_skripsi"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data.pembimbing_1 + '<br /> ' + data.pembimbing_2
                        }
                    },
                    {
                        data: "penguji_1"
                    },
                    {
                        data: "penguji_2"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data.tanggal + ' ' + data.jam
                        }
                    },
                    {
                        data: "persetujuan",
                        render: function(data) {
                            return '<a href="' + base_url + 'cdn/vendor/skripsi/persetujuan/' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: "file_skripsi",
                        render: function(data) {
                            return '<a href="' + base_url + 'cdn/vendor/skripsi/file_skripsi/' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: "tempat"
                    },
                    // {
                    //     data: null,
                    //     render: function(data) {
                    //         return '<div class="text-center">\
                    //         <button class="btn btn-sm btn-info btn-edit" type="button" data-toggle="modal" data-target="#edit" data-id="' + data.id + '" data-mahasiswa_id="' + data.mahasiswa_id + '" data-judul_skripsi="' + data.judul_skripsi + '" data-jadwal_skripsi="' + data.jadwal_skripsi + '" data-dosen_id="' + data.dosen_id + '" data-dosen_penguji_id="' + data.dosen_penguji_id + '" data-file_skripsi="' + data.file_skripsi + '" data-sk_tim="' + data.sk_tim + '" data-persetujuan="' + data.persetujuan + '" data-bukti_konsultasi="' + data.bukti_konsultasi + '">\
                    //             <i class="fa fa-pen"></i>\
                    //         </button>\
    				// 		<button class="btn btn-danger btn-sm btn-hapus" type="button" data-toggle="modal" data-target="#hapus" data-id="' + data.id + '">\
    				// 			<i class="fa fa-trash"></i>\
    				// 		</button>\
    				// 	</div>'
                    //     }
                    // }
                ],
                "language": {
                    "zeroRecords": "data tidak tersedia"
                }
            });
        }

        show();
    })

    function getDataSelect() {
        $.ajax({
            url: base_url + 'getAllData/mahasiswa',
            dataType: 'json',
            type: 'get',
            success: function(res) {
                data = '<option value=""></option>'
                $.each(res, function(i, item) {
                    data += '<option value="' + item.id + '">(' + item.nim + ') ' + item.nama + '</option>'
                })
                $("#wadah_select2").html(data)
            }
        })
    }

    function disableBtn() {
        $(".btn-act").attr('disabled', true).html('Loading ...')
    }

    $(document).on('click', 'button.btn-setuju', function() {
        $('form#setujui .id').val($(this).data('id'));
        $('form#setujui input.status').val($(this).data('status'));
        $('form#setujui span.status').html(($(this).data('status') == '1') ? 'batal menyetujui' : 'menyetujui');
        $('form#setujui .judul').html($(this).data('judul_skripsi'));
    })

    $(document).on('submit', 'form#setujui', function(e) {
        e.preventDefault();
        const id = $('form#setujui .id').val();
        call('api/skripsi/' + (($('form#setujui .status').val() == '1') ? 'disagree' : 'agree') + '/' + id).done(function(req) {
            if (req.error == true) {
                notif(req.message, 'error', true);
            } else {
                notif(req.message, 'success');
                $('div#setujui').modal('hide');
                show();
            }
        })
    })
</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>