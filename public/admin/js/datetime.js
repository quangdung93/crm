$(document).ready(function(){
    $("#start_date").datetimepicker({
        format: 'DD/MM/YYYY',
        defaultDate: new Date()
    });

    $("#start_time").datetimepicker({
        format: 'LT',
        defaultDate: new Date()
    });

    $("#end_date").datetimepicker({
        format: 'DD/MM/YYYY',
    });
    
    $("#end_time").datetimepicker({
        format: 'LT',
    });

    $("#start_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "dd/mm/yyyy")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");

    $(document).on('change','#is_expired',function(){
        if ($(this).is(':checked')) {
            $('#end_date').prop('disabled',true);
            $('#end_time').prop('disabled',true);
        }else{
            $('#end_date').removeAttr('disabled');
            $('#end_time').removeAttr('disabled');
        }
    });
    
});