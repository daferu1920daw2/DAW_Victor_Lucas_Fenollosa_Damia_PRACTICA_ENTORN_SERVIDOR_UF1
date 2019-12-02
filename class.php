<?php
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