// kind license
function new_kind_license(){
    "use strict";
    $('#kind').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#kind input[name="kind_name"]').val('');
    $('#additional_kind').html('');
}
function edit_kind_license(invoker,id){
    "use strict";
    $('#additional_kind').append(hidden_input('id',id));
    $('#kind input[name="kind_name"]').val($(invoker).data('name'));

    $('#kind').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}

function new_kind_document(){
    "use strict";
    $('#kinddocument').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#kinddocument input[name="kind_document_name"]').val('');
    $('#additional_kind_document').html('');
}
function edit_kind_document(invoker,id){
    "use strict";
    $('#additional_kind_document').append(hidden_input('id',id));
    $('#kinddocument input[name="kind_document_name"]').val($(invoker).data('name'));

    $('#kinddocument').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}

function new_kind_flag(){
    "use strict";
    $('#kindflag').modal('show');
    $('.edit-title').addClass('hide');
    $('.add-title').removeClass('hide');
    
    $('#kindflag input[name="kind_flag_name"]').val('');
    $('#additional_kind_flag').html('');
}
function edit_kind_flag(invoker,id){
    "use strict";
    $('#additional_kind_flag').append(hidden_input('id',id));
    $('#kindflag input[name="kind_flag_name"]').val($(invoker).data('name'));

    $('#kindflag').modal('show');
    $('.add-title').addClass('hide');
    $('.edit-title').removeClass('hide');
}