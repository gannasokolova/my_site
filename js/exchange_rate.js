function exchangeRate(el){
    var currencyCode = $(el).attr('id');
    //var currency = $(el).html();
    var currencyArray = {
        'UAH': 'грн',
        'USD': '$',
        'EUR': '&euro;'
    };
    var currency = currencyCode in currencyArray ? currencyArray[currencyCode] : $(el).html();
    var baseUrl = window.location.pathname;
    var cc = baseUrl + "exchange?currency="+ currencyCode;
    $.ajax({
        type:  'GET',
        url:   baseUrl + "/exchange?currency="+ currencyCode,
        dataType: 'json',
        success: function (result) {
            var json = $.parseJSON(JSON.stringify(result));
            $(json.price).each(function(i,val){
                $.each(val,function(key,val){
                    var el = $("#"+key);
                    el.html(val + " " + currency);
                    if(el.is('div')){
                        el.removeClass('hide');
                    }
                });
            });
        },
        error: function () {
            $("#error_exchange").removeClass('hide');
            $("#error_info").html("Информация о курсе валют обновляется. Попробуйте повторить запрос позже");
        }
        /*
         error: function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
         }
         */
    });
}

function viewDetail(id){
    var div = document.getElementById(id);
    div.className =(div.className == 'panel-heading hidden' ? 'panel-heading': 'panel-heading hidden');
    var id_1 = id.replace("_short","_full");
    var div_1 = document.getElementById(id_1);
    div_1.className =(div_1.className == 'panel-heading hidden' ? 'panel-heading': 'panel-heading hidden');
}
