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

mysql_select_db($database_conexao, $conexao);
$query_clientes = "SELECT * FROM usuario";
$clientes = mysql_query($query_clientes, $conexao) or die(mysql_error());
$row_clientes = mysql_fetch_assoc($clientes);
$totalRows_clientes = mysql_num_rows($clientes);
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
				
				<h1 class ="menudasemana">clientes</h1>
		     
				<table class="table table-striped">

      <caption> Titulo da tabela</caption> <!-- titulo da tabela -->
      <thead> <!-- cabeçalho da tabela -->
        <tr class="info">
          <th>id</th>
          <th>nome</th>
          <th>cidade</th>
          <th>estado</th>
          <th>cpf</th>
          <th>cep</th>
          <th>data de nascimento</th>
          <th>email</th>
          <th>tipo</th>
          <th>celular</th>
          <th>passord</th>
          <th>Inserir</th>
          <th>deletar</th>
        </tr>
      </thead>

      

      <tbody> 
        <?php do { ?>
        <tr>
             <th><?php echo $row_clientes['id_usuario']; ?></th>
            <th><?php echo $row_clientes['nome']; ?></th>
            <th><?php echo $row_clientes['cidade']; ?></th>
            <th><?php echo $row_clientes['estado']; ?></th>
            <th><?php echo $row_clientes['cpf']; ?></th>
            <th><?php echo $row_clientes['cep']; ?></th>
            <th><?php echo $row_clientes['data_nascimento']; ?></th>
            <th><?php echo $row_clientes['email']; ?></th>
            <th><?php echo $row_clientes['sexo']; ?></th>
            <th><?php echo $row_clientes['celular']; ?></th>
            <th><?php echo $row_clientes['Password']; ?></th>
            <th><button id="btn_entrar" name="btn_entrar" class="btn btn-danger" onclick="location. href='alterar.php?id_usuario=<?php echo $row_clientes['id_usuario']; ?>'">alterar</button>
            </th>
            <th>
            <button id="btn_entrar" name="btn_entrar" class="btn btn-danger" onclick="location. href='delete.php?id_usuario=<?php echo $row_clientes['id_usuario']; ?>'">deletar</button>
            
            </th>
           
            <?php } while ($row_clientes = mysql_fetch_assoc($clientes)); ?>
          
        </tr>

       
      </tbody>     <th></th>
    </table>
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
<?php
mysql_free_result($clientes);
?>
