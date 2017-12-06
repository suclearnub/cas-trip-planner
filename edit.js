$(document).ready(function() {

    function getID() {
        return window.location.search.substr(-1);
    }
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';

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
        ,url: 'edit.php?table=tripParticipants&pkName=userNo&id=' + window.location.search.substr(-1) + '&kName=tripNo'
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
        ,url: 'edit.php?table=tripParticipants&pkName=userNo&id=' + window.location.search.substr(-1) + '&kName=tripNo'
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
        ,url: 'edit.php?table=tripParticipants&pkName=userNo&id=' + window.location.search.substr(-1) + '&kName=tripNo'
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
        ,url: 'edit.php?table=tripParticipants&pkName=userNo&id=' + window.location.search.substr(-1) + '&kName=tripNo'
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
        ,url: 'edit.php?table=tripParticipants&pkName=userNo&id=' + window.location.search.substr(-1) + '&kName=tripNo'
    });

    $('#tripActivities_description a').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        
        ,name: 'description'
        ,url: 'edit.php?table=activities?pkName=tripActivitiesNo'
    });

    $('#tripActivities_cost a').editable({
        type: 'text',
        clear: true,
        placement: 'top'
        
        ,name: 'cost'
        ,url: 'edit.php?table=activities?pkName=tripActivitiesNo'
    });

    $('#tripActivities_startDate a').editable({
        type: 'combodate',
        template: 'YYYY MM DD HH:mm',
        format: 'YYYY-MM-DD HH:mm',
        viewformat: 'YYYY-MM-DD HH:mm',
        placement: 'top'
        
        ,name: 'startDate'
        ,url: 'edit.php?table=activities?pkName=tripActivitiesNo'
    });

    $('#tripActivities_endDate a').editable({
        type: 'combodate',
        template: 'YYYY MM DD HH:mm',
        format: 'YYYY-MM-DD HH:mm',
        viewformat: 'YYYY-MM-DD HH:mm',
        placement: 'top'
        
        ,name: 'endDate'
        ,url: 'edit.php?table=activities?pkName=tripActivitiesNo'
    });
});