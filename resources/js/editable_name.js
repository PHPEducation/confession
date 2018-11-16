function editable_name() {
    // $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function () {
        $('.testEdit').editable({
            params: function (params) {
                // add additional params from data-attributes of trigger element
                params._token = $('#_token').data('token');
                params.name = $(this).editable().data('name');

                return params;
            },
            error: function (response, newValue) {
                if (response.status === 500) {
                    return trans('message.server_error');
                } else {
                    return response.responseText;
                }
            }
        });
    });
}
