<?php
    session_start();
    echo isset($_SESSION['login']);
    if(isset($_SESSION['login'])) {
      header('LOCATION:product.php'); die();
    }
    Class Usuario{
      private $username;
      private $password;
      function __construct($name,$pass) {
          $this->username = $name;
          $this->password = $pass;
      }
      public function createUser($filename){
        $e=true;
        $s=true;
        $fitxer=fopen($filename,"r") or die ("No s'ha pogut crear el fitxer");
      
      for ($i = 0; $fila = fgets($fitxer); ++$i) {
        $args=explode(";",$fila);
        if ($this->username== $args[0]){
           $e=false;
          break;
           
        } 
        
        
      }
      fclose($fitxer);
        if(strlen($this->password)<8){
          $s=false;
       }
        if(!$e) {
          
          echo "<div class='alert alert-danger'>Username already exists.</div>";
        }
        elseif(!$s) {
          echo "<div class='alert alert-danger'>Password has to be 8 characters minimun.</div>";
        }
        else{
          $fitxer2=fopen($filename,"a") or die ("No s'ha pogut crear el fitxer");
          fwrite($fitxer2,$this->username.";".$this->password.PHP_EOL);
          fclose($fitxer2);
        }
       


     }
    

    
    public function login($filename){
      $e=true;
      $s=false;
      $fitxer=fopen($filename,"r") or die ("No s'ha pogut crear el fitxer");
      
      for ($i = 0; $fila = fgets($fitxer); ++$i) {
        $args=explode(";",$fila);
        if ($this->username== $args[0]){
           $e=false;
          break;
           
        } 
        
        
      }
      if( $this->username== trim($args[0]) && $this->password==trim($args[1])){
        $s=true;
        
      }
      fclose($fitxer);
      if($e) {
        echo "<div class='alert alert-danger'>Username doesn't exist.</div>";
      }
      elseif(!$s) {
        
        echo "<div class='alert alert-danger'>Username and password do not match.</div>";
      }
      else{
        $loginname=explode("@",$this->username);
        $_SESSION['login'] = $loginname[0]; header('LOCATION:product.php'); die();
        
      }

   }
  
  }
  
    
?>
<!DOCTYPE html>
<html>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Login</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   </head>
<body>
  <div class="container">
    <h3 class="text-center">Login</h3>
    <?php
    
    if(isset($_POST['submit'])){
      $us=new Usuario($_POST['username'],$_POST['password']);
      $us->login("register.txt");
    }
    if(isset($_POST['submit2'])){
      $us=new Usuario($_POST['username'],$_POST['password']);
      $us->createUser("register.txt");
    }
    
    
    
    ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="email" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="password" required>
      </div>
      <button type="submit" name="submit" class="btn btn-default">Login</button>
      <button type="submit" name="submit2" class="btn btn-default">Register</button>
    </form>

  </div>

</body>
</html>