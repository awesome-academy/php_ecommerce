$(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#logout').on('click', function () {
        $.ajax(
        {
            url: '/logout',
            method: 'post',
            success: function (response)
            {
                location.reload();
            }

        });
    });
});
