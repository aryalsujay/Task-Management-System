<?php include "5data_class.php";
//$adminid=$_GET['adminid'];
define("ROW_PER_PAGE",2);
    if(empty($_SESSION['adminid'])){
        header("Location:1index.php?msg=Invalid");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="!style.css">
    <!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Document</title>
</head>
<style>
.container{
    text-align: center;
}
.row,
.imglogo{
    margin-left: 70px;
    text-align: center;
}

.innerdiv{

    text-align: center;
    margin: 100px;
}
.leftinnerdiv{
    float: left;
    width: 20%;
}
.rightinnerdiv{
    float: right;
    width: 80%;
}
.greenbtn{
    background-color: greenyellow;
    border-radius: 1rem;
    padding: 0.5%;
    width: 95%;
    height: 40px;
    font-size: medium;
    box-shadow: rgb(16,170,16);
    margin:3px;
    cursor: pointer;
}
* {
  box-sizing: border-box;
}

/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: center;
  width: 80%;
  text-align: center;
  background: #f1f1f1;
  margin-bottom: 200px;
}

/* Style the submit button */
form.example button {
  float: center;
  width: 10%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}
th{
    background-color: orange;
    color: black;
    }
    td{
    background-color: #fed8b1;
    color: black;
    }
    td, a{
    color:black;
    }
    a{
        text-align: center;
        text-decoration: none;
    }

.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: center;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;vertical-align:top;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
#keyword{border: #CCC 1px solid; border-radius: 4px; padding: 7px;background:url("demo-search-icon.png") no-repeat center right 7px;}
.btn-page{margin-right:10px;padding:5px 10px; border: #CCC 1px solid; background:#FFF; border-radius:4px;cursor:pointer;}
.btn-page:hover{background:#F0F0F0;}
.btn-page.current{background:#0096FF;}
.btn-page.woof{background: #B6D0E2;}
.btn-page.yo{background: #6495ED;}
</style>
<body>

    <div class="container">
        <div class="innerdiv">
            <div class="row"><a href="7admin_service_dashboard.php"><img class="imglogo" src="images/tm.png"></a></div>
            <div class="leftinnerdiv">
                <button class="greenbtn">Welcome</button>
                <!-- <button class="greenbtn" onclick="openpart('myaccount')">My Account</button> -->
                <Button class="greenbtn" onclick="openpart('addtask')">Add task</Button>
                <Button class="greenbtn" onclick="openpart('assignstask')">Assign Sub-Task</Button>
                <Button class="greenbtn" onclick="openpart('addusr')">Add User</Button>
                <Button class="greenbtn" onclick="openpart('clarification')">Clarification</Button>
                <Button class="greenbtn" onclick="openpart('manager')">Quality Check</Button>
                <Button class="greenbtn" onclick="openpart('report')">Report</Button>
                <a href="1index.php"><Button class="greenbtn">Logout</Button></a>
            </div>

            <!-- Add Task and sub-tasks at once-->
            <div class="rightinnerdiv">
                <div id="addtask" class="innerright portion" style="display:none">
                <Button class="greenbtn">Add Task</Button>
                    <form action="8addtask.php" method="post" enctype="multipart/form-data">

                        <label>Task Name: </label><input type="text" name="tname"/>
                        <br>
                        <label>Task Detail: </label>
                        <textarea rows = "7" cols = "40" maxlength = "200" name = "tdetail"></textarea><br>
                        <input type="submit" class="btn-primary" value="Add Task"/>
                        <br>
                        <br>
                    </form>
                </div>
            </div>

            <!-- Add User-->
            <div class="rightinnerdiv">
                <div id="addusr" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Add User</Button>
                    <form action="10adduser.php" method="post" enctype="multipart/form-data">
                    <div id="ifYes" style="display: none;">
                        <select name="adminid">
                            <?php echo "<option value='" . $adminid . "'>" . $adminid . "</option>"; ?>
                        </select>
                    </div>
                        <label>Name: </label><input type="text"  name="addname"/>
                        <br>
                        <label>Email: </label><input type="email"  name="addemail"/>
                        <br>
                        <label>Password: </label><input type="password"  name="addpass"/>
                        <br>
                        <label>Type: </label>
                        <select name="type" >
                            <option id="Member">Member</option>
                            <option id="Admin">Admin</option>
                            <option id="Manager">Manager</option>
                        </select>
                        <br>
                        <input type="submit" class="btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>

            <!-- Clarification-->
            <div class="rightinnerdiv">
                <div id="clarification" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Clarification</Button>
                    <?php
                            $u= new data;
                            $u->setconnection();
                            $u->userclarify();
                            $result=$u->userclarify();
                    ?>
                    <table class='tbl-qa'>
                        <thead>
                            <tr>
                                <th class='table-header' width='2%'></th>
                                <th class='table-header' width='12%'>Task</th>
                                <th class='table-header' width='20%'>Sub-Task</th>
                                <th class='table-header' width='15%'>Need Clarification</th>
                                <th class='table-header' width='10%'>Current User</th>
                                <th class='table-header' width='10%'>Change User?</th>
                                <th class='table-header' width='8%'>Reassign</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                        <?php
                            if(!empty($result)) {
                            foreach($result as $row) {
                        ?>
                        <form action="12clarifytask.php" method="post" enctype="multipart/form-data">
                        <tr class='table-row'>
                            <td><div id="ifYes" style="display: none;">
                                <select name="stid">
                                    <?php echo "<option value='" . $row['stid'] . "'>" . $row['stid'] . "</option>"; ?>
                                </select>
                                <select name="tid">
                                    <?php echo "<option value='" . $row['tid'] . "'>" . $row['tid'] . "</option>"; ?>
                                </select>
                                <select name="uid">
                                    <?php echo "<option value='" . $row['uid'] . "'>" . $row['uid'] . "</option>"; ?>
                                </select>
                                </div>
                            </td>
                            <?php $uid=$row['uid']; $tid=$row['tid']; $stid=$row['stid'];$note=$row['note'];
                            if(empty($row['t1'])){
                                if(!empty($row['t2'])){
                                    $t2=$row['t2'];
                                }
                                else{
                                    $t3=$row['t3'];
                                }
                            }
                            else{
                                $t1=$row['t1'];
                            }
                            ?>
                            <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                                ?>
                            </td>
                            <td>
                                <?php if($stid % 10 ==1){
                                    echo $t1;
                                    }elseif($stid % 10 ==2){
                                    echo $t2;
                                    }else{
                                    echo $t3;
                                    }
                                ?>
                            </td>
                            <td>
                                    <?php echo "$note" . "  <textarea rows = '3' cols = '30' maxlength = '200' name = 'note'></textarea>"; ?>

                            </td>
                            <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        echo $row['name'];
                                    }
                                ?>
                            </td>
                            <td>
                                <select name="name">
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->studentrecord();
                                    $recordset=$obj->studentrecord();
                                        echo "<option>Select</option>";
                                    foreach($recordset as $row){
                                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                            <td><button class='btn primary' value='submit'>REASSIGN</button></td>
                        </tr>
                    </form>

                    <?php
                        }
                    }
                    ?>
                    </table>

                </div>
            </div>

             <!-- Assign Sub-Task template -->
             <div class="rightinnerdiv">
                <div id="assignstask" class="innerright portion" style="display:none">
                    <button class="greenbtn">Assign Sub-Task</button>

                    <?php //Resolved
                            $u= new data;
                            $u->setconnection();
                            $u->viewstask();
                            $result=$u->viewstask();
                    ?>
                    <table class='tbl-qa'>
                        <thead>
                            <tr>
                                <th class='table-header' width='5%'></th>
                                <th class='table-header' width='15%'>Task</th>
                                <th class='table-header' width='25%'>Sub-Tasks</th>
                                <th class='table-header' width='10%'>User</th>
                                <th class='table-header' width='10%'>Status</th>
                                <th class='table-header' width='15%'>Assign To</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                        <?php
                            if(!empty($result)) {
                            foreach($result as $row) {
                        ?>
                        <form action="9userviewtask.php" method="post" enctype="multipart/form-data">
                        <tr class='table-row'>
                            <td> <input type="checkbox"/>
                            <div id="ifYes" style="display: none;">
                                <select name="stid">
                                    <?php echo "<option value='" . $row['stid'] . "'>" . $row['stid'] . "</option>"; ?>
                                </select>
                            </div>
                            </td>
                            <?php $uid=$row['uid']; $tid=$row['tid']; $stid=$row['stid'];?>

                            <?php
                            if(empty($row['t1'])){
                                if(!empty($row['t2'])){
                                    $t2=$row['t2'];
                                }
                                else{
                                    $t3=$row['t3'];
                                }
                            }
                            else{
                                $t1=$row['t1'];
                            }
                            ?>

                            <td>
                                <?php if(!empty($row['t1'])){
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                                    }
                                ?>
                            </td>
                            <td><?php if(empty($row['t1'])){
                                      if(!empty($row['t2'])){
                                        echo $row['t2'];
                                       }
                                       else{
                                        if($stid % 10==1){
                                            echo $t1;
                                        }
                                        else{
                                            echo $row['t3'];
                                        }}
                                       }
                                       else{
                                        echo $row['t1'];
                                       }
                                ?>
                            </td>
                            <td>
                                <select name="name">
                                    <?php
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->studentrecord();
                                        $recordset=$obj->studentrecord();
                                        echo "<option>Select</option>";
                                        foreach($recordset as $row){
                                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        $uname=$row['name'];
                                    }
                                    if($uid!='0'){
                                        echo "Assigned To " . "$uname";
                                    }
                                    else{
                                        echo "Not Assigned";
                                    }
                                ?>
                            </td>
                            <td><button class='btn-primary' value='submit'>ASSIGN</button></td>
                        </tr>

                        </form>

                        <?php
                            }
                        }
                        ?>
                        </table>
                </div>
            </div>

            <!-- Quality Check by Manager Template -->
            <div class="rightinnerdiv">
                <div id="manager" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Quality Check</Button>
                    <?php
                            $u= new data;
                            $u->setconnection();
                            $u->reviewtask();
                            $result=$u->reviewtask();
                    ?>
                    <table class='tbl-qa'>
                        <thead>
                            <tr>
                                <th class='table-header' width='2%'></th>
                                <th class='table-header' width='12%'>Task</th>
                                <th class='table-header' width='20%'>Sub-Task</th>
                                <th class='table-header' width='15%'>Completed Tasks</th>
                                <th class='table-header' width='10%'>Current User</th>
                                <th class='table-header' width='10%'>Change User?</th>
                                <th class='table-header' width='8%'>Reassign/Complete</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                        <?php
                            if(!empty($result)) {
                            foreach($result as $row) {
                        ?>
                        <form action="13qualitycheck.php" method="post" enctype="multipart/form-data">
                        <tr class='table-row'>
                            <td><div id="ifYes" style="display: none;">
                                <select name="stid">
                                    <?php echo "<option value='" . $row['stid'] . "'>" . $row['stid'] . "</option>"; ?>
                                </select>
                                <select name="tid">
                                    <?php echo "<option value='" . $row['tid'] . "'>" . $row['tid'] . "</option>"; ?>
                                </select>
                                <select name="uid">
                                    <?php echo "<option value='" . $row['uid'] . "'>" . $row['uid'] . "</option>"; ?>
                                </select>
                                </div>
                            </td>
                            <?php $uid=$row['uid']; $tid=$row['tid']; $stid=$row['stid'];$note=$row['note'];
                            if(empty($row['t1'])){
                                if(!empty($row['t2'])){
                                    $t2=$row['t2'];
                                }
                                else{
                                    $t3=$row['t3'];
                                }
                            }
                            else{
                                $t1=$row['t1'];
                            }
                            ?>
                            <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                                ?>
                            </td>
                            <td>
                                <?php if($stid % 10 ==1){
                                    echo $t1;
                                    }elseif($stid % 10 ==2){
                                    echo $t2;
                                    }else{
                                    echo $t3;
                                    }
                                ?>
                            </td>
                            <td>
                                    <?php echo "$note" . "  <textarea rows = '3' cols = '30' maxlength = '200' name = 'note'></textarea>"; ?>
                            </td>
                            <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        echo $row['name'];
                                    }
                                ?>
                            </td>
                            <td>
                                <select name="name">
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->studentrecord();
                                    $recordset=$obj->studentrecord();
                                        echo "<option>Select</option>";
                                    foreach($recordset as $row){
                                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="next">
                                    <option id="Select">Select</option>
                                    <option id="Reassign">Reassign</option>
                                    <option id="Complete">Complete</option>
                                </select>
                                <button class='btn primary' value='submit'>Submit</button>
                            </td>
                        </tr>
                    </form>

                    <?php
                        }
                    }
                    ?>
                    </table>
                </div>
            </div>

            <!-- Detailed Report-->
            <div class="rightinnerdiv">
                <div id="report" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Report</Button>
                    <table class='tbl-qa'>
                        <?php require_once "4.1db.php"; ?>
                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Tasks</th>
                                <th class='table-header' width='17%'>Not Assigned</th>
                                <th class='table-header' width='17%'>Clarification</th>
                                <th class='table-header' width='17%'>Quality Check</th>
                                <th class='table-header' width='17%'>Completed</th>
                                <th class='table-header' width='17%'>Reassign</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <tr class='table-row'>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);
                                    ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?viewid=admin"><?php echo $rc;?></button></a></td>";
                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status=''";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);

                                    ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?unid=unassigned"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='Need Clarification'";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);

                                        ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?clid=clarification_needed"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='Completed'";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);

                                    ?>
                                    <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?rvid=review_needed"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='Completed!'";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);
                                        ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?ctid=completed"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>

                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?cpid=lifecycle"><?php echo "ALL";?></button></a></td>";

                                </td>
                            </tr>
                    </table>
                    <?php

                    ?>
                </div>
            </div>

            <!-- View All Tasks -->
            <div class="rightinnerdiv">
                <div id="trows" class="innerright portion" style="<?php if(!empty($_REQUEST['viewid'])){$viewid=$_REQUEST['viewid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">All Tasks</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->viewstask();
                            $recordset=$obj->viewstask();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Task ID</th>
                                <th class='table-header' width='17%'>Task Name</th>
                                <th class='table-header' width='17%'>Sub-Task</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <?php
                            foreach($recordset as $row){
                            ?>
                            <tr class='table-row'>
                                <?php
                                    $stid=$row['stid'];
                                    $tid=$row['tid'];
                                    if(empty($row['t1'])){
                                    if(!empty($row['t2'])){
                                        $t2=$row['t2'];
                                    }
                                    else{
                                        $t3=$row['t3'];
                                    }
                                    }
                                    else{
                                    $t1=$row['t1'];
                                    }
                                ?>
                                <td><?php echo $tid;?></td>
                                <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                               ?>
                                </td>
                                <td><?php
                                if($stid % 10==1){
                                    echo $t1;
                                }
                                elseif($stid % 10==2){

                                    echo $t2;
                                }
                                else{
                                    echo $t3;
                                }

                                ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>


                </div>
            </div>

            <!-- Unassigned Tasks -->
            <div class="rightinnerdiv">
                <div id="unassigned" class="innerright portion" style="<?php if(!empty($_REQUEST['unid'])){$viewid=$_REQUEST['unid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Unassigned Tasks</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->unassignedtask();
                            $recordset=$obj->unassignedtask();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Task ID</th>
                                <th class='table-header' width='17%'>Task Name</th>
                                <th class='table-header' width='17%'>Sub-Task</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <?php
                            foreach($recordset as $row){
                            ?>
                            <tr class='table-row'>
                                <?php
                                    $stid=$row['stid'];
                                    $tid=$row['tid'];
                                    if(empty($row['t1'])){
                                    if(!empty($row['t2'])){
                                        $t2=$row['t2'];
                                    }
                                    else{
                                        $t3=$row['t3'];
                                    }
                                    }
                                    else{
                                    $t1=$row['t1'];
                                    }
                                ?>
                                <td><?php echo $tid;?></td>
                                <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                               ?>
                                </td>
                                <td><?php
                                if($stid % 10==1){
                                    echo $t1;
                                }
                                elseif($stid % 10==2){

                                    echo $t2;
                                }
                                else{
                                    echo $t3;
                                }

                                ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>


                </div>
            </div>

            <!-- Clarification Needed Tasks -->
            <div class="rightinnerdiv">
                <div id="clarif" class="innerright portion" style="<?php if(!empty($_REQUEST['clid'])){$viewid=$_REQUEST['clid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Need Calrification</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->userclarify();
                            $recordset=$obj->userclarify();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Task ID</th>
                                <th class='table-header' width='17%'>Task Name</th>
                                <th class='table-header' width='17%'>Sub-Task</th>
                                <th class='table-header' width='17%'>User Assigned</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <?php
                            foreach($recordset as $row){
                            ?>
                            <tr class='table-row'>
                                <?php
                                    $stid=$row['stid'];
                                    $tid=$row['tid'];
                                    $uid=$row['uid'];
                                    if(empty($row['t1'])){
                                    if(!empty($row['t2'])){
                                        $t2=$row['t2'];
                                    }
                                    else{
                                        $t3=$row['t3'];
                                    }
                                    }
                                    else{
                                    $t1=$row['t1'];
                                    }
                                ?>
                                <td><?php echo $tid;?></td>
                                <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                               ?>
                                </td>
                                <td><?php
                                if($stid % 10==1){
                                    echo $t1;
                                }
                                elseif($stid % 10==2){

                                    echo $t2;
                                }
                                else{
                                    echo $t3;
                                }

                                ?>
                                </td>
                                <td>
                                    <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        $uname=$row['name'];
                                    }
                                    echo $uname;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>


                </div>
            </div>

            <!-- Review Needed Tasks -->
            <div class="rightinnerdiv">
                <div id="review" class="innerright portion" style="<?php if(!empty($_REQUEST['rvid'])){$viewid=$_REQUEST['rvid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Need Review</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->reviewtask();
                            $recordset=$obj->reviewtask();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Task ID</th>
                                <th class='table-header' width='17%'>Task Name</th>
                                <th class='table-header' width='17%'>Sub-Task</th>
                                <th class='table-header' width='17%'>User Assigned</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <?php
                            foreach($recordset as $row){
                            ?>
                            <tr class='table-row'>
                                <?php
                                    $stid=$row['stid'];
                                    $tid=$row['tid'];
                                    $uid=$row['uid'];
                                    if(empty($row['t1'])){
                                    if(!empty($row['t2'])){
                                        $t2=$row['t2'];
                                    }
                                    else{
                                        $t3=$row['t3'];
                                    }
                                    }
                                    else{
                                    $t1=$row['t1'];
                                    }
                                ?>
                                <td><?php echo $tid;?></td>
                                <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                               ?>
                                </td>
                                <td><?php
                                if($stid % 10==1){
                                    echo $t1;
                                }
                                elseif($stid % 10==2){

                                    echo $t2;
                                }
                                else{
                                    echo $t3;
                                }

                                ?>
                                </td>
                                <td>
                                    <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        $uname=$row['name'];
                                    }
                                    echo $uname;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>


                </div>
            </div>

            <!-- Review Needed Tasks -->
            <div class="rightinnerdiv">
                <div id="complete" class="innerright portion" style="<?php if(!empty($_REQUEST['ctid'])){$viewid=$_REQUEST['ctid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Completed Task</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->completed();
                            $recordset=$obj->completed();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Task ID</th>
                                <th class='table-header' width='17%'>Task Name</th>
                                <th class='table-header' width='17%'>Sub-Task</th>
                                <th class='table-header' width='17%'>User Completed</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <?php
                            foreach($recordset as $row){
                            ?>
                            <tr class='table-row'>
                                <?php
                                    $stid=$row['stid'];
                                    $tid=$row['tid'];
                                    $uid=$row['uid'];
                                    if(empty($row['t1'])){
                                    if(!empty($row['t2'])){
                                        $t2=$row['t2'];
                                    }
                                    else{
                                        $t3=$row['t3'];
                                    }
                                    }
                                    else{
                                    $t1=$row['t1'];
                                    }
                                ?>
                                <td><?php echo $tid;?></td>
                                <td>
                                <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->taskname($tid);
                                    $recordset=$obj->taskname($tid);
                                        foreach($recordset as $row){
                                            $tname=$row['tname'];
                                        }
                                        echo $tname;
                               ?>
                                </td>
                                <td><?php
                                if($stid % 10==1){
                                    echo $t1;
                                }
                                elseif($stid % 10==2){

                                    echo $t2;
                                }
                                else{
                                    echo $t3;
                                }

                                ?>
                                </td>
                                <td>
                                    <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        $uname=$row['name'];
                                    }
                                    echo $uname;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>


                </div>
            </div>

            <!-- Reassign Tasks (Complete Lifecycle) -->
            <div class="rightinnerdiv">
                <div id="complete" class="innerright portion" style="<?php if(!empty($_REQUEST['cpid'])){$viewid=$_REQUEST['cpid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Complete Lifecycle</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->log();
                            $recordset=$obj->log();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>Task ID</th>
                                <th class='table-header' width='17%'>Task Name</th>
                                <th class='table-header' width='17%'>Sub-Task</th>
                                <th class='table-header' width='17%'>Status</th>
                                <th class='table-header' width='17%'>User Completed</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <?php
                            foreach($recordset as $row){
                            ?>
                            <tr class='table-row'>
                                <?php
                                    $stid=$row['stid'];
                                    //$tid=$row['tid'];
                                    $uid=$row['uid'];
                                    $note=$row['note'];

                                ?>
                                <td>
                                <?php
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->staskname($stid);
                                        $recordset=$obj->staskname($stid);
                                            foreach($recordset as $row){
                                                $tid=$row['tid'];

                                            }
                                            echo $tid . "& " . $stid;
                                    ?>
                                    </td>
                                <td><?php
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->staskname($stid);
                                        $recordset=$obj->staskname($stid);
                                            foreach($recordset as $row){
                                                $tname=$row['tname'];

                                            }
                                            echo $tname;
                                    ?>
                                </td>

                                <td><?php
                                $obj=new data();
                                $obj->setconnection();
                                $obj->staskname($stid);
                                $recordset=$obj->staskname($stid);
                                    foreach($recordset as $row){
                                        if($stid % 10==1){
                                           $t=$row['t1'];
                                        }
                                        elseif($stid % 10==2){

                                            $t= $row['t2'];
                                        }
                                        else{
                                            $t= $row['t3'];
                                        }

                                    }
                                    echo $t;


                                ?>
                                </td>
                                <td>
                                <?php
                                    echo $note;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->userassigned($uid);
                                    $record=$obj->userassigned($uid);
                                    foreach($record as $row){
                                        $uname=$row['name'];
                                    }
                                    echo $uname;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>


                </div>
            </div>

        </div>
    </div>

    <script>
        function openpart(portion){
            var i;
            var x=document.getElementsByClassName("portion");
            for(i=0;i<x.length;i++){
                x[i].style.display="none";
            }
            document.getElementById(portion).style.display="block";
        }
        function yesnoCheck(that){
            if (that.value == "Need Clarification") {
                alert("check");
                document.getElementById("ifYes").style.display = "block";
            }else{
                document.getElementById("ifYes").style.display = "none";
            }
        }
    </script>

</body>
</html>
