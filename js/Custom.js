function contact()
{
    jQuery('.contact_feild_error').html('');

	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var number=jQuery("#number").val();
	var message=jQuery("#message").val();
	var is_error='';

	if(name=="")
	{
		jQuery('#name_error').html('Please Enter Name*');
			is_error='Yes';

	}
	if(email=="")
	{
		jQuery('#email_error').html('Please Enter Email*');
			is_error='Yes';

	}
	if(number=="")
	{
		jQuery('#number_error').html('Please Enter Phone Number*');
			is_error='Yes';

	}
	if(message == "")
	{
		jQuery('#message_error').html('Please Fill Message*');
			is_error='Yes';

	}
	if(is_error=="")
	{
          jQuery.ajax({
                url:'Contact.php',
                type:'POST',
                data:'name='+name+'&email='+email+'&number='+number+'&message='+message,
                success:function(result)
                {
					result=result.trim();
                  if(result == 'ThankYou')
				  {
					  jQuery('#thank_result').html('Thank You!')
				  }
                }

          });
          
	}
}