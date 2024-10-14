<?php


$dns='mysql:host=localhost;dbname=shopdb';
$user='root';
$pass='';
$option=array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
);
try{
$con=new PDO($dns,$user,$pass,$option);
echo "connect";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>