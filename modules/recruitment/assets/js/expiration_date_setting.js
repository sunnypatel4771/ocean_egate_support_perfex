function tab_expiration_date_setting() {
    "use strict";
    var data = $("#recruitment_tab_expiration_date_setting").val();

    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    var postData = {};
    postData['recruitment_tab_expiration_date_setting'] = data;
    postData[csrfName] = csrfHash;

    $.post(admin_url + 'recruitment/tab_expiration_date_setting', postData).done(function(response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert_float('success', response.message);
        } else {
            alert_float('warning', response.message);
        }
    });
}
