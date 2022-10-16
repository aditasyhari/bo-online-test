$(document).ready(function() {
    var formTambahData = $("#form-tambah-data");
    var formUpdateData = $("#form-edit-data");
    var selectorTable = $('#table-data');

    loadDataTable();

    $("#btn-tambah-data").on("click", function() {
        formTambahData.trigger("reset");
    });

    $("#btn-simpan-tambah-data").on("click", function() {
        loadingStart();
        let formValid = (formTambahData.valid());
        if (formValid == false) {
            loadingEnd();
        } else {
            formTambahData.submit();
        }
    });

    $("#btn-simpan-update-data").on("click", function() {
        loadingStart();
        let formValid = (formUpdateData.valid());
        if (formValid == false) {
            loadingEnd();
        } else {
            formUpdateData.submit();
        }
    });

    selectorTable.on('click', '.btnEditData', function() {
        // formUpdateData.trigger("reset");
        let id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: "user-bo/detail",
            data: {
                id: id
            },
            dataType: "JSON",
            beforeSend: function() {
                loadingStart();
            },
            success: function(resp) {
                loadingEnd();
                if (resp.success == true) {

                    let flag_status = resp.data.flag_status;
                    let id_user = resp.data.id_user;

                    if (flag_status == 1) {
                        $('.checkbox-edit-flag_status').prop('checked', true);
                    } else {
                        $('.checkbox-edit-flag_status').prop('checked', false);
                    }

                    $('.edit-userid').val(id_user);

                    $.each(resp.data, function(index, item) {
                        $('.edit-' + index).val(item);
                        $('.edit-' + index).html(item);
                        $('.edit-select-' + index).val(item);
                        $('.edit-select-' + index).trigger('change');
                    });
                } else {
                    swalWarning('Data Tidak Ditemukan.');
                }
            }
        });

    });

    selectorTable.on('click', '.btnDeleteData', function() {
        id = $(this).data('id');

        swal({
            title: 'Apa Anda yakin menghapus data ini?',
            text: "Data tidak dapat dikembalikan!",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Ya, Hapus!',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                $.ajax({
                    type: "POST",
                    url: "user-bo/delete",
                    data: {
                        id: id,
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        loadingStart();
                    },
                    success: function(resp) {
                        loadingEnd();
                        if (resp.success == true) {
                            reloadDataTable(selectorTable);
                            setNotif(resp.message);
                        } else {
                            swalWarning(resp.message);
                        }
                    },
                    error: function() {
                        loadingEnd();
                    },
                });
            } else {
                swal.close();
            }
        });
    });

    var tambahData = formTambahData.validate({
        validClass: "success",
        rules: {
            id_jabatan: {
                required: true,
            },
            id_level: {
                required: true,
            },
            nip: {
                required: true,
                number: true,
            },
            username: {
                required: true,
            },
            nama_lengkap: {
                required: true,
            },
            phone: {
                required: true,
                number: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 5,

            },
            password_confirmation: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function(form) {
            $("#btn-simpan-tambah-data").prop('disabled', true);
            $("#btn-simpan-tambah-data").html('<i class="fa fa-spinner"></i> Processing...');

            var formData = new FormData(form);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "user-bo/add",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function() {},
                tryCount: 0,
                retryLimit: 3,
                success: function(resp) {
                    loadingEnd();
                    if (resp.success == true) {
                        reloadDataTable(selectorTable);
                        swalSuccess(resp.message);
                        formTambahData.trigger("reset");

                        closeModal();
                    } else {
                        swalWarning(resp.message);
                    }

                    $("#btn-simpan-tambah-data").prop('disabled', false);
                    $("#btn-simpan-tambah-data").html('<i class="fa fa-save"></i> Simpan');
                },
                error: function(xhr, textstatus, errorthrown) {
                    loadingEnd();
                    if (textstatus == "timeout") {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                        }
                    } else {
                        swalError('Request Time Out!');
                    }
                    $("#btn-simpan-tambah-data").prop('disabled', false);
                    $("#btn-simpan-tambah-data").html('<i class="fa fa-save"></i> Simpan');
                },
            });
        },
    });

    var updateData = formUpdateData.validate({
        validClass: "success",
        rules: {
            id_jabatan: {
                required: true,
            },
            id_level: {
                required: true,
            },
            nip: {
                required: true,
            },
            username: {
                required: true,
            },
            nama_lengkap: {
                required: true,
            },
            phone: {
                required: true,
                number: true,
            },
            email: {
            	required: true,
            	email: true,
            },
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function(form) {
            $("#btn-simpan-update-data").prop('disabled', true);
            $("#btn-simpan-update-data").html('<i class="fa fa-spinner"></i> Processing...');

            var formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "user-bo/update",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function() {},
                tryCount: 0,
                retryLimit: 3,
                success: function(resp) {
                    loadingEnd();
                    if (resp.success == true) {
                        reloadDataTable(selectorTable);
                        swalSuccess(resp.message);
                        closeModal();
                    } else {
                        swalWarning(resp.message);
                    }

                    $("#btn-simpan-update-data").prop('disabled', false);
                    $("#btn-simpan-update-data").html('<i class="fa fa-save"></i> Simpan');
                },
                error: function(xhr, textstatus, errorthrown) {
                    loadingEnd();
                    if (textstatus == "timeout") {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                        }
                    } else {
                        swalError('Request Time Out!');
                    }
                    $("#btn-simpan-update-data").prop('disabled', false);
                    $("#btn-simpan-update-data").html('<i class="fa fa-save"></i> Simpan');
                },
            });
        },
    });

});

function loadDataTable() 
{
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	var thCount = $("#table-data > thead > tr > th, #table-data > tr > th").length;
    $('#table-data').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        mark: true,
        ajax: {
            type: 'POST',
            url: "user-bo/list",
        }, // JSON file to add data
        columns: [
            { data: 'DT_RowIndex', searchable: false },
            { data: 'nama' },
            { data: 'username' },
            { data: 'keterangan' },
            { data: 'level', searchable: false },
            { data: '', searchable: false }
        ],
        language: {
            "infoFiltered": "",
            "processing": ""
        },
        drawCallback: function(settings) {
            feather.replace();
        },
        columnDefs: [
            {
              targets: -1,
              title: '',
              orderable: false,
              render: function (data, type, full, meta) {
                const id = full['id'];
                var btnAction = "<a data-id='"+id+"' class='btnEditData flex items-center mr-3 text-theme-12' href='javascript:;' data-toggle='modal' data-target='#modal-edit-data'> <i data-feather='edit' class='w-4 h-4 mr-1'></i> </a>";
                btnAction += "<a data-id='"+id+"' class='btnDeleteData flex items-center text-theme-6 mr-3' href='javascript:;'> <i data-feather='trash-2' class='w-4 h-4 mr-1'></i> </a>";

                return btnAction;
              }
            }
          ],
    });
}