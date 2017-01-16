<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url() ?>assets/css/login_style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  	<body>
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-6" >
			        <div id="logbox"  >
			            <form id="signup" method="post" action="/signup" >
			                <h1>Sign Up With Social Account</h1>
							 <input name="user[email]" type="email" placeholder="Email address" class="input pass"/>
			                <input name="user[password]" type="password" placeholder="Choose a password" required="required" class="input pass"/>
			                <input name="user[password2]" type="password" placeholder="Confirm password" required="required" class="input pass"/>
			                <input type="submit" value="Sign me up!" class="inputButton"/>

			            </form>
			        </div>
			    </div>     	
	    	</div>
	    </div> <!-- /container -->
  	</body>
</html>
