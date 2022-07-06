<?php include "5data_class.php";
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
    width: 25%;
}
.rightinnerdiv{
    float: right;
    width: 75%;
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
                <Button class="greenbtn" onclick="openpart('search')">Search</Button>
                <Button class="greenbtn" onclick="openpart('addtask')">Add task</Button>
                <Button class="greenbtn" onclick="openpart('viewtask')">View Task</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')">Book Request</Button>
                <Button class="greenbtn" onclick="openpart('addperson')">Add Student</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')">Student Record</Button>
                <Button class="greenbtn" onclick="openpart('issuebook')">Issue Book</Button>
                <Button class="greenbtn" onclick="openpart('issuebookreport')">Issue Book Report</Button>
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
                <div id="addperson" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Add Person</Button>
                    <form action="8addperson_server_page.php" method="post" enctype="multipart/form-data">
                        <label>Name: </label><input type="text"  name="addname"/>
                        <br>
                        <label>Email: </label><input type="email"  name="addemail"/>
                        <br>
                        <label>Password: </label><input type="password"  name="addpass"/>
                        <br>
                        <label for="type">Type: </label>
                        <select name="type" >
                            <option id="Student">Student</option>
                            <option id="Teacher">Teacher</option>
                        </select>
                        <br>
                        <input type="submit" class="btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>

            <!-- View Task template -->
            <div class="rightinnerdiv">
                <div id="viewtask" class="innerright portion" style="<?php if(!empty($_REQUEST['msg'])){$msg=$_REQUEST['msg'];}else{echo "display:none";}?>">
                    <button class="greenbtn">Assign Task</button>
                    <form action="9userviewtask.php" method="post" enctype="multipart/form-data">
                    <?php
                        $u= new data;
                        $u->setconnection();
                        $u->viewtask();
                        $result=$u->viewtask();
                    ?>
                        <table class='tbl-qa'>
                        <thead>
                            <tr>
                                <th class='table-header' width='5%'>S.No.</th>
                                <th class='table-header' width='15%'>Task</th>
                                <th class='table-header' width='25%'>Sub-Task 1</th>
                                <th class='table-header' width='25%'>Sub-Task 2</th>
                                <th class='table-header' width='25%'>Sub-Task 3</th>
                                <th class='table-header' width='10%'>User</th>
                                <th class='table-header' width='10%'>Assign To</th>
                                <th class='table-header' width='10%'>Assigned?</th>

                            </tr>
                        </thead>
                        <tbody id='table-body'>
                        <?php
                        if(!empty($result)) {
                            foreach($result as $row) {
                        ?>
                        <tr class='table-row'>
                            <td><select name="id">
                                    <?php echo "<option value='" . $row['tid'] . "'>" . $row['tid'] . "</option>"; ?>
                                </select>
                            </td>
                            <td><?php echo $row['tname']; ?></td>
                            <td><?php echo $row['t1']; ?></td>
                            <td><?php echo $row['t2']; ?></td>
                            <td><?php echo $row['t3']; ?></td>
                            <td>
                                <select name="name">
                                    <?php
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->studentrecord();
                                        $recordset=$obj->studentrecord();
                                        foreach($recordset as $row){
                                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>

                            <td><button type='btn btn-primary' value='submit'>ASSIGN</button></td>

                            <td><?php

                                    if(!empty($msg)){
                                        echo "ASSIGNED";
                                    }
                                    else{
                                        $obj=new data();
                                        $obj->setconnection();
                                        $obj->isassigned($tid);
                                        $record=$obj->isassigned($tid);
                                        foreach($record as $row){
                                            $uid=$row['uid'];
                                        }
                                        if($uid!='0'){
                                            echo "ASSIGNED";
                                        }
                                        else{
                                            echo "NOT ASSIGNED";
                                        }
                                    }
                                ?>
                            </td>
                            </form>
                        </tr>
                        <?php
                            }
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
    </script>

</body>
</html>
