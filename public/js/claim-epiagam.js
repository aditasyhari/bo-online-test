$(document).ready(function() {
    var selectorTable = $('#table-data');

    loadDataTable();
    setValueFilter("filter-grub");
    setValueFilter("filter-propinsi");

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
            url: "/claim-data-epiagam",
            data: {
                filter_grub: $('#select-filter-grub option:selected').val(),
                filter_propinsi: $('#select-filter-propinsi option:selected').val()
            }
        }, // JSON file to add data
        columns: [
            { 
                data: 'paket',
                render: function(data, type, full, meta) {
                    let paket = full['paket'].toUpperCase();
                    return paket;
                }
            },
            { data: 'nama_tes' },
            { data: 'nama' },
            { data: 'wa' },
            { data: 'email' },
            { data: 'grup_nama' },
            { data: 'nama_sekolah' },
            { data: 'nama_propinsi' }
        ],
        drawCallback: function(settings) {
            feather.replace();
            loadingEnd();
        },
        
    });

}