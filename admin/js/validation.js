jQuery(document).ready(function (){


		jQuery('[id^=addparam]').click(
		function() {
		
	
		jQuery.ajaxSetup({async: false});
		var id = jQuery(this).attr('id').substring(8);
		if(id == 1)jQuery('[id=delparam' + id + ']').show();
		var new_id = (parseFloat(id) + 1);
		jQuery('[id=paramdiv]').append("<div id='ws_div"+ new_id +"' class='form-group'>"+
					"<label for='inputWsparam"+ new_id +"' class='col-lg-2 control-label'>Param " + new_id + "</label>"+
						"<div class='col-lg-3'>"+
						 " <select name='ws_param"+ new_id +"' id='ws_param"+ new_id +"'>"+
							"<option value=''>------Choose------</option>"+						
						  "</select>"+
						"</div>"+
						"</div>");
		
		jQuery.ajax({
			  type: 'GET', 
			  contentType: "application/json",
			  url: 'serviceRequest.php', 
			  dataType : 'json',
			  data: {
			  }, 
			  success: function(data, textStatus, jqXHR) {
				var jsonObj = jQuery.parseJSON(JSON.stringify(data));
				jQuery.each(jsonObj, function( index, value ) {
				jQuery('[id=ws_param' + new_id + ']').append(jQuery("<option />").val(index).text(value));
				});
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
				// Une erreur s'est produite lors de la requete
			  }
		 });

		
		jQuery(this).attr('id','addparam' + new_id);
		jQuery('[id^=delparam' + id + ']').attr('id','delparam' + new_id);
		});
		
		jQuery('[id^=delparam]').click(
		function() {
		var id = jQuery(this).attr('id').substring(8);
		var new_id = (parseFloat(id) - 1);
		jQuery('[id=ws_div'+ id +']').remove();
		jQuery('[id=addparam' + id + ']').attr('id','addparam' + new_id);
		jQuery(this).attr('id','delparam' + new_id);
		if(new_id == 1)jQuery(this).hide();
		});

		jQuery('[name^=submitEditPopup]').click(
		function() {
		var id = jQuery(this).attr('name').substring(15);
		jQuery('[name=paramid]').val(id);
		jQuery('[name=command]').val('edit');
		jQuery('[name=paramedit]').val(jQuery('[name=param_' + id +']').val());
		jQuery('[name=fieldedit]').val(jQuery('[name=field_' + id +']').val());
		jQuery( "#formWs" ).submit();
		
		
		});
		
		jQuery('[name^=submitAddPopup]').click(
		function() {
		var id = jQuery(this).attr('name').substring(14);
		jQuery('[name=paramid]').val(id);
		jQuery('[name=command]').val('add');
		jQuery('[name=paramedit]').val(jQuery('[name=new_param_' + id +']').val());
		jQuery('[name=fieldedit]').val(jQuery('[name=new_field_' + id +']').val());
		jQuery( "#formWs" ).submit();
		
		
		});
		
		jQuery('[name^=submitDelPopup]').click(
		function() {
		var id = jQuery(this).attr('name').substring(14);
		jQuery('[name=paramid]').val(id);
		jQuery('[name=command]').val('del');
		jQuery( "#formWs" ).submit();
		
		
		});

		
});