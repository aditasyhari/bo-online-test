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
            url: "/claim-data-medali",
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
            { 
                data: 'nama_sekolah',
                render: function(data, type, full, meta) {
                    let grub = full['grup_nama'].toUpperCase();
                    let nama_sekolah = full['nama_sekolah'];
                    return '('+grub+') - '+nama_sekolah;
                }
            },
            { data: 'nama_propinsi' },
            { data: 'alamat' },
            { data: 'note' },
        ],
        drawCallback: function(settings) {
            feather.replace();
            loadingEnd();
        },
        
    });

}