<script type="text/javascript">
$(document).ready(function () {
        $("#nama_perusahaan_pemohon").keyup(function () {
            $.ajax({
                type: "POST",
                url: "index.php/autocomplete/GetPerusahaanName",
                data: {
                    keyword: $("#nama_perusahaan_pemohon").val()
                },
                 dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        $('#DropdownCustomer').empty();
                        $('#nama_perusahaan_pemohon').attr("data-toggle", "dropdown");
                        $('#DropdownCustomer').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#nama_perusahaan_pemohon').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                        $('#DropdownCustomer').append('<li role="presentation" >' + value['nama'] + '</li>');
                    });
                }
            });
        });
        $('ul.txtcountry').on('click', 'li a', function () {
            $('#nama_perusahaan_pemohon').val($(this).text());
        });
    });
</script>