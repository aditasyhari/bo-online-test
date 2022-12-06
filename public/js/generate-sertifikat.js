$(document).ready(function() {
    var formGenerate = $("#form-generate");
    var url_lokal = window.location.origin;

    formGenerate.validate({
        validClass: "success",
        rules: {
            nama: {
                required: true,
            },
            olimpiade: {
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function(form) {
            $("#btn-generate").prop('disabled', true);

            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "generator-sertifikat",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    loadingStart();
                },
                success: function(resp) {
                    loadingEnd();
                    setNotif(resp.message);
                    let result = `<div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                        <div class="flex items-center border-b border-gray-200 px-5 py-4">
                            <div class="mr-auto">
                                <a href="`+url_lokal+`/images/sertifikat/generate/`+resp.data+`" download class="button bg-theme-1 text-white font-medium">Download</a> 
                            </div>
                        </div>
                        <div class="p-5">
                            <img alt="Generate" class="rounded-md" src="`+url_lokal+`/images/sertifikat/generate/`+resp.data+`">
                        </div>
                        <hr>
                    </div>`;

                    $("#result-generate").html(result);
                    $("#btn-generate").prop('disabled', false);
                },
                error: function(xhr, resp, errorthrown) {
                    loadingEnd();
                    swalError('Gagal Generate');
                    $("#btn-generate").prop('disabled', false);
                },
            });
        },
    });

});