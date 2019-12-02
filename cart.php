<?php
  session_start();


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./css.css" media="screen"/> 
	<title>PROVA DE PHP AMB L'ESTRUCTURA DE CONTROL WHILE I FORMULARI</title>
</head>
<style>
  
  </style>
	<body id="body">
  <?php
    echo "<h2>Carrito de ".$_SESSION['login']."</h2>";
    ?>
    <div id = "result">
    <?php
      for ($i=0;$i<count($_SESSION['text']);$i++){
        echo $_SESSION['text'][$i];
        echo "</br>";
        }
        echo "Precio total: ".$_SESSION['precioTotal']." euros";
        if(isset($_POST['back'])) {
          header('LOCATION:product.php'); die();
          }
        if(isset($_POST['receipt'])){
          $fitxer2=fopen("recibo.txt","w");
          fwrite($fitxer2,"Recibo de: ".$_SESSION['login'].PHP_EOL);
          for ($i=0;$i<count($_SESSION['text']);$i++){
            echo fwrite($fitxer2,$_SESSION['text'][$i].PHP_EOL); 
          }            
          fwrite($fitxer2,"Precio total: ".$_SESSION['precioTotal']);
          fclose($fitxer2);
          header('LOCATION:recibo.txt');
        }
        if(isset($_POST['receiptpdf'])){
          
          header('LOCATION:pdf.php');
        }  
    ?>
    </div>
		<form action="" method="POST">
			<div id = "inpusts">
    	  <input type="submit" name="back" value="Regresar a la tienda"/>
				<input type="submit" name="receipt" value="Recibo"/>
        <input type="submit" name="receiptpdf" value="ReciboPDF"/>
			</div>
   	</form>
	</body>
</html>
