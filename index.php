<?php 
session_start();

include "conn.php";



if (isset($_POST['login'])){

	 
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$query=mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
	$cek=mysqli_num_rows($query);
	$row=mysqli_fetch_array($query);
	$id_user=$row['id_user'];
	
	if($cek){
		$_SESSION['username']=$username;
		$_SESSION['id_user']=$id_user;
		$_SESSION['domain']=$row['level'];
					
		if($_SESSION['domain']=="admin"){
							
			?><script language="javascript">document.location.href="home.php?page=admin";</script><?php
			
		}
		
		if($_SESSION['domain']=="guru"){
			
			?><script language="javascript">document.location.href="home.php?page=input_nilai";</script><?php
			
		}
		
		if($_SESSION['domain']=="siswa"){
				
			?><script language="javascript">document.location.href="home.php?page=hasil_nilai";</script><?php
			
		}
	
		
	}else{
		?><script language="javascript">document.location.href="index.php?status=Gagal Login";</script><?php
	}	
	
			
}else{
	unset($_POST['login']);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Grading | SMK Teladan Kertasemaya </title>
<link rel="shortcut icon" href="smk.ico" type="icon">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">


</head>
<body id="login-bg" onLoad="document.postform.elements['username'].focus();" style="background: url(images/2.jpg);"> 
 
<div id="login-holder">

	
	<div class="clear"></div>
	
	<div id="loginbox">
	
	 <header class="header align-content-center">
	 	<img src="images/logo.png" width="150" height="70" style="margin-left: 43%">
    
    </h1>
    <p class="header__intro text-center">
        SMK Teladan Kertasemaya 
    </p>
</header>
<div class="row justify-content-sm-center">
        <div class="col-sm-6 col-md-4 col-md-border">

          <div class="card border-info text-center">
            <div class="card-header">
              Selamat Datang
            </div>
            <div class="card-body">
              <h4 class="text-center text-spacing">LOGIN</h4>
	<div id="login-inner">
    	<p align="center"><font face="verdana" size="2" color="#333333"><?php  if(isset($_GET['status'])){ echo "&laquo;".$_GET['status']."&raquo;"; }?></font></p>
        <p>&nbsp;</p>
        <form action="index.php" method="post" name="postform">
		 <input type="text" class="form-control mb-2" placeholder="Username" name="username" id="username" required autofocus>
                <input type="password" class="form-control mb-2" placeholder="Password" name="password" id="password" required>
                
        <!-- <tr>
			<th class="text-center text-spacing">Akses</th>
			<td>
             <select name="domain" class="form-control mb-2">
            	<option value="admin"> ADMIN </option>
                <option value="guru"> GURU </option>
                <option value="siswa"> SISWA </option>
            </select>
            </td>
		</tr> -->
		
			<tr>
			<th></th>
			<td><input type="submit" class="btn btn-lg btn-primary btn-block mb-1 buttn" name="login" value="Login" /></td>
		</tr>
		</table>
        </form>
	</div>
    
    
    

	<div class="clear"></div>
 </div>
 
 <script src='https://www.google.com/recaptcha/api.js'></script>

</div>

</body>

</html>