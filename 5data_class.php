<?php include "4db.php";

session_start();
    class data extends db{
        private $tname;
        private $tdetail;
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
        //Add task and taskdetail in task table
        //then split sub-tasks acc. to delimiter and store in different table
        function addtask($tname,$tdetail){
            $this->tname=$tname;
            $this->tdetail=$tdetail;
            $q="INSERT INTO task(id, tname, detail)VALUES('', '$tname', '$tdetail')";
            $this->connection->exec($q);
            /* $q1="SELECT * FROM task";
            $recordSet=$this->connection->query($q1);
            foreach($recordSet as $row){
                $tid=$row['id'];
                $t1=$row['detail'];
                //t2,t3 .. to add after delimiter
            }
            $q2="INSERT INTO tdetail(id, tid, t1, t2, t3)VALUES('', '$tid','$t1','','')"; */
            /*$q3="Select id,name,detail, left(detail,charindex(',',detail)-1)as t1,
            right(detail, len(detail)-charindex(',',detail)-2) as t3
            from task";*/
            //$q3="SELECT id, tname, detail, SUBSTRING_INDEX(detail, ',', 1) as t1,SUBSTRING_INDEX(SUBSTRING_INDEX(detail, ',', 2), ',', -1) as t2,SUBSTRING_INDEX(SUBSTRING_INDEX(detail, ',', 3), ',', -1) as t3 from task";
            $q3="SELECT id, tname, detail, SUBSTRING_INDEX(detail, '\n', 1) as t1,SUBSTRING_INDEX(SUBSTRING_INDEX(detail, '\n', 2), '\n', -1) as t2,SUBSTRING_INDEX(SUBSTRING_INDEX(detail, '\n', 3), '\n', -1) as t3 from task";
            /*$q3="SELECT id, detail, SPLIT_STR(detail, ' ', 1) as t1, SPLIT_STR(detail, ' ', 2) as t2 SPLIT_STR(detail, ' ', 3) as t3 FROM task";
            $q1="CREATE FUNCTION SPLIT_STR(
                x VARCHAR(255),
                delim VARCHAR(12),
                pos INT
              )
              RETURNS VARCHAR(255) DETERMINISTIC
              BEGIN
                  RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
                     LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
                     delim, '\n');
              END";
            $recordSet=$this->connection->query($q1); */
            $recordset=$this->connection->query($q3);
            foreach($recordset as $rows){
                $tid=$rows['id'];
                $t1=$rows['t1'];
                $t2=$rows['t2'];
                $t3=$rows['t3'];
            }
            $q4="INSERT INTO tdetail(id,tid, t1, t2, t3)VALUES('','$tid','$t1','$t2','$t3')";
            if($this->connection->exec($q4)){
                header("Location:7admin_service_dashboard.php?msg=New task added");
            }
            else{
                header("Location:7admin_service_dashboard.php?msg=Error");
            }
        }
        //Add person Admin
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
        //View Task as admin
        function viewtask(){
            $q="SELECT * FROM tdetail as td INNER JOIN task AS t ON td.tid=t.id ORDER BY td.id ASC";
            $data=$this->connection->query($q);
            return $data;
        }
        //Retrieve User
        function studentrecord(){
            $q="SELECT * FROM user";
            $data=$this->connection->query($q);
            return $data;
        }
        //Assign User a task
        function assigntask($name,$tid){
            $this->name=$name;
            $this->tid=$tid;
            $q1="SELECT * FROM user WHERE name='$name'";
            $result=$this->connection->query($q1);
            foreach($result as $row){
                $uid=$row['id'];
            }
            $q2="SELECT * FROM tdetail WHERE tid='$tid'";
            $result1=$this->connection->query($q2);
            foreach($result1 as $row){
                $tid=$row['tid'];
            }
            $q3="INSERT INTO log(id, tid, uid)VALUES('','$tid','$uid')";
            $this->connection->exec($q3);
            $q4="UPDATE tdetail SET uid='$uid' WHERE tid='$tid'";
            if($this->connection->exec($q4)){
                header("Location:7admin_service_dashboard.php?msg=Assigned");
            }
            else{
                header ("Location:7admin_service_dashboard.php?msg=Failed");
            }
        }
        //Check if user is assigned task or not
        function isassigned($tid){
            $this->tid=$tid;
            $q="SELECT * FROM tdetail WHERE tid='$tid'";
            $data=$this->connection->query($q);
            return $data;
        }
    }

?>
