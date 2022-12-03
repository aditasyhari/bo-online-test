$(document).ready(function() {
    var selectorTable = $('#table-data');
    var formUpdateData = $("#form-edit-data");

    loadDataTable();

    $('#table-data tbody').on('click', 'a.btnDetailData', function () {
        const row = $('#table-data').DataTable().row( $(this).parents('tr') ).data();
        $('#paket-id').val(row.id);
        $('#label-paket').html(row.nama_paket);
        $('#harga').val(formatRupiah(''+row.harga, 'Rp '));
        $('#deskripsi').html(row.deskripsi);
    });

    formUpdateData.validate({
        validClass: "success",
        rules: {
            harga: {
                required: true,
            },
            deskripsi: {
                required: true,
            }
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
                url: "paket/update",
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
                    $("#btn-simpan-update-data").html('Update');
                },
                error: function(xhr, textstatus, errorthrown) {
                    loadingEnd();
                    if (textstatus == "timeout") {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                        }
                    } else {
                        swalError('Something went wrong!');
                    }
                    $("#btn-simpan-update-data").prop('disabled', false);
                    $("#btn-simpan-update-data").html('Update');
                },
            });
        },
    });

});

function updateStatus(id) {
    loadingStart();
    $.ajax({
        type: "POST",
        url: "/setting/paket/flag-update",
        data: {
            id: id,
        },
        dataType: "JSON",
        beforeSend: function() {},
        success: function(resp) {
            loadingEnd();
            if (resp.success == true) {
                setNotif("Status updated!");
            } else {
                swalWarning(resp.message);
            }
        },
        error: function(resp) {
            loadingEnd();
            swalError(resp.message);
        }
    });
}

function loadDataTable() 
{
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#table-data').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        mark: true,
        ajax: {
            type: 'POST',
            url: "paket/list",
        }, // JSON file to add data
        columns: [
            { data: 'nama_paket' },
            { data: 'deskripsi' },
            { data: 'harga' },
            { data: 'flag', searchable: false },
            { data: '', searchable: false },
        ],
        drawCallback: function(settings) {
            feather.replace();
            loadingEnd();
        },
        columnDefs: [
            {
                targets: -3,
                render: function (data, type, full, meta) {
                  let harga = full['harga'];
  
                  return formatRupiah(''+harga, 'Rp ');
                }
            },
            {
                targets: -2,
                render: function (data, type, full, meta) {
                    const id = full['id'];
                    const flag_status = full['flag'];
                    var checkedFlagStatus = '';
                    if(flag_status == 1) {
                        checkedFlagStatus = 'checked';
                    }

                    return "<input onchange='updateStatus("+id+")' class='input input--switch border update-flag-status' type='checkbox' "+checkedFlagStatus+">"
                }
            },
            {
              targets: -1,
              title: '',
              orderable: false,
              render: function (data, type, full, meta) {
                const id = full['id'];

                var btnAction = `
                    <a href="javascript:;" data-toggle='modal' data-target='#modal-detail-data' data-id='`+id+`' class="btnDetailData items-center p-2 transition duration-300 ease-in-out button inline-block bg-theme-1 text-white"> 
                        Edit Paket 
                    </a> 
                `;

                return btnAction;
              }
            }
        ],
    });

}