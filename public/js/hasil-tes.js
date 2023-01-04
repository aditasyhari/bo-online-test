$(document).ready(function() {
    var selectorTable = $('#table-data');

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

    $("#select-filter-tes").on('change', function () {
        $('#btn-pilih').removeAttr("disabled");
        $('#btn-pilih').removeClass("bg-theme-5").addClass("bg-theme-1");
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
            url: "/data-tes/hasil-tes/list",
            data: {
                order: $('#select-filter-order option:selected').val(),
                tes_id: $('#select-filter-tes option:selected').val()
            }
        }, // JSON file to add data
        columns: [
            // { 
            //     data: 'paket',
            //     render: function(data, type, full, meta) {
            //         let paket = full['paket'].toUpperCase();
            //         return paket;
            //     }
            // },
            { data: 'tes_nama' },
            { data: 'user_firstname' },
            { data: 'nomor_hp' },
            { data: 'nama_sekolah' },
            { data: 'kotakab' },
            { data: 'nama_propinsi' },
            { data: 'nilai' },
            { data: 'medali' },
            { data: 'grade' }
        ],
        drawCallback: function(settings) {
            feather.replace();
            loadingEnd();
        },
        
    });

}