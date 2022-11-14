$(document).ready(function() {
    var selectorTable = $('#table-data');

    loadDataTable();

    // $('#table-data tbody').on('click', 'tr td a.btnDetailData', function () {
    //     const row = $('#table-data').DataTable().row( $(this).parents('tr') ).data();
    
    //     let rowData = '';
    //     $.each(row.detail_claim, function(index, value) {
    //         rowData += `<tr>
    //             <td>${index + 1}</td>
    //             <td>${value.nip}</td>
    //         </tr>`;
    //     });
    
    //     $('#table-detail tbody').html(rowData);
    // });

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
                targets: -4,
                render: function (data, type, full, meta) {
                  let status = intval(full['status']);
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
                  var output = "<a class='text-theme-4 mr-4' href='"+url_lokal+"/public/uploads/"+bukti+"' target='_blank'> Lihat Bukti </a>";
  
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
                btnAction += "<a data-id='"+id+"' class='btnDetailData button flex items-center bg-theme-5 mr-3' href='javascript:;'> Detail </a>";
                btnAction += "<a data-id='"+id+"' class='btnValidData button flex items-center bg-theme-3 text-theme-2 mr-3' href='javascript:;'> Validasi </a>";
                btnAction += "<a data-id='"+id+"' class='btnRejectData button flex items-center bg-theme-6 text-theme-2 mr-3' href='javascript:;'> Reject </a>";
                btnAction += "</div>";

                return btnAction;
              }
            }
        ],
    });
}