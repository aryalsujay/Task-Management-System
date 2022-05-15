<?php include "4db.php";

session_start();
    class data extends db{
       //User
       
       //Userlogin for userdashboard
        function userLogin($t1,$t2){

            try{
                $q="SELECT * FROM user where email=? and pass=?";
                
                $recordSet=$this->connection->prepare($q);
                $recordSet->bindParam(1,$t1);
                $recordSet->bindParam(2,$t2);
                $recordSet->execute();
                $row=$recordSet->fetch(PDO::FETCH_ASSOC);
                
                        $logid=$row['id'];
                        $_SESSION["userid"]=$logid;                  
                    header("Location:6user_service_dashboard.php?userlogid=$logid");
                    
                }
                catch (PDOException $e) 
                {
                    header("Location:1index.php?msg=Invalid Credentials");
                }

        }
        //fetch userdetail
        function userdetail($id){
            $q="SELECT * FROM user where id='$id'";
            $data=$this->connection->query($q);
            return $data;
        }

        //Admin

        //Admin login for admin dashboard
        function adminLogin($t1,$t2){
            
            try{
                $q="SELECT * FROM admin where email=:em and pass=:ps";
                
                $recordSet=$this->connection->prepare($q);
                $recordSet->bindParam(':em',$t1);
                $recordSet->bindParam(':ps',$t2);
                $recordSet->execute();
                $row=$recordSet->fetch(PDO::FETCH_ASSOC);

                $logid=$row['id'];
                        $_SESSION["adminid"]=$logid;                  
                    header("Location:7admin_service_dashboard.php");
                    
                }
                catch (PDOException $e) 
                {
                    header("Location:1index.php?msg=Invalid Credentials");
                }
            
        }
        function addperson($name,$email,$pass,$type){
            $this->name=$name;
            $this->email=$email;
            $this->pass=$pass;
            $this->type=$type;
            $q="INSERT INTO user(id, name, email, pass, type)VALUES('', '$name', '$email', '$pass', '$type')";
            if($this->connection->exec($q)){
                header("Location:7admin_service_dashboard.php?msg=New person added");
            }
            else{
                header ("Location:7admin_service_dashboard.php?msg=Registration failed");
            }
        }
        
        function issuereport(){
            $q="SELECT * FROM issuebook ORDER BY id DESC";
            $data=$this->connection->query($q);
            return $data;
        }
    }
    
?>
