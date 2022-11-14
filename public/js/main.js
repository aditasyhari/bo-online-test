let url_lokal = window.location.origin;

function loadingStart() {
    document.getElementById("loader-screen").classList.add("show");
}

function loadingEnd() {
    document.getElementById("loader-screen").classList.remove("show");
}

function swalWarning(message, title = "Warning") {
    swal(title, message, {
        icon: "warning",
        buttons: {
            confirm: {
                className: 'btn btn-warning xl:w-32'
            }
        },
    });
}

function swalError(message, title = "Error") {
    swal(title, message, {
        icon: "error",
        buttons: {
            confirm: {
                className: 'btn btn-danger xl:w-32'
            }
        },
    });
}

function swalSuccess(message, title = "Success") {
    swal(title, message, {
        icon: "success",
        buttons: {
            confirm: {
                className: 'btn btn-success xl:w-32'
            }
        },
    });
}

function swalInfo(message, title = "Info") {
    swal(title, message, {
        icon: "info",
        buttons: {
            confirm: {
                className: 'btn btn-info xl:w-32'
            }
        },
    });
}

loadingStart();

$(document).ready(function() {
    loadingEnd();

    $(".input_number").attr("onkeypress", "return isNumber(event)");

    $("#logout").on("click", function() {
        loadingStart();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/auth/logout",
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: function() {},
            tryCount: 0,
            retryLimit: 3,
            success: function(resp) {
                loadingEnd();
                if (resp.success == true) {
                    location.reload();
                } else {
                    swalWarning(resp.message);
                }
            },
            error: function(xhr, textstatus, errorthrown) {
                loadingEnd();
                if (textstatus == "timeout") {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                    }
                } else {
                    swalError('Error');
                }
            },
        });
    });
});

function empty(string) {
    return (string == undefined || string == "" || string == null);
}

function Clean_form(Selector = "") {
    $(Selector).find('input').val("");
    $(Selector).find('textarea').val("");
    $(Selector).find("select").trigger("reset");
    $(Selector).find("select").val("").trigger("change");
}

$(document).on('hide.bs.modal', '.modal', function() {
    console.log('modal closed');
    $('.modal').find('form').trigger("reset");
})

$.fn.clearValidation = function() {
    var v = $(this).validate();
    $('[name]', this).each(function() {
        v.successList.push(this);
        v.showErrors();
    });
    v.resetForm();
    v.reset();
};

function closeModal() {
    $(".btn-tutup-modal").click();
}

function reloadDataTable(table) {
    table.DataTable().ajax.reload(null, false);
}

function setNotif(message, heading = "Notification") {
    $.toast({
        heading: heading,
        text: message,
        showHideTransition: 'slide',
        position: 'bottom-right',
        stack: false,
    });
}

function setValueFilter(className) {
    $('.select-' + className).on('change', function() {
        var valOption = $(this).children("option:selected").val();
        $(this).parent().find('[name=value-' + className + ']').val(valOption);
        loadDataTable();
    });
}

function formatRupiah(angka, prefix) 
{
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
}