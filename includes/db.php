<?php
    try{

    
    $configs = include('config.php');
    }catch(Exception $e){
        
    }

    $host = strval($configs['host']);
    $database = strval($configs['database']);
    $username = strval($configs['username']);
    $password = strval($configs['password']);

    
    $con = mysqli_connect($host,$username,$password,$database);

    if(!$con)
    {
        die("Not Connected");
    }

?>