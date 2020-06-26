<?php

	$name = $_POST['Name'];
	$email = $_POST['Email'];
	$message = $_POST['Message'];

	$field=true;

	if (empty($name) || empty($email))
	{
		$field = false;
	}
	if ($field== false){
		echo 'Name or email is empty! Please go back and fill it out.';
		exit;
	}

	if(IsInjected($visitor_email))
	{
	    echo "Bad email value!";
	    exit;
	}


	$email_from = 'admin@isaiahherr.com';

	$email_subject = "New Form Submission from $name";

	$email_body = "Name: $name\n".
									"User Email: $email\n".
										"User Message: $message\n";


	$to = "herrx080@umn.edu";

	$headers = "From $email_from \r\n";

	mail($to, $email_subject, $email_body, $headers);

	header("Location: thank-you.html");


	function IsInjected($str)
	{
	  $injections = array('(\n+)',
	              '(\r+)',
	              '(\t+)',
	              '(%0A+)',
	              '(%0D+)',
	              '(%08+)',
	              '(%09+)'
	              );
	  $inject = join('|', $injections);
	  $inject = "/$inject/i";
	  if(preg_match($inject,$str))
	    {
	    return true;
	  }
	  else
	    {
	    return false;
	  }
	}


?>
