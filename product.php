<?php
  session_start();
  if(isset($_POST['logout'])){
    session_unset(); 
  }
    if(!isset($_SESSION['login'])) {
      header('LOCATION:index.php'); die();
    }
    if(!isset($_SESSION['array'])) {
      $_SESSION['array']=array();
    }  
    if(isset($_POST['empty'])){
      $_SESSION['array']=array();
    }
    if(isset($_POST['cart'])){
      $_SESSION['text']=array();
      for($j=0;$j<count($_SESSION['array']);$j++){
        array_push($_SESSION['text'],$_SESSION['array'][$j]->__toString());
      }
      $_SESSION['precioTotal']=0;
      for($j=0;$j<count($_SESSION['array']);$j++){
        $_SESSION['precioTotal']=$_SESSION['precioTotal']+$_SESSION['array'][$j]->getPreuTotal();
      }
      $_SESSION['img']=array();
      for($j=0;$j<count($_SESSION['array']);$j++){
        array_push($_SESSION['img'],$_SESSION['array'][$j]->getNom());
      }
      
      header('LOCATION:cart.php'); die(); 
    }

    Class Producte{
      private $preu;
      private $nom;
      private $cantidad;
      public function __construct($nom,$p,$can){
        $this->preu=$p;
        $this->nom=$nom;
        $this->cantidad=$can;
      }

      function getNom(){
        return $this->nom;
      }
      function getPreuTotal(){
        $preuTotal=$this->preu*$this->cantidad;
        return $preuTotal;
      }
      function getCantidad(){
        return $this->cantidad;
      }
      function setCantidad($cant){
        $this->cantidad=$this->cantidad+$cant;
      }

      function __toString() {
        return "Producto: ".$this->nom." Precio: ".$this->preu."euros Cantidad: ".$this->cantidad;
      }

    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv='content-type' content='text/html;charset=utf-8' />
    <title>Product</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css.css" media="screen"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <style>


  </style>
  <body id="body">
      <h1 id="titulo">VicDamStore</h1>
      <form action="" method="POST" id="logout">
          <input type="submit" name="logout" value="Logout"/>
      </form>
    <?php
    if(isset($_POST['carro'])){
      foreach ($_POST as $name => $value) {
        $b=true;
        if($value>0){
          $valores=explode(";",$name);
          for($j=0;$j<count($_SESSION['array']);$j++){
            if($_SESSION['array'][$j]->getNom()==$valores[0]){
              $_SESSION['array'][$j]->setCantidad($value);
              $b=false;
            }
          }
          if($b){
            $p=new Producte($valores[0],$valores[1],$value);
            array_push($_SESSION['array'],$p);
          }
        }
      }  
    } 
  ?>
  
  <?php
      echo "<h3 id='subtitulo'>Bienvenido ".$_SESSION['login']."</h3>";
  ?>
    <div id = "result">
      <form action="" method="POST">
        <?php
           $fitxer=fopen("productos.txt","r");
           for ($i = 0; $fila = fgets($fitxer); ++$i) {
            $args=explode(";",$fila);
            if (!($i%3)){
               echo "<div class='flex-container'>";
            } 
            echo "<div class='content'>";
            echo "<h3>".$args[0]."</h3><p> Precio:".$args[1]." €</p>";
            echo "<img src='./img/".$args[0].".jpg' class = 'icono'><br><br>";
            echo "<p>Cantidad: </p><input type='number' name='".$args[0].";".$args[1]."' min='0' >";
            echo "</div>";
            if (!(($i+1)%3)){
              echo "</div>";
           } 
           if($i==8){
           break;
           }
          }
          
          fclose($fitxer);
        ?>
        <!-- <div class="flex-container">
          <div class=" content">
            <h3>Pelota</h3><p> Precio: 30 €</p>
            <img src="./img/pelota.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="pelota;30" min="0" >
          </div>
          <div class=" content">
            <h3>Guantes</h3><p> Precio: 20 €</p>
            <img src="./img/guantes.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="guantes;20" min="0" >
          </div>  
          <div class=" content">
            <h3>Raqueta</h3><p> Precio: 50 €</p>
            <img src="./img/raqueta.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="raqueta;50" min="0" >
          </div>
       </div>
       <div class="flex-container">
          <div class=" content">
            <h3>Pantalones</h3><p> Precio: 12 €</p>
            <img src="./img/pantalones.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="pantalones;12" min="0"  >
          </div>
          <div class=" content">
            <h3>Camiseta</h3><p> Precio: 13 €</p>
            <img src="./img/camiseta.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="camiseta;13" min="0"  >
          </div>
          <div class=" content">
            <h3>Calcetines</h3><p> Precio: 8 €</p>
            <img src="./img/calcetines.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="calcetines;8" min="0"  >
          </div>
        </div>
        <div class="flex-container">
          <div class=" content">
            <h3>Gorra</h3><p> Precio: 10 €</p>
            <img src="./img/gorra.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="gorra;10" min="0"  >
          </div>
          <div class=" content">
            <h3>Botella</h3><p> Precio: 6 €</p>
            <img src="./img/botella.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="botella;6" min="0"  >
          </div>
          <div class=" content">
            <h3>PelotasDeTenis</h3><p> Precio: 7 €</p>
            <img src="./img/PelotasDeTenis.jpg" class = "icono"><br><br>
            <p>Cantidad: </p><input type="number" name="PelotasDeTenis;7" min="0"  >
          </div>
        </div>-->
        </div> 
        <div id = "inpusts" class="center">
          <input type="submit" name="carro" value="Añadir al carrito"/>
          <input type="submit" name="empty" value="Vaciar carrito"/>
          <input type="submit" name="cart" value="Ir al carrito"/>
        </div>
      </form>
      <div id = "result">
        <?php
            for ($i=0;$i<count($_SESSION['array']);$i++){
              echo $_SESSION['array'][$i];
              echo "</br>";
            }
        ?>
      </div>
  </body>
</html>