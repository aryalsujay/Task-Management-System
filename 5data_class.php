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
        //View Assigned Tasks
        function assignedtask($uid){
            $q="SELECT * FROM trows where uid='$uid'";
            $data=$this->connection->query($q);
            return $data;
        }

        //Fetch status of task
        function status($stid){
            $q="SELECT * FROM trows where stid='$stid'";
            $data=$this->connection->query($q);
            return $data;
        }
        //Fill status of the task with note if needed
        //Resolved
        function taskstatus($stid,$status,$uid,$note){
            $this->stid=$stid;
            $this->status=$status;
            $this->uid=$uid;
            $this->note=$note;
            $q1="SELECT * FROM trows WHERE stid='$stid'";
            $rec1=$this->connection->query($q1);
            foreach($rec1 as $row){
                $tid=$row['tid'];
            }
            $q="SELECT * FROM trows WHERE stid='$stid'";
            $result=$this->connection->query($q);
            foreach($result as $row){
                $old_note=$row['note'];
            }
            if($status=='Completed'){
                $q2="UPDATE trows SET status='$status',note='$old_note | $note' WHERE stid='$stid'";
                if($this->connection->exec($q2)){
                    $q3="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','$tid','$stid','$uid','$status','0')";
                    $this->connection->exec($q3);
                    header("Location:6user_service_dashboard.php?userlogid=$uid&msg=Sent_for_Review");
                }
                else{
                    header("Location:6user_service_dashboard.php?userlogid=$uid&msg=Failed");
                }
            }
            else{
                $q2="UPDATE trows SET status='$status',note='$old_note | $note' WHERE stid='$stid'";
                if($this->connection->exec($q2)){
                    $q3="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','$tid','$stid','$uid','$status','0')";
                    $this->connection->exec($q3);
                    header("Location:6user_service_dashboard.php?userlogid=$uid&msg=Need_Clarification");
                }
                else{
                    header("Location:6user_service_dashboard.php?userlogid=$uid&msg=Failed");
                }
            }


        }

        //Admin

        //Current User
        function currentuser()
        {
            $q="SELECT CURRENT_USER";
            $data=$this->connection->query($q);
            return $data;
        }
        //Add User
        function adduser($name,$email,$pass,$type){
            $this->name=$name;
            $this->email=$email;
            $this->pass=$pass;
            $this->type=$type;
                $q="INSERT INTO user(id, name, email, pass, type)VALUES('', '$name', '$email', '$pass', '$type')";
                if($this->connection->exec($q)){
                    header("Location:7admin_service_dashboard.php?msg=user added");
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=user_add failed");
                }
        }

        //Admin login for admin dashboard
        function adminLogin($t1,$t2){

            try{
                $q="SELECT * FROM admin where email=:em and pass=:ps";

                $recordSet=$this->connection->prepare($q);
                $recordSet->bindParam(':em',$t1);
                $recordSet->bindParam(':ps',$t2);
                $recordSet->execute();
                $row=$recordSet->fetch(PDO::FETCH_ASSOC);

                        $adlogid=$row['id'];
                        $_SESSION["adminid"]=$adlogid;
                    header("Location:7admin_service_dashboard.php?adminid=$adlogid");

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
                $stid1=$tid . '1';
                $stid2=$tid . '2';
                $stid3=$tid . '3';
            }
            $q4="INSERT INTO tdetail(id,tid, t1, t2, t3)VALUES('','$tid','$t1','$t2','$t3')";
            $q5="INSERT INTO trows(id,tid,stid,uid,status,t1,t2,t3,note)VALUES('','$tid','$stid1','','','$t1','','','')";
            $q6="INSERT INTO trows(id,tid,stid,uid,status,t1,t2,t3,note)VALUES('','$tid','$stid2','','','','$t2','','')";
            $q7="INSERT INTO trows(id,tid,stid,uid,status,t1,t2,t3,note)VALUES('','$tid','$stid3','','','','','$t3','')";
            $this->connection->exec($q5);
            $this->connection->exec($q6);
            $this->connection->exec($q7);
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
        //Fetch Taskname
        function taskname($tid){
            $this->tid=$tid;
            $q="SELECT * FROM task where id='$tid'";
            $data=$this->connection->query($q);
            return $data;
        }
        //Fetch Taskname from subtask ID
        function staskname($stid){
            $this->stid=$stid;
            $q="SELECT * FROM trows INNER JOIN task ON trows.tid=task.id where trows.stid='$stid'" ;
            $data=$this->connection->query($q);
            return $data;
        }
        //View Task as admin
        function viewtask(){
            $q="SELECT * FROM tdetail as td INNER JOIN task AS t ON td.tid=t.id ORDER BY td.id ASC";
            $data=$this->connection->query($q);
            return $data;
        }
        //View sTask as admin
        function viewstask(){
            $q="SELECT * FROM trows ORDER BY id ASC";
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

                $q3="INSERT INTO log(id, tid, stid,uid,note, done)VALUES('','$tid','','$uid','Assigned to $name','')";
                $this->connection->exec($q3);
            }
                $q4="UPDATE tdetail SET uid='$uid', assigned='1' WHERE tid='$tid'";
                if($this->connection->exec($q4)){
                    header("Location:7admin_service_dashboard.php?msg=Assigned");
                }
                else{
                    header ("Location:7admin_service_dashboard.php?msg=Failed");
                }

        }
        //Assign User a sub-task
        function assignstask($name,$stid){
            $this->name=$name;
            $this->stid=$stid;
            //comment stid to check for all tasks assign
            //$this->stid=$stid;
            $q1="SELECT * FROM user WHERE name='$name'";
            $result=$this->connection->query($q1);
            foreach($result as $row){
                $uid=$row['id'];
            }
            $q2="SELECT * FROM trows WHERE stid='$stid'";
            $result1=$this->connection->query($q2);
            foreach($result1 as $row){
                $stid=$row['stid'];
                $tid=$row['tid'];

            }
                //$aid=$row['assigned'];
                $q3="INSERT INTO log(id, tid,stid,uid,note,done)VALUES('','$tid','$stid','$uid','Assigned to $name','')";
                $this->connection->exec($q3);

                $q4="UPDATE trows SET uid='$uid' WHERE tid='$tid' AND stid='$stid'";
                if($this->connection->exec($q4)){
                    header("Location:7admin_service_dashboard.php?msg=Assigned to $name");
                }
                else{
                    header ("Location:7admin_service_dashboard.php?msg=Failed");
                }

        }
        //Retrieve which user is assigned a task
        function userassigned($uid){
            $this->uid=$uid;
            $q="SELECT * FROM user WHERE id='$uid'";
            $data=$this->connection->query($q);
            return $data;
        }
        //Retrieve User needing task clarification
        function userclarify(){
            $q="SELECT * FROM trows WHERE status='Need Clarification'";
            $data=$this->connection->query($q);
            return $data;
        }
        //Retrieve Completed Task by Users
        function reviewtask(){
            $q="SELECT * FROM trows WHERE status='Completed'";
            $data=$this->connection->query($q);
            return $data;
        }
        function completed(){
            $q="SELECT * FROM trows WHERE status='Completed!'";
            $data=$this->connection->query($q);
            return $data;
        }
        //Reassign Task + send solution
        function reassign($stid,$user,$note,$uid){
            $this->stid=$stid;
            $this->user=$user;
            $this->note=$note;
            $this->uid=$uid;
            $q="SELECT * FROM trows WHERE stid='$stid'";
            $result=$this->connection->query($q);
            foreach($result as $row){
                $old_note=$row['note'];
            }
            if($user!='Select'){
                $q1="SELECT * FROM user WHERE name='$user'";
                $rec=$this->connection->query($q1);
                foreach($rec as $row){
                    $uid=$row['id'];
                }
                $q2="UPDATE trows SET note='$old_note |Lead: $note',uid='$uid' WHERE stid='$stid'";
                if($this->connection->exec($q2)){
                    $q3="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','','$stid','$uid','Reassigned to $user - Admin','')";
                    $this->connection->exec($q3);
                    header("Location:7admin_service_dashboard.php?msg=Changed_to_$user");
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=Reassigned_failed");
                }
            }
            else{
                $q1="SELECT * FROM user WHERE uid='$uid'";
                    $rec=$this->connection->query($q1);
                    foreach($rec as $row){
                    $uname=$row['name'];
                }

                $q4="UPDATE trows SET note='$old_note |Lead: $note' WHERE stid='$stid'";
                if($this->connection->exec($q4)){

                    $q5="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','','$stid','$uid','Reassigned to $uname','')";
                    $this->connection->exec($q5);
                    header("Location:7admin_service_dashboard.php?msg=Reassigned to $uname");
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=Reassigned_failed");
                }
            }

        }
        //Reassign Task + send solution by manager
        function reassignmanager($stid,$user,$note){
            $this->stid=$stid;
            $this->user=$user;
            $this->note=$note;
            $q="SELECT * FROM trows WHERE stid='$stid'";
            $result=$this->connection->query($q);
            foreach($result as $row){
                $old_note=$row['note'];
            }
            if($user!='Select'){
                $q1="SELECT * FROM user WHERE name='$user'";
                $rec=$this->connection->query($q1);
                foreach($rec as $row){
                    $uid=$row['id'];
                }
                $q2="UPDATE trows SET note='$old_note |Manager: $note',uid='$uid' WHERE stid='$stid'";
                if($this->connection->exec($q2)){
                    $q3="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','','$stid','$uid','Reassigned to $user - Manger','')";
                    $this->connection->exec($q3);
                    header("Location:7admin_service_dashboard.php?msg=Changed_to_$user");
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=Reassigned_failed");
                }
            }
            else{
                $q4="UPDATE trows SET note='$old_note |Manager: $note' WHERE stid='$stid'";
                if($this->connection->exec($q4)){
                    $q5="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','','$stid','','Reassigned_to_$user','')";
                    $this->connection->exec($q5);
                    header("Location:7admin_service_dashboard.php?msg=Reassigned_to_$user");
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=Reassigned_failed");
                }
            }

        }
        //Quality Check
        function qualitycheck($stid,$user,$note,$uid){
            $this->stid=$stid;
            $this->user=$user;
            $this->note=$note;
            $this->uid=$uid;
            $q="SELECT * FROM trows WHERE stid='$stid'";
            $result=$this->connection->query($q);
            foreach($result as $row){
                $old_note=$row['note'];
                $old_status=$row['status'];
            }
                $q2="UPDATE trows SET note='$old_note | $note',uid='$uid',status='$old_status!' WHERE stid='$stid'";
                if($this->connection->exec($q2)){
                    $q3="INSERT INTO log(id, tid, stid, uid, note, done)VALUES('','','$stid','$uid','$old_status!','1')";
                    $this->connection->exec($q3);
                    header("Location:7admin_service_dashboard.php?msg=Task_Completed");
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=Failed");
                }

        }
        //Unassigned Tasks
        function unassignedtask(){
            $q="SELECT * FROM trows WHERE status=''";
            $data=$this->connection->query($q);
            return $data;
        }
        //Reassigned
        function log(){
            $q="SELECT * FROM log where note like '%assigned%' ORDER BY stid ASC";
            $data=$this->connection->query($q);
            return $data;
        }

    }

?>
