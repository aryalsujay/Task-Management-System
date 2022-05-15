<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    class db{
        protected $connection;
        function setconnection(){
            try{
                $this->connection=new PDO("mysql:host=localhost;dbname=tms", "root", "");
            }
            catch(PDOException $e){
                echo "Not connected";
            }
        }
    }

?>
</body>
</html>
