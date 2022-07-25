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
    background-color: blanchedalmond;
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
                            <?php $uid=$row['uid']; $tid=$row['tid']; $stid=$row['stid']; $t1=$row['t1']; //$note=$row['note'];?>
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
                                <?php echo $t1; ?>
                            </td>
                            <td>
                                    <?php
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->note($stid);
                                        $set=$obj->note($stid);
                                        foreach($set as $row){
                                        $note=$row['note'];
                                    } ?> <?php
                                        echo "$note |" . "<br>" . "  <textarea rows = '3' cols = '30' maxlength = '200' name = 'note'></textarea>"; 
                                    ?>

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

                    <?php
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
                            <?php $uid=$row['uid']; $tid=$row['tid']; $stid=$row['stid']; $t1=$row['t1']; ?>

                            <td>
                                <?php if($stid % 10==1){
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
                            <td><?php   if($stid % 10==1){
                                            echo $t1;
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
                            <?php $uid=$row['uid']; $tid=$row['tid']; $stid=$row['stid']; $t1=$row['t1']; //$note=$row['note']; ?>
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
                                <?php echo $t1; ?>
                            </td>
                            <td>
                                    <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->note($stid);
                                    $recordset=$obj->note($stid);
                                    foreach($recordset as $row){
                                        $note=$row['note'];
                                    } 
                                    ?>
                                    <?php
                                        echo "$note |" . "<br>" . "  <textarea rows = '3' cols = '30' maxlength = '200' name = 'note'></textarea>"; 
                                    ?>
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
                                <th class='table-header' width='20%'>Task</th>
                                <th class='table-header' width='17%'>No. of Tasks</th>
                                <th class='table-header' width='17%'>Not Assigned</th>
                                <th class='table-header' width='17%'>Need Clarification</th>
                                <th class='table-header' width='17%'>Quality Check</th>
                                <th class='table-header' width='17%'>Completed</th>
                                <th class='table-header' width='17%'>Reassigned Count</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>
                            <tr class='table-row'>
                                <td> ALL TASKS </td>
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
                                    <?php    
                                        $q="SELECT * FROM log WHERE note like 'Reassigned%' ORDER BY stid ASC";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);
                                        ?>
                                    <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?cpid=reassigned"><?php echo $rc;?></button></a></td>";
                                </td>
                            </tr>
                            <?php
                                    $obj=new data();
                                    $obj->setconnection();
                                    $obj->fetchid();
                                    $rec=$obj->fetchid();
                                    foreach($rec as $row){
                                        $tid=$row['id'];
                                        $tname=$row['tname'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $tname;//echo $tid;?>
                                </td>
                                <td>
                                <?php
                                        $q="SELECT * FROM trows where tid='$tid'";
                                        $result = mysqli_query($conn, $q);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $tid=$row[1];
                                        }
                                        $rc = mysqli_num_rows($result);
                                    ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?viewid=admin&tid=<?php echo $tid; ?>"><?php echo $rc;?></button></a></td>";
                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='' AND tid='$tid'";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $tid=$row[1];
                                        }

                                    ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?unid=unassigned&ntid=<?php echo $tid; ?>"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='Need Clarification' AND tid='$tid'";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $tid=$row[1];
                                        }

                                        ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?clid=clarification_needed&cid=<?php echo $tid; ?>"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='Completed' AND tid='$tid'";
                                        $result = mysqli_query($conn, $q);
                                        $rc = mysqli_num_rows($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $tid=$row[1];
                                        }

                                    ?>
                                    <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?rvid=review_needed&qtid=<?php echo $tid; ?>"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM trows WHERE status='Completed!'AND tid='$tid'";
                                        $result = mysqli_query($conn, $q);

                                        $rc = mysqli_num_rows($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $tid=$row[1];
                                        }
                                        ?>
                                        <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?ctid=completed&cctid=<?php echo $tid; ?>"><?php echo $rc;?></button></a></td>";

                                </td>
                                <td>
                                    <?php
                                        $q="SELECT * FROM log WHERE note LIKE 'Reassigned%' AND tid='$tid' ORDER BY stid ASC";
                                        $result = mysqli_query($conn, $q);

                                        $rc = mysqli_num_rows($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $tid=$row[1];
                                        }
                                        ?>
                                    <button type='button' class='btn primary' style='font-family: Arial;padding 10px;'><a href="7admin_service_dashboard.php?cpid=lifecycle&retid=<?php echo $tid; ?>"><?php echo $rc;?></button></a></td>";
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                    </table>
                    <?php

                    ?>
                </div>
            </div>

            <!-- View All Tasks -->
            <div class="rightinnerdiv">
                <div id="trows" class="innerright portion" style="<?php if(!empty($_REQUEST['viewid'])||(!empty($_REQUEST['tid']))){$viewid=$_REQUEST['viewid'];$tid=$_REQUEST['tid'];}else{echo 'display:none';}?>">
                        <button class="greenbtn">All Tasks</button>
                        <?php
                            if(!empty($tid)){
                            $obj= new data;
                            $obj->setconnection();
                            $obj->taskid($tid);
                            $recordset=$obj->taskid($tid);
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
                                ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                        <?php
                        }
                        else{
                        ?>
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
                                ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                        <?php
                        }
                        ?>

                </div>
            </div>

            <!-- Unassigned Tasks -->
            <div class="rightinnerdiv">
                <div id="unassigned" class="innerright portion" style="<?php if(!empty($_REQUEST['unid'])||(!empty($_REQUEST['ntid']))){$viewid=$_REQUEST['unid'];$tid=$_REQUEST['ntid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Unassigned Tasks</button>
                        <?php
                        if(!empty($tid)){
                            $obj= new data;
                            $obj->setconnection();
                            $obj->untaskid($tid);
                            $recordset=$obj->untaskid($tid);
                            if(!empty($recordset)){
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
                                ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                        <?php
                        }
                        else {echo "Nothing to show!";}
                        }

                        else{
                        ?>
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
                                ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                        <?php
                        }
                        ?>


                </div>
            </div>

            <!-- Clarification Needed Tasks -->
            <div class="rightinnerdiv">
                <div id="clarif" class="innerright portion" style="<?php if(!empty($_REQUEST['clid'])||(!empty($_REQUEST['cid']))){$viewid=$_REQUEST['clid'];$tid=$_REQUEST['cid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Need Clarification</button>
                        <?php
                        if(!empty($tid)){
                            $obj= new data;
                            $obj->setconnection();
                            $obj->uclarid($tid);
                            $recordset=$obj->uclarid($tid);

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
                                    $t1=$row['t1'];
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
                                    echo $t1;
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
                        <?php
                        }
                        else{

                        ?>
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
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
                        <?php
                        }
                        ?>

                </div>
            </div>

            <!-- Review Needed Tasks -->
            <div class="rightinnerdiv">
                <div id="review" class="innerright portion" style="<?php if(!empty($_REQUEST['rvid'])||(!empty($_REQUEST['qtid']))){$viewid=$_REQUEST['rvid'];$tid=$_REQUEST['qtid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Need Review</button>
                        <?php
                        if(!empty($tid)){

                            $obj= new data;
                            $obj->setconnection();
                            $obj->rvid($tid);
                            $recordset=$obj->rvid($tid);
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
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
                        <?php
                        }
                        else{
                        ?>
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
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
                        <?php
                    }
                    ?>


                </div>
            </div>

            <!-- Completed Tasks -->
            <div class="rightinnerdiv">
                <div id="complete" class="innerright portion" style="<?php if(!empty($_REQUEST['ctid'])||(!empty($_REQUEST['cctid']))){$viewid=$_REQUEST['ctid'];$tid=$_REQUEST['cctid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Completed Task</button>
                        <?php
                        if(!empty($tid)){
                            $obj= new data;
                            $obj->setconnection();
                            $obj->did($tid);
                            $recordset=$obj->did($tid);

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
                                    $t1=$row['t1'];
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
                                    echo $t1;
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
                        <?php
                        }
                        else{
                        ?>
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
                                    $t1=$row['t1'];
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
                                    echo $t1;
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
                        <?php
                        }
                        ?>


                </div>
            </div>

            <!-- Reassign Tasks (Complete Lifecycle) -->
            <div class="rightinnerdiv">
                <div id="complete" class="innerright portion" style="<?php if(!empty($_REQUEST['cpid'])||(!empty($_REQUEST['retid']))){$viewid=$_REQUEST['cpid'];$tid=$_REQUEST['retid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Complete Lifecycle</button>
                        <?php
                            if(!empty($tid)){

                            $obj= new data;
                            $obj->setconnection();
                            $obj->logid($tid);
                            $recordset=$obj->logid($tid);


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
                                    $uid=$row['uid'];
                                    $note=$row['note'];

                                ?>
                                <td>
                                <?php
                                        echo $tid . "& " . $stid;
                                    ?>
                                    </td>
                                <td><?php
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->staskname($stid);
                                        $tb=$obj->staskname($stid);
                                            foreach($tb as $row){
                                                $tname=$row['tname'];

                                            }
                                            echo $tname;
                                    ?>
                                </td>

                                <td><?php
                                $obj=new data();
                                $obj->setconnection();
                                $obj->staskname($stid);
                                $tc=$obj->staskname($stid);
                                    foreach($tc as $row){
                                           $t=$row['t1'];
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
                                    $td=$obj->userassigned($uid);
                                    foreach($td as $row){
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

                        <?php
                        }else{
                        ?>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->log();
                            $recordset=$obj->log();
                        ?>
                        <table class='tbl-qa'>

                        <thead>
                            <tr>
                                <th class='table-header' width='17%'>TID & STID</th>
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
                                    $tid=$row['tid'];
                                    $uid=$row['uid'];
                                    $note=$row['note'];

                                ?>
                                <td>
                                <?php
                                    echo $tid . "& " . $stid;
                                    ?>
                                    </td>
                                <td><?php
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
                                $obj=new data();
                                $obj->setconnection();
                                $obj->staskname($stid);
                                $recordset=$obj->staskname($stid);
                                    foreach($recordset as $row){
                                        $t=$row['t1'];

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
                        <?php
                        }
                        ?>

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
