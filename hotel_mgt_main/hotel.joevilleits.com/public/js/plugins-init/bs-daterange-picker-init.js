(function($) {
    "use strict"

    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
         locale: {
      format: 'DD/MM/YYYY'
         },
         minYear: 2019,
         maxYear: 2200,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    
    $('.input-daterange-timepicker').daterangepicker({
        
        timePicker: true,
        timePicker24Hour: true,
        startDate: "04/25/2019",
        endDate: "05/01/2019",
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
        
    });
    
    $('.input-limit-datepicker').daterangepicker({
        format: 'DD-MM-YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
})(jQuery);