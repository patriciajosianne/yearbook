<?php
 function conn_mysql(){

   $servidor = 'br-cdbr-azure-south-a.cloudapp.net';
   $porta = 3306;
   $banco = "yearbookpuc";
   $usuario = "b6a4f0e4762c6f";
   $senha = "03319aeb";
   
      $conn = new PDO("mysql:host=$servidor;
	                   port=$porta;
					   dbname=$banco", 
					   $usuario, 
					   $senha,
					   array(PDO::ATTR_PERSISTENT => true)
					   );
      return $conn;
   }
?>