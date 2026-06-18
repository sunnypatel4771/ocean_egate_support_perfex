// relation family
function new_followup(){
    "use strict";
    $('#followup').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#followup input[name="status"]').val('');
    $('#additional_followup').html('');
}
function edit_followup(invoker,id){
    "use strict";
    $('#additional_followup').append(hidden_input('id',id));
    $('#followup input[name="status"]').val($(invoker).data('status'));
    $('#followup input[name="order_no"]').val($(invoker).data('order_no'));
    $('#followup input[name="color"]').val($(invoker).data('color'));

    $('#followup').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}