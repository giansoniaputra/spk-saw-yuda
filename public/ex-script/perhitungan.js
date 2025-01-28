$(document).ready(function () {
    $("#table-perhitungan").on("change", ".input-bobot", function () {
        let thiss = $(this)
        // let p = $(this).parent().prev()
        let uuid = $(this).data("uuid")
        $.ajax({
            data: {
                bobot: thiss.val(),
                _token: csrfToken
            },
            url: "/perhitungan-update/" + uuid,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // p.html(response.success)
                // thiss.val(response.success)
            }
        });
    })

    $("#cari-keputusan").on("click", function () {
        $("#spinner").html(loader)
        $.ajax({
            data: { _token: csrfToken },
            url: "/cari-keputusan",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $("#spinner").html("")
                $("#normalisasi").html(response.view_normalisasi);
                $("#preferensi").html(response.view_preferensi);
                $("#ranking").html(response.view_ranking);
            }
        });
    })
});
