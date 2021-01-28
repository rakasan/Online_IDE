<html>
<head>
	<link rel="stylesheet" type="text/css" href="obj/style/form.css">
	<link rel="stylesheet" type="text/css" href="obj/style/font-awesome.min.css">
</head>
<body>
	<form action="obj/php/process_login.php" method="post" class = "form_login">
		<p class="field">
			<input type="text" name="login" placeholder ="Username or email">
			<i class="icon-user icon-large"></i>
		</p>
		<p class="field">
			<input type="password" name="password" placeholder ="Password">
			<i class="icon-lock icon-large"></i>
		</p> 
		<p class="submit">
			<button type="submit" name="submit"> 
				<i class="icon-arrow-right icon-large"></i>
			</button>
		<p>
			
			<p class="field">
			<?php

			if(isset($_GET['error'])){
				if($_GET['error'])
				echo '<h6 class=="red"> email sau parola gresita</6>';	
			}
			?>
				<a class="sign_up" href="sign_up.html">Inregisreaza-te </a>
			</p>
	</form>

	
<body>

</html>
