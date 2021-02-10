<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 18.03.2020
* Description : File used to create a connection with the db and send query
*/
require 'model/encryption.php';

/**
* Function used to open connexion with an DB.
*/
function openDBConnexion(){
  $tempDbConnexion = null;

  $sqlDriver = 'mysql';
  $hostname = ''; //TODO Field to complete
  $port = 3306;
  $charset = 'utf8';
  $dbName = 'dbName'; //TODO Field to complete
  $userName = 'username'; //TODO Field to complete
  $userPwd = decrypt("mkHndhU83csnUia.Dhjc73jhRzh6UDRNTjJUOQ=="); //TODO Field to complete
  $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

  try{
      $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
  }
  catch (PDOException $exception){
    echo 'Connection failed: ' . $exception->getMessage() . ' ' . $userPwd;
  }
  return $tempDbConnexion;
}

/**
* Function used to execute a query.
* $query = query needed
* return = result of the query
*/
function executeQuery($query){
  $queryResult = null;

  $dbConnexion = openDBConnexion();

  if ($dbConnexion != null){
    $statement = $dbConnexion->prepare($query);
    $statement->execute();
    $queryResult = $statement->fetchAll();
  }

  $dbConnexion = null;
  return $queryResult;
}

/**
* Function used to execute a selet query.
* $query = query needed
* return = result of the query
*/
function executeQuerySelect($query){
  $queryResult = null;

  $dbConnexion = openDBConnexion();
  if ($dbConnexion != null){
    $statement = $dbConnexion->prepare($query);
    $statement->execute();
    $queryResult = $statement->fetchAll();
  }

  $dbConnexion = null;
  return $queryResult;
}

/**
* Function ued to execute a insert query
* $query = query needed
* return = result of the query
*/
function executeQueryInsert($query){
  $queryResult = null;

  $dbConnexion = openDBConnexion();
  if($dbConnexion != null){
    $statement = $dbConnexion->prepare($query);
    $queryResult = $statement->execute();
  }
  $dbConnexion = null;
  return $queryResult;
}
