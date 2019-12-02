<?php
$estudiantes=array
(
"1" =>array
   (
   "nombre"=>"Andres",
   "carrera"=>"Sistemas",
   "edad"=>"22"
   ),
"2" =>array
   (
   "nombre"=>"Camilo",
   "carrera"=>"Comunicaciones",
   "edad"=>"24"
   )
);

foreach($estudiantes as $preid){
    $preid['name'] = "hola";
    foreach($preid as $indice => $ide){
    echo $ide . "<br>";
    }
    }
?>