$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';

    // overview-confirmation is the confirmation column for the overview section
    $('#confirmation').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(1)
        ,name: 'confirmation'
    });

    $('#passportOK').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(1)
        ,name: 'passportOK'
    });

    $('#visaOK').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(1)
        ,name: 'passportOK'
    });

    $('#paid').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(1)
        ,name: 'paid'
    });

    $('#activity-confirmation').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'},
            {value: 2, text: 'Rejected'}
        ]
        ,pk: window.location.search.substr(1)
        ,name: 'confirmation'
    });

    $('#description').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        ,pk: window.location.search.substr(1)
        ,name: 'description'
    });

    $('#cost').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        ,pk: window.location.search.substr(1)
        ,name: 'cost'
    });

});