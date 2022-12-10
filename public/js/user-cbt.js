$(document).ready(function() {
    var selectorTable = $('#table-data');
    var formUpdateData = $("#form-edit-data");
    var formUpdateDiskon = $("#form-edit-data-discount");

    loadDataTable();
    setValueFilter("filter-grub");
    setValueFilter("filter-propinsi");

    $('#table-data tbody').on('click', 'a.btnDetailData', function () {
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

    $('#table-data tbody').on('click', 'a.btnDiscountData', function () {
        const row = $('#table-data').DataTable().row( $(this).parents('tr') ).data();
        $('.edit-userid').val(row.user_id);
        $('.edit-discount').val(formatRupiah(''+row.discount_claim, 'Rp '));
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

    formUpdateDiskon.validate({
        validClass: "success",
        rules: {
            discount: {
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
            $(".btn-simpan-update-data").prop('disabled', true);
            $(".btn-simpan-update-data").html('<i class="fa fa-spinner"></i> Processing...');

            var formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/setting/user-cbt/update-discount",
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

                    $(".btn-simpan-update-data").prop('disabled', false);
                    $(".btn-simpan-update-data").html('Update');
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
                    $(".btn-simpan-update-data").prop('disabled', false);
                    $(".btn-simpan-update-data").html('Update');
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

    $('#table-data').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        mark: true,
        ajax: {
            type: 'POST',
            url: "/setting/user-cbt/list",
            data: {
                id_grub: $('#select-filter-grub option:selected').val(),
                id_propinsi: $('#select-filter-propinsi option:selected').val(),
            }
        }, // JSON file to add data
        columns: [
            { data: '', searchable: false },
            { data: 'user_name' },
            { data: 'user_firstname' },
            { data: 'user_email' },
            { data: 'discount_claim' },
            { data: 'grup_nama' },
            { data: 'nama_sekolah' },
        ],
        drawCallback: function(settings) {
            feather.replace();
            loadingEnd();
        },
        columnDefs: [
            {
                targets: -3,
                render: function (data, type, full, meta) {
                  let discount = full['discount_claim'];
  
                  return formatRupiah(''+discount, 'Rp ');
                }
            },
            {
              targets: 0,
              title: '',
              orderable: false,
              render: function (data, type, full, meta) {
                const id = full['user_id'];

                var btnAction = `
                <a href="javascript:;" data-toggle='modal' data-target='#modal-discount-data' data-id='`+id+`' class="btnDiscountData button bg-theme-1 text-white text-center p-2 transition duration-300 ease-in-out bg-white rounded-md"> 
                    Edit Diskon 
                </a> 
                `;

                // <div class="dropdown relative"> <button class="dropdown-toggle button inline-block bg-theme-1 text-white">Action</button>
                //     <div class="dropdown-box mt-12 absolute w-40 top-0 right-0 z-20">
                //         <div class="dropdown-box__content box p-2">
                //             <a href="javascript:;" data-toggle='modal' data-target='#modal-detail-data' data-id='`+id+`' class="btnDetailData flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> 
                //                 <i data-feather="external-link" class="w-4 h-4 text-gray-700 mr-2"></i> Detail 
                //             </a> 
                //             <a href="javascript:;" data-toggle='modal' data-target='#modal-discount-data' data-id='`+id+`' class="btnDiscountData flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> 
                //                 <i data-feather="check-circle" style='color: #4eea08;' class="w-4 h-4 text-gray-700 mr-2"></i> Diskon 
                //             </a> 
                //             <a href="javascript:;" data-id='`+id+`' class="btnDeleteData flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> 
                //                 <i data-feather="x-circle" class="w-4 h-4 text-theme-6 mr-2"></i> Hapus User
                //             </a> 
                //         </div>
                //     </div>
                // </div>

                return btnAction;
              }
            }
        ],
    });

}