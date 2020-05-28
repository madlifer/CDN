/*
* @Author: suifengtec
* @Date:   2018-01-21 18:51:40
* @Last Modified by:   suifengtec
* @Last Modified time: 2018-01-22 08:10:53
*/
jQuery( function( $ ) {


    var changeCities = function(what){

        var selectedV = $("select#"+what+"_city").val()?$("select#"+what+"_city").val():'WTF';

    var stateS = $('select#'+what+'_state');
    var countryS = $('select#'+what+'_country');
        $.ajax({
            url: wcc4c.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {action: 'wc_province_changed',pid:stateS.val()},
            success:function(r){
                console.log(r);
                console.log(stateS.val());
                    if(r.success===true){
                         $("select#"+what+"_city option").remove();
                            $.each(r.data.cs, function(k, v){


                                $('select#'+what+'_city').append('<option value="'+ k +'" '+(selectedV&&(selectedV==k)?'':'')+'>'+ v +'</option>');
                            });
                    }/*else{
                        alert('请刷新页面后重试!');
                    }*/

            }
        });




    };

$('select#billing_state').on('change',function() {
    if('CN'==$('select#billing_country').val()){
        changeCities('billing');
    }
});
$('select#shipping_state').on('change',function() {
    if('CN'==$('select#shipping_country').val()){
        changeCities('shipping');
    }
});

$('select#billing_country').on('change',function() {
        if('CN'==this.value){
            changeCities('billing');
        }
    });
$('select#shipping_country').on('change',function() {
        if('CN'==this.value){
            changeCities('shipping');
        }
});


});