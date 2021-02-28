<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 18.03.2020
* Description : File used to create a connection with the db and send query
*/

require 'encryption.php';


/**
* Function used to open connexion with an DB.
*/
function openDBConnexion(){
    $tempDbConnexion = null;

    $sqlDriver = 'mysql';
    $hostname = 'gg110.myd.infomaniak.com';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'gg110_cpa';
    $userName = 'gg110_cpa_viewer';
    $userPwd = 'Ah213Ahbc12';

    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try {
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    } catch (PDOException $exception) {
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

    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);
        $statement->execute();
        $queryResult = $statement->fetchAll();
    }

    $dbConnexion = null;
    return $queryResult;
}