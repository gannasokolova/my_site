    function send_email(el) {
        event.preventDefault();
        $(el).prop( 'disabled', true );
        var form = $('#email_send');
        dataForm = form.serialize();
        var url = $(form).attr('action');
        $.ajax({
            url: url,
            method: 'POST',
            data: dataForm,
            type:"JSON",
            dataType: 'JSON',
            success: function (responce) {
                $('#open_email_send_form').modal('hide');
                if( ! $('#error').hasClass('hide')){
                    $('#error').addClass('hide');
                }
                $('#name').val('');
                $('#phone').val('');
                $('#success').modal('show');
                $(el).prop( 'disabled', false );
            },
            error: function (responce){
                var errors;
                errors = responce.responseJSON.errors;
                if(errors == null){
                    errors = "Не удалось отправить заявку, пожалуйста, попробуйте еще раз.";
                }
                $( "#submit" ).attr( "data-content", errors );
                $('#submit').popover('show');
                $('#error').html(
                    errors
                );
                $('#error').removeClass('hide');
                $(el).prop( 'disabled', false );
            }
        });
    };
    function clear_info() {
        if( ! $('#error').hasClass('hide')){
            $('#error').addClass('hide');
        }
    };

    function  show_form_request (price_id){
        $('#price_id').val(price_id);
        $('#open_email_send_form').modal('show');
    };

    $( document ).ready(function() {
        $("#phone").mask("+38 (999) 999-9999");
    });





