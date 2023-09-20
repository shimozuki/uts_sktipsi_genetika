<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Seminar Akhir') ?>

<?php $this->app->section() ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Cari Mahasiswa : </div>
        <form id="form_cari" action="<?= base_url('hasil-pencarian-mahasiswa'); ?>" method="POST" onsubmit="disableBtn()">
            <input type="hidden" name="level" value="Admin">
            <select class="select2" name="id" required id="wadah_select2"> </select>
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
            <div class="col text-right">
            <button type="button" id="generateButton" class="btn btn-primary">Generate Jadwal</button>
            </div>
        </div>
        <div class="card-tools mt-2">
            <span class="badge badge-success"><i class="fa fa-check"></i> Disetujui</span>
            <span class="badge badge-danger ml-3"><i class="fa fa-times"></i> Belum/Tidak Disetujui</span>
        </div>
    </div>
    <div class="card-body">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit">
                <div class="modal-header">
                    <div class="modal-title">Edit Proposal</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <input type="hidden" name="mahasiswa_id" value="<?= $this->session->userdata('id') ?>">
                    <div class="form-group">
                        <label>Judul Skripsi</label>
                        <input type="text" class="form-control" name="judul_skripsi" placeholder="Masukkan Judul Skripsi">
                    </div>
                    <div class="form-group">
                        <label>Pembimbing</label>
                        <select name="dosen_id" class="form-control">
                            <option value="">- Pilih Pembimbing -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penguji</label>
                        <select name="dosen_penguji_id" class="form-control">
                            <option value="">- Pilih Penguji -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jadwal Skripsi</label>
                        <input name="jadwal_skripsi" type="text" class="form-control dateTime" placeholder="Pilih Jadwal Skripsi" readonly>
                    </div>
                    <div class="form-group">
                        <label>Persetujuan</label>
                        <input type="file" class="form-control" name="pilih-persetujuan" accept="application/pdf">
                        <input type="hidden" name="persetujuan">
                        <input type="hidden" name="def_persetujuan">
                    </div>
                    <div class="form-group">
                        <label>File Skripsi</label>
                        <input type="file" class="form-control" name="pilih-file_skripsi" accept="application/pdf">
                        <input type="hidden" name="file_skripsi">
                        <input type="hidden" name="def_file_skripsi">
                    </div>
                    <div class="form-group">
                        <label>SK Tim</label>
                        <input type="file" class="form-control" name="pilih-sk_tim" accept="application/pdf">
                        <input type="hidden" name="sk_tim">
                        <input type="hidden" name="def_sk_tim">
                    </div>
                    <div class="form-group">
                        <label>Bukti Konsultasi</label>
                        <input type="file" class="form-control" name="pilih-bukti_konsultasi" accept="application/pdf">
                        <input type="hidden" name="bukti_konsultasi">
                        <input type="hidden" name="def_bukti_konsultasi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="hapus">
                <div class="modal-header">
                    <div class="modal-title">Hapus Penelitian</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <p>Anda yakin menghapus penelitian terpilih ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
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
                    <button type="submit" class="btn btn-primary btn-konfirmasi">Konfirmasi</button>
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
        call('api/dosen').done(function(res) {
            dosen = `<option value="">- Pilih Dosen -</option>`;
            if (res.data) {
                res.data.forEach(obj => {
                    dosen += `<option value="` + obj.id + `">` + obj.nama + `</option>`;
                })
            }
            $('[name=dosen_id]').html(dosen);
            $('[name=dosen_penguji_id]').html(dosen);
        })

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
                    {
                        data: null,
                        render: function(data) {
                            return '<div class="text-center">\
    						<button class="btn btn-danger btn-sm btn-hapus" type="button" data-toggle="modal" data-target="#hapus" data-id="' + data.id + '">\
    							<i class="fa fa-trash"></i>\
    						</button>\
    					</div>'
                        }
                    }
                ],
                "language": {
                    "zeroRecords": "data tidak tersedia"
                }
            });
        }

        show();

        $(document).on('submit', 'form#tambah', function(e) {
            e.preventDefault();
            call('api/skripsi/create', $(this).serialize()).done(function(res) {
                if (res.error == true) {
                    notif(res.message, 'error', true);
                } else {
                    notif(res.message, 'success');
                    $('form#tambah [name]').val('');
                    $('div#tambah').modal('hide');
                    show();
                }
            })
        })

        $(document).on('change', '[name=pilih-file_skripsi]', function() {
            read('[name=pilih-file_skripsi]', function(data) {
                $('[name=file_skripsi]').val(data.result);
            })
        })

        $(document).on('change', '[name=pilih-sk_tim]', function() {
            read('[name=pilih-sk_tim]', function(data) {
                $('[name=sk_tim]').val(data.result);
            })
        })

        $(document).on('change', '[name=pilih-persetujuan]', function() {
            read('[name=pilih-persetujuan]', function(data) {
                $('[name=persetujuan]').val(data.result);
            })
        })

        $(document).on('change', '[name=pilih-bukti_konsultasi]', function() {
            read('[name=pilih-bukti_konsultasi]', function(data) {
                $('[name=bukti_konsultasi]').val(data.result);
            })
        })

        $(document).on('click', 'button.btn-hapus', function() {
            $('form#hapus .id').val($(this).data('id'));
        })

        $(document).on('submit', 'form#hapus', function(e) {
            e.preventDefault();
            const id = $('form#hapus .id').val();
            call('api/skripsi/destroy/' + id).done(function(res) {
                if (res.error == true) {
                    notif(res.message, 'error', true);
                } else {
                    notif(res.message, 'success');
                    $('div#hapus').modal('hide');
                    show();
                }
            })
        })

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

    $(document).on('click', 'button.btn-edit', function() {
        $('form#edit .id').val($(this).data('id'));
        $('form#edit [name=mahasiswa_id]').val($(this).data('mahasiswa_id'));
        $('form#edit [name=judul_skripsi]').val($(this).data('judul_skripsi'));
        $('form#edit [name=dosen_id]').val($(this).data('dosen_id'));
        $('form#edit [name=dosen_penguji_id]').val($(this).data('dosen_penguji_id'));
        $('form#edit [name=jadwal_skripsi]').val($(this).data('jadwal_skripsi'));
        $('form#edit [name=def_file_skripsi]').val($(this).data('file_skripsi'));
        $('form#edit [name=def_sk_tim]').val($(this).data('sk_tim'));
        $('form#edit [name=def_persetujuan]').val($(this).data('persetujuan'));
        $('form#edit [name=def_bukti_konsultasi]').val($(this).data('bukti_konsultasi'));
    })

    $(document).on('submit', 'form#edit', function(e) {
        e.preventDefault();
        var id = $('form#edit .id').val();
        call('api/skripsi/update/' + id, $(this).serialize()).done(function(req) {
            if (req.error == true) {
                notif(req.message, 'error', true);
            } else {
                notif(req.message, 'success');
                $('form#edit [name]').val('');
                $('div#edit').modal('hide');
                show();
            }
        })
    })

    $(document).on('click', 'button.btn-setuju', function() {
        $('form#setujui .id').val($(this).data('id'));
        $('form#setujui input.status').val($(this).data('status'));
        $('form#setujui span.status').html(($(this).data('status') == '1') ? 'batal menyetujui' : 'menyetujui');
        $('form#setujui .judul').html($(this).data('judul_skripsi'));
    })

    $(document).on('submit', 'form#setujui', function(e) {
        e.preventDefault();
        $(".btn-konfirmasi").attr('disabled', true).html('Loading...')
        const id = $('form#setujui .id').val();
        call('api/skripsi/' + (($('form#setujui .status').val() == '1') ? 'disagree' : 'agree') + '/' + id).done(function(req) {
            if (req.error == true) {
                notif(req.message, 'error', true);
                $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi')
            } else {
                notif(req.message, 'success');
                $('div#setujui').modal('hide');
                show();
                $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi')
            }
        })
    })
    $(document).ready(function() {
            $('#generateButton').click(function() {
                $.ajax({
                    url: base_url + 'generateskripsi',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Success Generate');
                            // Handle success actions here
                            location.reload();
                        } else {
                            alert('error');
                            // Handle error actions here
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX request failed.');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>