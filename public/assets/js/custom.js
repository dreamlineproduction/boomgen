(function($) {
    showSwal = function(type) {
      'use strict';
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
            }
        }).then(okay => {
            if (okay) {
                $("#"+type).trigger("submit");
            }
        });
    }

    $('input[name="optionsRadios"]').on("click", function() {
        if ($(this).is(':checked'))
        {
            if($(this).val() == "percent"){
                $( "#fixedoff" ).prop( "disabled", true );
                $('#percentageoff').prop( "disabled", false );
                $('#fixedoff').val('');
            }else{
                $( "#percentageoff" ).prop( "disabled", true );
                $('#fixedoff').prop( "disabled", false );
                $('#percentageoff').val('');
            }
        }
    });
    
  })(jQuery);