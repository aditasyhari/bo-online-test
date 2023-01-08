$(document).ready(function() {
    var selectorTable = $('#table-data');
    var formValidasi = $("#form-validasi");
    $("#check-user").hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadDataTable();

    $('#btn-pilih').click(function(){
        loadingStart();
        loadDataTable();
    });

    $("#select-filter-grub").on('change', function () {
        $('#btn-pilih').removeAttr("disabled");
        $('#btn-pilih').removeClass("bg-theme-5").addClass("bg-theme-1");

        let grub_id = $('#select-filter-grub option:selected').val();
        let filterOlimpiade = $("#select-filter-olimpiade");
        filterOlimpiade.empty();
        let optionDefault = `
            <option selected value="" disabled>Pilih Olimpiade</option>
            <option value="">Semua</option>
        `;
        filterOlimpiade.append(optionDefault);
        $.ajax({
            type: "get",
            url: "/list-olimpiade?grub_id="+grub_id,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(resp) {
                $.each(resp.data, function(index, value) {
                    let id = value.tes_id;
                    let nama = value.tes_nama;
                    let option = "<option value="+id+">"+nama+"</option>";
                    filterOlimpiade.append(option);
                });
            },
            error: function(xhr, resp, errorthrown) {
            },
        });
    });

    $("#modal-grub").on('change', function () {
        let grub_id = $(this).val();
        let olimpiade = $("#modal-olimpiade");
        olimpiade.empty();
        $.ajax({
            type: "get",
            url: "/list-olimpiade?grub_id="+grub_id,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(resp) {
                $.each(resp.data, function(index, value) {
                    let id = value.tes_id;
                    let nama = value.tes_nama;
                    let option = `
                    <div class="flex items-center text-gray-700"> 
                        <input type="checkbox" class="input border mr-2" value="${id}" name="olimpiade[]"> 
                        <label class="cursor-pointer select-none">${nama}</label> 
                    </div>
                    `;
                    olimpiade.append(option);
                });
            },
            error: function(xhr, resp, errorthrown) {
            },
        });
    });

    $("#modal-email").on('keyup', function () {
        let email = $("#modal-email").val();
        console.log(email);
        $.ajax({
            type: "get",
            url: "/check-user?email="+email,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(resp) {
                if(resp.data) {
                    $("#check-user").hide();
                    $("#btn-validasi").removeAttr('disabled');
                    $('#btn-validasi').removeClass("bg-theme-5").addClass("bg-theme-1");
                } else {
                    $("#check-user").show();
                    $("#btn-validasi").attr('disabled');
                    $('#btn-validasi').removeClass("bg-theme-1").addClass("bg-theme-5");
                }
            },
            error: function(xhr, resp, errorthrown) {
            },
        });
    });

    formValidasi.validate({
        validClass: "success",
        rules: {
            // add_item: {
            //     required: true,
            // },
            email: {
                required: true,
            },
            olimpiade: {
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
            $("#btn-validasi").prop('disabled', true);
            $("#btn-validasi").html('<i class="fa fa-spinner"></i> Processing...');

            var formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/validasi/pendaftaran",
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
                    } else {
                        swalWarning(resp.message);
                    }

                    $("#btn-validasi").prop('disabled', false);
                    $("#btn-validasi").html('Validasi');
                },
                error: function(xhr, textstatus, errorthrown) {
                    loadingEnd();
                    swalError('Something went wrong!');
                    $("#btn-validasi").prop('disabled', false);
                    $("#btn-validasi").html('Validasi');
                },
            });
        },
    });

});

function loadDataTable() 
{
    $('#table-data').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        mark: true,
        ajax: {
            type: 'POST',
            url: "/validasi/pendaftaran/list",
            data: {
                grub_id: $('#select-filter-grub option:selected').val(),
                tes_id: $('#select-filter-olimpiade option:selected').val()
            }
        }, // JSON file to add data
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'tes_nama' },
            { data: 'user_firstname' },
            { data: 'user_email' },
            { data: 'grup_nama' },
            { data: 'nama_sekolah' },
        ],
        drawCallback: function(settings) {
            feather.replace();
            loadingEnd();
        },
        
    });

}