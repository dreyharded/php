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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formulario_cliente")) {
  $insertSQL = sprintf("INSERT INTO usuario (nome, cidade, estado, cpf, cep, data_nascimento, email, sexo, Password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['data_nascimento'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

  $insertGoTo = "cliente.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
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

  <form action="<?php echo $editFormAction; ?>" class="form-horizontal" method="POST" name="formulario_cliente">
<fieldset>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_nome">nome</label>  
  <div class="col-md-4">
  <input id="txt_nome" name="nome" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">digite seu nome completo </span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_cidade">cidade</label>  
  <div class="col-md-4">
  <input id="txt_cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">digite o nome da sua cidade</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_estado">estado</label>  
  <div class="col-md-1">
  <input id="text_estado" name="estado" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">digite as abreviaçao</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_cpf">Cpf</label>  
  <div class="col-md-4">
  <input id="text_cep" name="cpf" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">nao usar /</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_cep">CEP</label>  
  <div class="col-md-4">
  <input id="text_cep" name="cep" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">nao usar /</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txt_date">data de nascimento</label>  
  <div class="col-md-4">
  <input id="txt_date" name="data_nascimento" type="date" placeholder="" class="form-control input-md" required="">
  <span class="help-block">digite a data em que voçe nasceu como exemplo a seguir 00/00/0000</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text_email">E-mail</label>  
  <div class="col-md-4">
  <input id="text_email" name="email" type="email" placeholder="" class="form-control input-md" required="">
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
<div class="form-group">
  <label class="col-md-4 control-label" for="tex_tel">celular</label>  
  <div class="col-md-4">
  <input id="tex_tel" name="cell" type="tel" placeholder="" class="form-control input-md" required="">
  <span class="help-block">digite o nume do seu celular</span>  
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwor_input">Password </label>
  <div class="col-md-4">
    <input id="passwor_input" name="Password" type="password" placeholder="" class="form-control input-md" required="">
    <span class="help-block">digite sua senha</span>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_voltar"></label>
  <div class="col-md-8">
    <button id="btn_voltar" name="btn_voltar" class="btn btn-danger"><a href="login.php">voltar </a></button>
    <button id="btn_enviar" name="btn_enviar" class="btn btn-primary"><a href="cliente.php"></a> enviar</button>
  </div>
</div>
</div>

</fieldset>
<input type="hidden" name="MM_insert" value="formulario_cliente">
</form>
  
</body>
</html>