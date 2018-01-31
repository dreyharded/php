<?php require_once('Connections/conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['login_txt'])) {
  $loginUsername=$_POST['login_txt'];
  $password=$_POST['senha_txt'];
  $MM_fldUserAuthorization = "sexo";
  $MM_redirectLoginSuccess = "administracao.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexao, $conexao);
  	
  $LoginRS__query=sprintf("SELECT nome, Password, sexo FROM usuario WHERE nome=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'sexo');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
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
				<form ACTION="<?php echo $loginFormAction; ?>"  class="form-horizontal" method="POST" name="formulario_cliente">
<fieldset>

<!-- Form Name -->
<legend class="lol">login</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login_txt">login</label>  
  <div class="col-md-4">
  <input id="login_txt" name="login_txt" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="senha_txt">senha</label>  
  <div class="col-md-4">
  <input id="senha_txt" name="senha_txt" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_voltar"></label>
  <div class="col-md-8">
    <button id="btn_voltar" name="btn_voltar" class="btn btn-danger"><a href="index.php">voltar </a></button>
    <button id="btn_entrar" name="btn_entrar" class="btn btn-primary"><a >entrar</a></button>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_cadastrar"></label>
  <div class="col-md-4">
    <button id="btn_cadastrar" name="btn_cadastrar" class="btn btn-success"><a href="cadastro.php">cadastrar</a></button>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="tipo">tipo</label>
  <div class="col-md-4">
    <select id="tipo" name="tipo" class="form-control">
      <option value="1">administrador</option>
      <option value="2">usuario</option>
    </select>
  </div>
</div>



</fieldset>
</form>


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
			
