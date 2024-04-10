<?php

class Database
{
 /** 
 *Obtendo a conexão com o banco de dados
 * @method
 */
 public function getConnection(){

  try {

    $conn = new PDO("mysql:dbname=bounty;host=localhost","root","");
    return $conn;

  } catch (PDOException $e) {
    echo $e->getMessage();
  }
    
 }

}
