const { __ } = wp.i18n;
jQuery(document).ready(function(){
    // Disabling children and infants depending on show field

    if(jQuery("#hsbe_enable_children").children("option:selected").val()==0){
        jQuery("#hsbe_children_default").prop( "disabled", true );
        jQuery("#hsbe_children_min").prop( "disabled", true );
        jQuery("#hsbe_children_max").prop( "disabled", true );
    }
    jQuery("#hsbe_enable_children").change(function(){
        if(jQuery("#hsbe_enable_children").children("option:selected").val()==0){
            jQuery("#hsbe_children_default").prop( "disabled", true );
            jQuery("#hsbe_children_default").val(0);
            jQuery("#hsbe_children_min").prop( "disabled", true );
            jQuery("#hsbe_children_min").val(0);
            jQuery("#hsbe_children_max").prop( "disabled", true );
            jQuery("#hsbe_children_max").val(4);
        }
        else{
            jQuery("#hsbe_children_default").prop( "disabled", false );
            jQuery("#hsbe_children_min").prop( "disabled", false );
            jQuery("#hsbe_children_max").prop( "disabled", false );
        }
    });

    if(jQuery("#hsbe_enable_infants").children("option:selected").val()==0){
        jQuery("#hsbe_infants_default").prop( "disabled", true );
        jQuery("#hsbe_infants_min").prop( "disabled", true );
        jQuery("#hsbe_infants_max").prop( "disabled", true );
    }
    jQuery("#hsbe_enable_infants").change(function(){
        if(jQuery("#hsbe_enable_infants").children("option:selected").val()==0){
            jQuery("#hsbe_infants_default").prop( "disabled", true );
            jQuery("#hsbe_infants_default").val(0);
            jQuery("#hsbe_infants_min").prop( "disabled", true );
            jQuery("#hsbe_infants_min").val(0);
            jQuery("#hsbe_infants_max").prop( "disabled", true );
            jQuery("#hsbe_infants_max").val(4);
        }
        else{
            jQuery("#hsbe_infants_default").prop( "disabled", false );
            jQuery("#hsbe_infants_min").prop( "disabled", false );
            jQuery("#hsbe_infants_max").prop( "disabled", false );
            
        }
    });

    // Validation on submit

    jQuery("#hsbe-spider-booking").submit(function(e){
        var hsbeErrorMsg = '';

        var adultsDefVal = parseInt(jQuery("#hsbe_adults_default").children("option:selected").val());
        var adultsMinVal = parseInt(jQuery("#hsbe_adults_min").children("option:selected").val());
        var adultsMaxVal = parseInt(jQuery("#hsbe_adults_max").children("option:selected").val());

        var childrenDefVal = parseInt(jQuery("#hsbe_children_default").children("option:selected").val());
        var childrenMinVal = parseInt(jQuery("#hsbe_children_min").children("option:selected").val());
        var childrenMaxVal = parseInt(jQuery("#hsbe_children_max").children("option:selected").val());

        var infantsDefVal = parseInt(jQuery("#hsbe_infants_default").children("option:selected").val());
        var infantsMinVal = parseInt(jQuery("#hsbe_infants_min").children("option:selected").val());
        var infantsMaxVal = parseInt(jQuery("#hsbe_infants_max").children("option:selected").val());

        jQuery("#hsbe-validation-error").removeClass("hsbe-error-msg-hide");
        if(adultsMinVal>adultsMaxVal){
            hsbeErrorMsg+= "<p>"+__('Adults minimum value is greater than maximum value', 'hotel-spider')+"</p>";
        }

        if(childrenMinVal>childrenMaxVal){
            hsbeErrorMsg+= "<p>"+__('Children minimum value is greater than maximum value', 'hotel-spider')+"</p>";
        }

        if(infantsMinVal>infantsMaxVal){
            hsbeErrorMsg+= "<p>"+__('Infants minimum value is greater than maximum value', 'hotel-spider')+"</p>";
        }

        if(adultsDefVal<adultsMinVal){
            hsbeErrorMsg+= "<p>"+__('Adults default value is less than minimum value', 'hotel-spider')+"</p>";
        }
        else if(adultsDefVal>adultsMaxVal){
            hsbeErrorMsg+= "<p>"+__('Adults default value is greater than maximum value', 'hotel-spider')+"</p>";
        }

        if(childrenDefVal<childrenMinVal){
            hsbeErrorMsg+= "<p>"+__('Children default value is less than minimum value', 'hotel-spider')+"</p>";  
        }
        else if(childrenDefVal>childrenMaxVal){
            hsbeErrorMsg+= "<p>"+__('Children default value is greater than maximum value', 'hotel-spider')+"</p>";
        }

        if(infantsDefVal<infantsMinVal){
            hsbeErrorMsg+= "<p>"+__('Infants default value is less than minimum value', 'hotel-spider')+"</p>";  
        }
        else if(infantsDefVal>infantsMaxVal){
            hsbeErrorMsg+= "<p>"+__('Infants default value is greater than maximum value', 'hotel-spider')+"</p>";
        }
        if(hsbeErrorMsg.length){
            e.preventDefault();
            jQuery("#hsbe-validation-error").html(hsbeErrorMsg);
            jQuery("#hsbe-validation-error").removeClass("hsbe-error-msg-hide");
            jQuery(window).scrollTop(0);
        }

    });

});