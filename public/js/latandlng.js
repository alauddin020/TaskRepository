$(document).ready( function ()
{
    $('.select2').select2();
    $("#birthday").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    $.ajax({
        url: 'http://ip-api.com/json/'+ip,
        type: 'GET',
        success: function (data) {
            $('#lat').val(data.lat)
            $('#lng').val(data.lon)
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Internet Connection Problem.\n Verify Network.';
            } else if (jqXHR.status === 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status === 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            $('#response').html(msg);
        },
    })
})
