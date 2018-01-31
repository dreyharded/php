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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "alterar")) {
  $updateSQL = sprintf("UPDATE usuario SET nome=%s, cidade=%s, estado=%s, cpf=%s, cep=%s, data_nascimento=%s, email=%s, sexo=%s, celular=%s, Password=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['data_nascimento'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());

  $updateGoTo = "cliente.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_alterar = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_alterar = $_GET['id_usuario'];
}
mysql_select_db($database_conexao, $conexao);
$query_alterar = sprintf("SELECT * FROM usuario WHERE id_usuario = %s", GetSQLValueString($colname_alterar, "int"));
$alterar = mysql_query($query_alterar, $conexao) or die(mysql_error());
$row_alterar = mysql_fetch_assoc($alterar);
$totalRows_alterar = mysql_num_rows($alterar);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/cadastro.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    input[type="text"] {background-color: #fff;color:#000}
    input:invalid{background-color: yellow;color: red}
    
  </style>
</head>
<body>
    
    <header class="row">
    <div class="container col-xs-12 col-sm-12 col-md-12">
      <nav class =" menu tresborda ">
        <ul class= "">
          <li><a href="index.html">menu</a></li>
          <li><a href="sobre.html">sobre</a></li>
          <li><a href="contato.html">contato</a></li>
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

  <form class="form-horizontal" action="<?php echo $editFormAction; ?>" method="POST" name="alterar">
<fieldset>

<!-- Form Name -->
<legend>formulario</legend>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_nome">nome</label>  
  <div class="col-md-4">
  <input id="txt_nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['nome']; ?>">
  <span class="help-block">digite seu nome completo </span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_cidade">cidade</label>  
  <div class="col-md-4">
  <input id="txt_cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['cidade']; ?>">
  <span class="help-block">digite o nome da sua cidade</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_estado">estado</label>  
  <div class="col-md-1">
  <input id="text_estado" name="estado" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['estado']; ?>">
  <span class="help-block">digite as abreviaçao</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_cpf">Cpf</label>  
  <div class="col-md-4">
  <input id="text_cep" name="cpf" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['cpf']; ?>">
  <span class="help-block">nao usar /</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_cep">CEP</label>  
  <div class="col-md-4">
  <input id="text_cep" name="cep" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['cep']; ?>">
  <span class="help-block">nao usar /</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_date">data de nascimento</label>  
  <div class="col-md-4">
  <input id="txt_date" name="data_nascimento" type="date" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['data_nascimento']; ?>">
  <span class="help-block">digite a data em que voçe nasceu como exemplo a seguir 00/00/0000</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_email">E-mail</label>  
  <div class="col-md-4">
  <input id="text_email" name="email" type="email" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['email']; ?>">
  <span class="help-block">digite o seu E-mail pessoal</span>  
  </div>
</div>



<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios_sexo">tipo</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios_sexo-0">
      <input type="radio" name="sexo" id="radios_sexo-0" value="administrador">
      administrador
    </label>
  </div>
  <div class="radio">
    <label for="radios_sexo-1">
      <input type="radio" name="sexo" id="radios_sexo-1" value="usuario"> 
      usuario
    </label>
  </div>
  </div>
</div>



<!-- Text input-->
<div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="tex_tel">celular</label>  
    <div class="col-md-4">
      <input id="tex_tel" name="celular" type="tel" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['celular']; ?>">
      <span class="help-block">digite o nume do seu celular</span>  
      </div>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwor_input">Password </label>
  <div class="col-md-4">
    <input id="passwor_input" name="Password" type="password" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['Password']; ?>">
    <span class="help-block">digite sua senha</span>
  </div>
</div>

<input type="hidden" value="<?php echo $row_alterar['id_usuario']?>" name="id_usuario">

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_voltar"></label>
  <div class="col-md-8">
   <button id="btn_voltar" name="btn_voltar" class="btn btn-danger"><a href="cadastro.html">procurar </a></button>
    <button id="btn_voltar" name="btn_voltar" class="btn btn-danger"><a href="cadastro.html">voltar </a></button>
    <button id="btn_enviar" name="btn_enviar" class="btn btn-primary">enviar</button>
  </div>
</div>
</div>

</fieldset>
<input type="hidden" name="MM_update" value="alterar">
</form>
  
</body>
</html>
<?php
mysql_free_result($alterar);
?>
<body>
</body>
</html>