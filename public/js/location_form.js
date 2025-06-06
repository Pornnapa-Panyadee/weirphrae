$(document).ready(function () {
    // โหลดอำเภอของจังหวัด แพร่
    $.getJSON('/weir/phrae/district/แพร่', function (data) {
        $.each(data, function (i, obj) {
            $('#weir_district').append('<option value="' + obj.vill_district + '">' + obj.vill_district + '</option>');
        });
    });

    // เมื่อเลือกอำเภอแล้วโหลดตำบล
    $('#weir_district').on('change', function () {
        var district = $(this).val();
        $('#weir_tumbol').empty().append('<option value="">-- เลือกตำบล --</option>');

        if (district) {
            $.getJSON('/weir/phrae/subdistrict/' + encodeURIComponent(district), function (res) {
                $.each(res.data, function (i, obj) {
                    $('#weir_tumbol').append('<option value="' + obj.vill_tunbol + '">' + obj.vill_tunbol + '</option>');
                });
            });
        }
    });

    // เมื่อเลือกอำเภอแล้วโหลดตำบล

    $('#weir_tumbol').on('change', function () {
        var district = $('#weir_district').val();
        var tumbol = $(this).val();

        $('#weir_village').empty().append('<option value="">-- เลือกหมู่บ้าน --</option>');

        if (district && tumbol) {
            $.getJSON('/weir/phrae/getVillages/' + encodeURIComponent(district) + '/' + encodeURIComponent(tumbol), function (res) {
                $.each(res.data, function (i, obj) {
                    $('#weir_village').append('<option value="หมู่ที่ ' + obj.vill_moo + ' ' + obj.vill_name + '"> หมู่ที่ ' + obj.vill_moo + ' ' + obj.vill_name + '</option>');
                });
            });
        }
    });

});
