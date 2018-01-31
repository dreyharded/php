<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "usuario";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/rest.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
</head>
<body>

	<header class="row">
		<div class="container col-xs-12 col-sm-12 col-md-12">
			<nav class =" menu tresborda ">
				<ul class= "">
					<li><a href="index.php">menu</a></li>
					<li><a href="sobre.php">sobre</a></li>
					<li><a href="contato.php">contato</a></li>
				</ul>
			</nav>	
		</div>
                    <div class="restimagem" >
                    	<img src="img/casamento51.png" alt="logo fazfesta" class ="imagemlogo">
                    </div>
					
                 <div class= "contato">
					<h2></h2>
					<h3></h3>
					</div>
			
								
			

		
	</header>

	<section class=" fundomenu ">
		<div class="container">
				<div>
				<h1 class ="menudasemana"> FazFesta o melhor de campinas</h1>
     
                 <div class="form-group">
  <label class="col-md-4 control-label" for="btn_cadastrar"></label>
  <div class="col-md-4">
    <button id="btn_cadastrar" name="btn_cadastrar" class="btn btn-success"><a href="evento.php">evento</a></button>
    <button id="btn_cliente" name="btn_cliente" class="btn btn-primary"><a href="cliente.php">cliente</a></button>
    <button id="btn_cliente" name="btn_cliente" class="btn btn-danger"><a href="<?php echo $logoutAction ?>">sair</a></button>
  </div>
</div>
	     
	     	
				</div>	
       	</div>
    </section>
    
    <footer class= "rodape row">     
           <ul>

           	<li>menu</li>
             <li>sobre</li>
             <li>contato</li>
             <li><a href="login.php">cadastro</a></li>


           </ul>

           <p>rest @2015 alguns direitos reservados</p>

    </footer>

	
		

	
	
</body>
</html>
		     