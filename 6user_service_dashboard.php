<?php include "5data_class.php";
    //session_start();
    $userloginid=$_GET['userlogid'];
    //$userloginid=$_SESSION["userid"] = $_GET['userlogid'];
    if(empty($_SESSION['userid'])){
        header("Location:1index.php?msg=Invalid");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<style>
    .container,
    .row,
    .innerdiv{
        text-align: center;
        margin-top: 100px;
    }
    .imglogo{
        margin:auto;
    }
    .greenbtn{
        cursor: pointer;
        background-color: greenyellow;
        box-sizing: content-box;
        border-radius: 1rem;
        box-shadow: rgb(16,170,16);
        margin-top: 8px;
        width:92%;
        height: 40px;

    }
    .leftinnerdiv{
        float:left;
        width:25%;
    }
    .rightinnerdiv{
        float:right;
        width:75%;
    }
    .innerright{
        background-color: rgb(105, 221, 105);
    }
    th{
        background-color: orange;
        text-align: center;
    }
    td{
        background-color: wheat;
        text-align: center;
    }
    .a{
        text-decoration: none;
    }
</style>
<body>
    <?php
    //include "5data_class.php"; ?>
    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.PNG"/></div>

            <div class="leftinnerdiv">
                <button class="greenbtn">Welcome</button>
                <button class="greenbtn" onclick="openpart('myaccount')">My Account</button>
                <button class="greenbtn" onclick="openpart('assigntask')">Assigned Task</button>
                <button class="greenbtn" onclick="openpart('bookreport')">Book Report</button>
                <a href="1index.php"><button class="greenbtn">LOGOUT</button></a>
            </div>

            <div class="rightinnerdiv">
                <div id="myaccount" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){echo "display:none";}else{echo "";}?>">
                   <button class="greenbtn">My Account</button>
                   <?php
                        $userloginid=$_GET['userlogid'];
                        $obj=new data;
                        $obj->setconnection();
                        $obj->userdetail($userloginid);
                        $recordset=$obj->userdetail($userloginid);

                        foreach($recordset as $row){
                            $name=$row[1];
                            $email=$row[2];
                        }

                    ?>
                    <p style=color:black><u>Person Name: </u> &nbsp&nbsp<?php echo "$name" ?></p>
                    <p style="color:black"><u>Person Email:</u> &nbsp&nbsp<?php echo $email ?></p>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="assigntask" class="innerright portion" style="display:none">
                    <button class="greenbtn">View Task</button>
                    <?php
                        $u= new data;
                        $u->setconnection();
                        $u->viewtask();
                        $result=$u->viewtask();
                    ?>
                        <table class='tbl-qa'>
                        <thead>
                            <tr>
                                <th class='table-header' width='20%'>Task</th>
                                <th class='table-header' width='40%'>Sub-Task 1</th>
                                <th class='table-header' width='20%'>Sub-Task 2</th>
                                <th class='table-header' width='20%'>Sub-Task 3</th>
                                <th class='table-header' width='20%'>User</th>
                                <th class='table-header' width='20%'>Checkbox</th>
                                <th class='table-header' width='20%'>Assign To</th>

                            </tr>
                        </thead>
                        <tbody id='table-body'>
                        <?php
                        if(!empty($result)) {
                            foreach($result as $row) {
                        ?>
                        <tr class='table-row'>
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
                            <td><input type="checkbox"/></td>
                            <td><input type="submit" value="Assign"></button></td>


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
            var x = document.getElementsByClassName("portion");
            for(i=0; i < x.length ; i++){
                x[i].style.display="none";
            }
            document.getElementById(portion).style.display="block";
        }
    </script>

</body>
</html>