$(document).ready(function() {
    var formToken = $("#form-blast-token");

    $("#btn-submit-token").on("click", function() {
        loadingStart();
        let formValid = (formToken.valid());
        if (formValid == false) {
            loadingEnd();
        } else {
            formToken.submit();
        }
    });

    var token = formToken.validate({
        validClass: "success",
        rules: {
            email: {
                required: true,
            },
            token: {
                required: true,
            },
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function(form) {
            console.log($("#email").val());
            $("#btn-submit-token").prop('disabled', true);

            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "blast-email/blast-email-token",
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
                        swalSuccess(resp.message);
                    } else {
                        swalWarning(resp.message);
                    }

                    $("#btn-submit-token").prop('disabled', false);
                },
                error: function(xhr, resp, errorthrown) {
                    loadingEnd();
                    swalError('Gagal Kirim Email');
                    $("#btn-submit-token").prop('disabled', false);
                },
            });
        },
    });
});