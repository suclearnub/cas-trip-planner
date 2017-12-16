$(document).ready(function() {

    function getID() {
        return window.location.search.substr(-1);
    }
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';

    // overview-confirmation is the confirmation column for the overview section
    $('#tripParticipants_confirmation a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        
        ,name: 'confirmation'
        ,params: {'table': 'tripParticipants', 'pkName': 'userNo', 'id': window.location.search.substr(-1), 'kName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#tripParticipants_passportOK a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        
        ,name: 'passportOK'
        ,params: {'table': 'tripParticipants', 'pkName': 'userNo', 'id': window.location.search.substr(-1), 'kName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#tripParticipants_visaOK a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        
        ,name: 'passportOK'
        ,params: {'table': 'tripParticipants', 'pkName': 'userNo', 'id': window.location.search.substr(-1), 'kName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#tripParticipants_paid a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]
        
        ,name: 'paid'
        ,params: {'table': 'tripParticipants', 'pkName': 'userNo', 'id': window.location.search.substr(-1), 'kName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#tripActivities_confirmation a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'},
            {value: 2, text: 'Rejected'}
        ]
        
        ,name: 'confirmation'
        ,params: {'table': 'tripActivities', 'pkName': 'tripActivitiesNo', 'id': window.location.search.substr(-1), 'kName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#tripActivities_description a').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        
        ,name: 'description'
        ,params: {'table': 'tripActivities', 'pkName': 'tripActivitiesNo'}
        ,url: 'edit.php'
    });

    $('#tripActivities_cost a').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        
        ,name: 'cost'
        ,params: {'table': 'tripActivities', 'pkName': 'tripActivitiesNo'}
        ,url: 'edit.php'
    });

    $('#tripActivities_startDate a').editable({
        type: 'combodate',
        combodate: {maxYear: moment().year()+5},
        template: 'YYYY MM DD HH:mm:ss',
        format: 'YYYY-MM-DD HH:mm:ss',
        viewformat: 'YYYY-MM-DD HH:mm:ss',
        placement: 'top'
        
        ,name: 'startDate'
        ,params: {'table': 'tripActivities', 'pkName': 'tripActivitiesNo'}
        ,url: 'edit.php'
    });

    $('#tripActivities_endDate a').editable({
        type: 'combodate',
        combodate: {maxYear: moment().year()+5},
        template: 'YYYY MM DD HH:mm:ss',
        format: 'YYYY-MM-DD HH:mm:ss',
        viewformat: 'YYYY-MM-DD HH:mm:ss',
        placement: 'top'

        ,name: 'endDate'
        ,params: {'table': 'tripActivities', 'pkName': 'tripActivitiesNo'}
        ,url: 'edit.php'
    });

    $('#trips_startDate a').editable({
        type: 'combodate',
        combodate: {maxYear: moment().year()+5},
        template: 'YYYY MM DD HH:mm:ss',
        format: 'YYYY-MM-DD HH:mm:ss',
        viewformat: 'YYYY-MM-DD HH:mm:ss',
        placement: 'top'

        ,name: 'startDate'
        ,params: {'table': 'trips', 'pkName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#trips_endDate a').editable({
        type: 'combodate',
        combodate: {maxYear: moment().year()+5},
        template: 'YYYY MM DD HH:mm:ss',
        format: 'YYYY-MM-DD HH:mm:ss',
        viewformat: 'YYYY-MM-DD HH:mm:ss',
        placement: 'top'

        ,name: 'endDate'
        ,params: {'table': 'trips', 'pkName': 'tripNo'}
        ,url: 'edit.php'
    });

    $('#trips_confirmation a').editable({
        type: 'select',
        title: 'Select status',
        placement: 'top',
        source: [
            {value: 0, text: 'No'},
            {value: 1, text: 'Yes'}
        ]

        ,name: 'confirmation'
        ,params: {'table': 'trips', 'pkName': 'tripNo' }
        ,url: 'edit.php'
    });
});