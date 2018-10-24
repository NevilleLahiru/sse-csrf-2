<?php
$data;
session_start();


if(isset($_REQUEST['logout'])){
	$_SESSION['loggedIn'] = FALSE;
	session_destroy();
	
}

if(isset($_REQUEST['btnContact'])){
	
	// check if request has a CSRF token
	if(!isset($_REQUEST['CSRF'])){
		echo "No CSRF Token Found";
	}
	else{
		$tk = $_POST['CSRF']; // token from client side
		
		if(isset($_COOKIE['Token'])){ //check for session ID in cookie
			
			$c1 = $_COOKIE['Token'];
			$c2 = $_POST['CSRF'];
			
			if ( $c1 === $c2){ //validate token
				echo "<h3>Contact request accepted</h3>";
				$data['Status'] = "Success";
			}
			else echo "<h3>Request Failed. Invalid CSRF token.</h3>";
			
		}
		else  echo "Request Failed. No session cookie found.";
	}
	
}

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==TRUE) $data="You're logged in.";
else header("Location: index.php");




?>
<!DOCTYPE html>


<html>
	<head>
		<title>Protected</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div><?php //echo json_encode($data); ?></div>
		
		<h1>Protected</h1>	
		
	<form method="post" action="protected.php">
		<input type="hidden" value="true" name="logout" />
		<input type="submit" value="Logout" />
	</form>	
	<hr />
	
	<form id="contactForm" method="post" action="protected.php">
		<h4>Contact</h4>
		<input type="text" name="name"  placeholder="Name" /> <br/>
		<input type="text" name="mail"  placeholder="Email" /><br/>
		<input type="text" name="msg"  placeholder="Message" /><br/>
		<input type="submit" name="btnContact" value="Submit" />
	</form>
	</body>
<script>
$(document).ready(function(){
	
	console.log(getCookie('Token'));
	
	$('#contactForm').append('<input type="hidden" name="CSRF" value="'+getCookie('Token')+'"/>');
	
});

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
</script>
</html>