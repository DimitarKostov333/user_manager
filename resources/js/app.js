require('./bootstrap');

$(document).ready(() => {

    // Initialize the datepicker library
    $('.datepicker').datepicker({
        format: 'yyyy-dd-mm',
        uiLibrary: 'bootstrap'
    });
});
