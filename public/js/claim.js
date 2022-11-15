$(document).ready(function() {
    var selectorTable = $('#table-data');
    var formUpdateData = $("#form-edit-data");

    loadDataTable();

    $('#table-data tbody').on('click', 'tr td a.btnDetailData', function () {
        const row = $('#table-data').DataTable().row( $(this).parents('tr') ).data();
        $('#claim-id').val(row.id);
        $('#detail-alamat').html(row.alamat);
        $('#detail-note').html(row.note);

        let rowData = '';
        // let $select = document.querySelector('#add-claim');
        // let optionData = `<option value="a">Paket A</option>
        //                 <option value="b">Paket B</option>
        //                 <option value="c">Paket C</option>
        //                 <option value="d">Paket D</option>
        //                 <option value="bonus">Paket Bonus</option>`;
        // $select.innerHTML = optionData;
        // let $options = Array.from($select.options);

        $.each(row.detail_claim, function(index, value) {
            let harga = formatRupiah(''+value.harga, 'Rp ');
            let paket = value.paket.toUpperCase();
            let keterangan = '';

            // let optionToSelect = $options.find(item => item.text == 'Paket '+paket);
            // optionToSelect.selected = true;

            switch(paket) {
                case 'A':
                    keterangan = "E-Piagam Penghargaan";
                    break;
                case 'B':
                    keterangan = "Piagam Penghargaan dan Sertifikat Cetak";
                    break;
                case 'C':
                    keterangan = "Piagam & Sertifikat Cetak + Medali";
                    break;
                case 'D':
                    keterangan = "E-Piagam + Piagam & Sertifikat Cetak + Medali";
                    break;
                case 'BONUS':
                    keterangan = "E-Piagam + Piagam & Sertifikat Cetak + Medali + Kaos + Topi + Tote Bag";
                    break;
            }

            rowData += `<tr>
                <td>${index + 1}</td>
                <td>${value.nama_tes}</td>
                <td>${harga}</td>
                <td>${paket}</td>
                <td>${keterangan}</td>
            </tr>`;
        });
    
        $('#table-detail tbody').html(rowData);
    });

    formUpdateData.validate({
        validClass: "success",
        rules: {
            // add_item: {
            //     required: true,
            // },
            alamat: {
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
                url: "claim-update-data",
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

    selectorTable.on('click', '.btnRejectData', function() {
        id = $(this).data('id');

        swal({
            title: 'Anda yakin mereject data ini?',
            text: "Data akan di reject.",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Ya, Reject!',
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
                    url: "claim-reject",
                    data: {
                        id: id,
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        loadingStart();
                    },
                    success: function(resp) {
                        $.ajax({
                            type: "POST",
                            url: "claim-total-valid",
                            dataType: "JSON",
                            processData: false,
                            contentType: false,
                            success: function(resp) {
                                let total_uang = formatRupiah(''+resp.data.total_uang, 'Rp ');
                                $('#total-valid').html(resp.data.total_user+' Data Valid ('+total_uang+')');
                            },
                            error: function(xhr, textstatus, errorthrown) {
                            },
                        });
                        
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

    selectorTable.on('click', '.btnValidData', function() {
        id = $(this).data('id');

        swal({
            title: 'Anda yakin validasi data ini?',
            text: "Data akan divalidasi.",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Ya, Validasi!',
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
                    url: "claim-validasi",
                    data: {
                        id: id,
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        loadingStart();
                    },
                    success: function(resp) {
                        $.ajax({
                            type: "POST",
                            url: "claim-total-valid",
                            dataType: "JSON",
                            processData: false,
                            contentType: false,
                            success: function(resp) {
                                let total_uang = formatRupiah(''+resp.data.total_uang, 'Rp ');
                                $('#total-valid').html(resp.data.total_user+' Data Valid ('+total_uang+')');
                            },
                            error: function(xhr, textstatus, errorthrown) {
                            },
                        });

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

});

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
            url: "/claim-data",
        }, // JSON file to add data
        columns: [
            { data: 'DT_RowIndex', searchable: false },
            { data: 'nama' },
            { data: 'wa' },
            { data: 'email' },
            { data: 'status' },
            { data: 'item' },
            { data: 'ongkir' },
            { data: 'total' },
            { data: 'bukti' },
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
                targets: -6,
                render: function (data, type, full, meta) {
                  let status = parseInt(full['status']);
                  let output;
                  switch(status) {
                    case 0:
                        output = "<div class='' title='Pending'><i class='' data-feather='clock'></i></div>";
                        break;
                    case 1:
                        output = "<div class='' title='Valid'><i style='color: #4eea08;' data-feather='check-circle'></i></div>";
                        break;
                    case 2:
                        output = "<div class='' title='Reject'><i class='text-theme-6' data-feather='x-circle'></i></div>";
                        break;
                  }
  
                  return output;
                }
            },
            {
                targets: -5,
                render: function (data, type, full, meta) {
                  let item = full['item'];
  
                  return formatRupiah(''+item, 'Rp ');
                }
            },
            {
                targets: -4,
                render: function (data, type, full, meta) {
                  let ongkir = full['ongkir'];
  
                  return formatRupiah(''+ongkir, 'Rp ');
                }
            },
            {
                targets: -3,
                render: function (data, type, full, meta) {
                  let total = full['total'];
  
                  return formatRupiah(''+total, 'Rp ');
                }
            },
            {
                targets: -2,
                render: function (data, type, full, meta) {
                  let bukti = full['bukti'];
                  var output = "<a class='text-theme-4' href='https://claim.gypem.com/public/uploads/"+bukti+"' target='_blank'> Lihat Bukti </a>";
  
                  return output;
                }
            },
            {
              targets: -1,
              title: '',
              orderable: false,
              render: function (data, type, full, meta) {
                const id = full['id'];
                var btnAction = "<div class='flex justify-center items-center'>";
                btnAction += "<a data-id='"+id+"' class='btnDetailData button flex items-center bg-theme-5 mr-3' data-toggle='modal' data-target='#modal-detail-data' href='javascript:;'> Detail </a>";
                btnAction += "<a data-id='"+id+"' class='btnValidData button flex items-center bg-theme-3 text-theme-2 mr-3' href='javascript:;'> Validasi </a>";
                btnAction += "<a data-id='"+id+"' class='btnRejectData button flex items-center bg-theme-6 text-theme-2 mr-3' href='javascript:;'> Reject </a>";
                btnAction += "</div>";

                return btnAction;
              }
            }
        ],
    });

    $.ajax({
        type: "POST",
        url: "claim-total-valid",
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(resp) {
            let total_uang = formatRupiah(''+resp.data.total_uang, 'Rp ');
            $('#total-valid').html(resp.data.total_user+' Data Valid ('+total_uang+')');
        },
        error: function(xhr, textstatus, errorthrown) {
        },
    });
}