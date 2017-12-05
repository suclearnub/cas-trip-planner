$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';

    // overview-confirmation is the confirmation column for the overview section
    $('#confirmation a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(-1)
        ,name: 'confirmation'
    });

    $('#passportOK a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(-1)
        ,name: 'passportOK'
    });

    $('#visaOK a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(-1)
        ,name: 'passportOK'
    });

    $('#paid a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        ,pk: window.location.search.substr(-1)
        ,name: 'paid'
    });

    $('#activity-confirmation a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'},
            {value: 2, text: 'Rejected'}
        ]
        ,pk: window.location.search.substr(-1)
        ,name: 'confirmation'
    });

    $('#description a').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        ,pk: window.location.search.substr(-1)
        ,name: 'description'
    });

    $('#cost a').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        ,pk: window.location.search.substr(-1)
        ,name: 'cost'
    });

    $('#startDate a').editable({
        type: 'combodate',
        template: 'YYYY MM DD HH:mm',
        format: 'YYYY-MM-DD HH:mm',
        viewformat: 'YYYY-MM-DD HH:mm',
        placement: 'top'
        ,pk: window.location.search.substr(-1)
        ,name: 'startDate'
    });

    $('#endDate a').editable({
        type: 'combodate',
        template: 'YYYY MM DD HH:mm',
        format: 'YYYY-MM-DD HH:mm',
        viewformat: 'YYYY-MM-DD HH:mm',
        placement: 'top'
        ,pk: window.location.search.substr(-1)
        ,name: 'endDate'
    });
});