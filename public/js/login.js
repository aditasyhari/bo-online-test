$(document).ready(function() {
    var formLogin = $("#form-login");

    // $("#btn-submit-login").on("click", function() {
    //     formLogin.trigger("reset");
    // });

    $("#btn-submit-login").on("click", function() {
        loadingStart();
        let formValid = (formLogin.valid());
        if (formValid == false) {
            loadingEnd();
        } else {
            formLogin.submit();
        }
    });

    var login = formLogin.validate({
        validClass: "success",
        rules: {
            username: {
                required: true,
            },
            password: {
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
            $("#btn-submit-login").prop('disabled', true);
            // $("#btn-submit-login").html('<i class="fa fa-spinner"></i> Processing...');

            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "login",
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
                        window.location.href = '/dashboard';
                    } else {
                        swalWarning(resp.message);
                    }

                    $("#btn-submit-login").prop('disabled', false);
                    // $("#btn-submit-login").html('<i class="fa fa-save"></i> Simpan');
                },
                error: function(xhr, textstatus, errorthrown) {
                    loadingEnd();
                    if (textstatus == "timeout") {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                        }
                    } else {
                        swalError('Gagal Login');
                    }
                    $("#btn-submit-login").prop('disabled', false);
                    // $("#btn-submit-login").html('<i class="fa fa-save"></i> Simpan');
                },
            });
        },
    });

});