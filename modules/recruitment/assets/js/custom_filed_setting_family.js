// relation family
function new_relation_family(){
    "use strict";
    $('#relation').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#relation input[name="relation_name"]').val('');
    $('#additional_relation').html('');
}
function edit_relation_family(invoker,id){
    "use strict";
    $('#additional_relation').append(hidden_input('id',id));
    $('#relation input[name="relation_name"]').val($(invoker).data('name'));

    $('#relation').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}


// Marital Status family
function new_marital_status_family(){
    "use strict";
    $('#marital_status').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#marital_status_name input[name="marital_status_name"]').val('');
    $('#additional_marital_status').html('');
}
function edit_marital_status_family(invoker,id){
    "use strict";
    $('#additional_marital_status').append(hidden_input('id',id));
    $('#marital_status input[name="marital_status_name"]').val($(invoker).data('name'));

    $('#marital_status').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}

