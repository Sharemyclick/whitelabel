jQuery(document).ready(function (){


		jQuery('[id^=valid_]').click(
		function() {
		var id = jQuery(this).attr('id').substring(6);
		//jQuery('[id=delparam' + id + ']').attr('id','delparam' + new_id);
		jQuery('[id=result_' + id + ']').val('AND ' + jQuery('[id=column_' + id + ']').val() + " " + jQuery('#operator_' + id + ' option:selected').text() + " " + jQuery('[id=target_' + id + ']').val() + " " );
		});
		
		
		jQuery('[name^=operator_]').change(
		function() {
		var id = jQuery(this).attr('id').substring(9);
		var num = jQuery(this).val();
		switch(num){
			case "0":
				jQuery('[name=target_' + id + ']').attr("placeholder", "'John', 18, 'Blue', '2014-01-01'");
			break;
			case "1":
				jQuery('[name=target_' + id + ']').attr("placeholder","10000, '2014-01-01'");
			break; 
			case "2":
				jQuery('[name=target_' + id + ']').attr("placeholder","20000, '2014-01-01'");
			break; 
			case "3":
				jQuery('[name=target_' + id + ']').attr("placeholder","10000, '2014-01-01'");
			break; 
			case "4":
				jQuery('[name=target_' + id + ']').attr("placeholder","20000, '2014-01-01'");
			break; 
			case "5":
				jQuery('[name=target_' + id + ']').attr("placeholder", "'John', 18, 'Blue', '2014-01-01'");
			break; 
			case "6":
				jQuery('[name=target_' + id + ']').attr("placeholder","(1,2,3,4), ('John','David')");
			break; 
			case "7":
				jQuery('[name=target_' + id + ']').attr("placeholder","(1,2,3,4), ('John','David')");
			break; 
			case "8":
				jQuery('[name=target_' + id + ']').attr("placeholder", "'John', 18, 'Blue', '2014-01-01'");
			break; 
			default:
				jQuery('[name=target_' + id + ']').attr("placeholder", "Enter conditions here");
			break;
		}
		
		
		});
	

		
});