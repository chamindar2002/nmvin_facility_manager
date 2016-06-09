


$('#PaymentModelInstallment_payment_plan_master_id').change(function(event) {
           
           var val = $('#PaymentModelInstallment_payment_plan_master_id').val();
           var url = window.location.href;
           if(val !== ''){
               //alert(val + 'sssp');
               addParam(url,'payment_plan',val);
           }else{
               //console.log('0');
               addParam(url,'payment_plan',0);
        
           }
           
           
    });
    
$('#PaymentModelPaymentPlanItem_payment_plan_master_id').change(function(event) {
           
           var val = $('#PaymentModelPaymentPlanItem_payment_plan_master_id').val();
           var url = window.location.href;
           if(val !== ''){
               //alert(val + 'sssm');
               addParam(url,'payment_plan',val);
           }else{
               //console.log('0');
               addParam(url,'payment_plan',0);
        
           }
           
           
    });
    
    
    
 function addParam(url, param, value) {
   var a = document.createElement('a'), regex = /[?&]([^=]+)=([^&]*)/g;
   var match, str = []; a.href = url; value=value||"";
   while (match = regex.exec(a.search))
       if (encodeURIComponent(param) != match[1]) str.push(match[1] + "=" + match[2]);
   str.push(encodeURIComponent(param) + "=" + encodeURIComponent(value));
   a.search = (a.search.substring(0,1) == "?" ? "" : "?") + str.join("&");
   //return a.href;
   window.location.href = a.href;
}


function faciltyMasterSubmitCustomerCode(){
    var customerCode = $('#FacilityMaster_customer_id').val();
    var url = window.location.href;
    addParam(url,'Customer_Code',customerCode);;
}

$("#chk_enforce_installment_definer").change(function() {
    var url = window.location.href;
    if(this.checked) {
        addParam(url,'installment','enforce');
    }
});


$('input:radio[name="opt_method_of_payment"]').change(function(){
    var method_of_payment = $(this).val();
    
    if(method_of_payment == 'BANK DEPOSIT'){
        $('#PaymentReceiptsMaster_cheque_number').attr("readonly", "readonly"); 
    }else{
        $('#PaymentReceiptsMaster_cheque_number').removeAttr("readonly", "readonly"); 
    }
      
});

$(document).ready(function () {
    $('form#delete-form').submit(function() {
        var c = confirm("Confirm Deletion of facility?");
        return c;
    });
});

function appendErrors(_err){

    var msg = '<ul>';
    $.each( _err, function( key, value) {

        //console.log('error fldfs :' + value);
        msg += '<li class="errorMessage">' + value + '</li>';

    });

    msg += '</ul>';

    return msg;

}

function appendSuccess(msg){

    var msg = '<div class="flash-success">'+ msg + '</div>';

    return msg;
}


var counted = 0;
var rows = 0;

function notificationsPull() {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        contentType: "application/json; charset=utf-8",
        cache: false,
        url: 'http://127.0.0.1:8000/todo',


        beforeSend: function () {
            //console.log('ok');
        },
        success: function (result, status, jqXHR) {

            $('#notification_item_list_customer').html('');

            if(result.length > 0){

                $.each(result, function (k, v) {

                    $('#notification_receipt_count').html(result.length)
                    $('#notification_item_list_customer').append('<li><a href="#">'+v.customer_name+'<span  class="label label-primary"></span></a></li>');

                    rows = result.length;

                    if(rows > counted){
                        $('#notification_receipt_count').removeClass('btn-info');
                        $('#notification_receipt_count').addClass('label-danger');
                    }

                })

            }else{
                $('#notification_receipt_count').html('0');
                $('#notification_receipt_count').removeClass('label-danger');
                $('#notification_receipt_count').addClass('btn-info');
                //$('#notification_item_list_customer).
            }



            //console.log(result.length);

        }
    });
}


setInterval(notificationsPull, 60000);

$('#notification_receipt_count').click(function(){
    $(this).removeClass('label-danger');
    $(this).addClass('btn-info');
    counted = rows
});