$(document).ready(function () {
    // let table = jQuery('#table-alternatif').DataTable({
    //     scrollX: true,
    //     buttons: ['copy', 'excel', 'csv', 'print'],
    //     info: false,
    //     ajax: {
    //         url: "/dataTablesAlternatif"
    //     },
    //     order: [], // Clearing default order
    //     sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>', // Hiding all other dom elements except table and pagination
    //     pageLength: 10,
    //     columns: [
    //         {
    //             data: null,
    //             render: (data) => {
    //                 return 'A' + data.kode
    //             }
    //         },
    //         {
    //             data: "alternatif"
    //         },
    //         {
    //             data: "action",
    //             orderable: true,
    //             searchable: true,
    //         },
    //     ],
    //     language: {
    //         paginate: {
    //             previous: '<i class="cs-chevron-left"></i>',
    //             next: '<i class="cs-chevron-right"></i>',
    //         },
    //     },
    // })
    let table = $("#table-alternatif").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        language: {
            paginate: {
                previous: '<i class="cs-chevron-left"></i>',
                next: '<i class="cs-chevron-right"></i>',
            },
        },
        sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
        pageLength: 10,
        ajax: {
            url: "/dataTablesAlternatif"
        },
        columns: [
            {
                data: null,
                render: (data) => {
                    return 'A' + data.kode
                }
            },
            {
                data: "alternatif"
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [2], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });
    $("#btn-close").on("click", function () {
        reset()
    })

    // KETIKA TOMBOL TAMBAH DI KLIK
    $("#btn-add-data").on("click", function () {
        $("#modal-alternatif .modal-title").html("Tambah Alternatif")
        $("#modal-alternatif .modal-footer").html(`<button class="btn btn-primary" id="save-alternatif">Tambah</button>`)
        $("#modal-alternatif").modal("show")
    })

    $("#modal-alternatif").on("click", "#save-alternatif", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-alternatif"]').serialize();
        $.ajax({
            data: formdata,
            url: "/alternatif",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $("#spinner").html("")
                $(button).removeAttr("disabled");
                reset();
                table.ajax.reload()
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                $("#spinner").html("")
                $(button).removeAttr("disabled");
                if (xhr.status == 400) {
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    })

    // AMBIL DATA DAPIL
    $("#table-alternatif").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader)
        $.ajax({
            url: "/alternatif/" + uuid + "/edit",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                $("#spinner").html("")
                $("#kode").val(data.kode)
                $("#alternatif").val(data.alternatif)
                $("#modal-alternatif .modal-title").html("Edit Alternatif")
                $("#modal-alternatif .modal-footer").html(`<button class="btn btn-primary" id="update-alternatif" data-uuid="${uuid}">Ubah</button>`)
                $("#modal-alternatif").modal("show")
            }
        });
    })

    // UPDATE DATA DAPIL
    $("#modal-alternatif").on("click", "#update-alternatif", function () {
        let uuid = $(this).data("uuid");
        let button = $(this)
        $(button).attr("disabled", "true");
        $("#spinner").html(loader)
        let formdata = $('form[id="form-alternatif"]').serialize();
        $.ajax({
            data: formdata + "&_method=PUT",
            url: "/alternatif/" + uuid,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $("#spinner").html("")
                $(button).removeAttr("disabled");
                reset();
                table.ajax.reload()
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $("#spinner").html("")
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    })

    //HAPUS DATA
    $("#table-alternatif").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus alternatif!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data: {
                        _method: "DELETE",
                        _token: token,
                    },
                    url: "/alternatif/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire("Deleted!", response.success, "success");
                    },
                });
            }
        });
    });

    //KOSONGKAN SEMUA INPUTAN
    function reset() {
        let form = $("form[id='form-alternatif']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        })
        $("#modal-alternatif .modal-title").html("")
        $("#modal-alternatif .modal-footer").html("")
        $("#modal-alternatif").modal("hide")
    }
    //Hendler Error
    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $("input.form-control").removeClass("is-invalid");
        $("select.form-control").removeClass("is-invalid");
        $("div.invalid-feedback").remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            let inputElement = $("input[name=" + field + "]");
            let selectElement = $("select[name=" + field + "]");
            let textAreaElement = $("textarea[name=" + field + "]");
            let feedbackElement = $(
                '<div class="invalid-feedback ml-2"></div>'
            );

            $(".btn-close").on("click", function () {
                inputElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                textAreaElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                selectElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
            });

            $.each(messages, function (index, message) {
                feedbackElement.append(
                    $('<p class="p-0 m-0" style="font-style=:italic">' + message + "</p>")
                );
            });

            if (inputElement.length > 0) {
                inputElement.addClass("is-invalid");
                inputElement.after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass("is-invalid");
                selectElement.after(feedbackElement);
            }
            if (textAreaElement.length > 0) {
                textAreaElement.addClass("is-invalid");
                textAreaElement.after(feedbackElement);
            }
            inputElement.each(function () {
                if (inputElement.attr("type") == "text" || inputElement.attr("type") == "number") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "date") {
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "password") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "email") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                }
            });
            textAreaElement.each(function () {
                textAreaElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
            selectElement.each(function () {
                selectElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
        });
    }
});
