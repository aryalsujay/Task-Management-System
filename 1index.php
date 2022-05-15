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
    <title>Document</title>
</head>
<body>
    <?php

    //session_start();

    //session_unset();
    //session_destroy();
        $msg="";
        if(!empty($_REQUEST['msg'])){
            $msg=$_REQUEST['msg'];
        }
        $emailmsg="";
        if(!empty($_REQUEST['emailmsg'])){
            $emailmsg=$_REQUEST['emailmsg'];
        }
        $passmsg="";
        if(!empty($_REQUEST['passmsg'])){
            $passmsg=$_REQUEST['passmsg'];
        }
        $ademailmsg="";
        if(!empty($_REQUEST['ademailmsg'])){
            $ademailmsg=$_REQUEST['ademailmsg'];
        }
        $adpassmsg="";
        if(!empty($_REQUEST['adpassmsg'])){
            $adpassmsg=$_REQUEST['adpassmsg'];
        }
    ?>

    <a href="1index.php"><h2>Pala TMS</h2></a>
    <div class="container login-container">
        <div class="row"><h4><?php echo $msg?></h4></div>
        <div class="row">
            <div class="col-md-6 login1">
            <h3>Savaka</h3>
                <form action="2login_server_page.php" method="get">                    
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" value="" placeholder="Enter Email"/>                        
                    </div>
                    <label style="color:red">*<?php echo $emailmsg?></label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" value="" placeholder="Enter Password"/>                        
                    </div>
                    <label style="color:red">*<?php echo $passmsg?></label>
                    <div class="form-group">
                        <input type="submit" class="btn-primary" value="Login"/>                        
                    </div>
                    <a href=# class="Forgotpass">Forgot Password</a>
                </form>                
            </div>
            <div class="col-md-6 login2">
            <h3>Admin</h3>
                <form action="3loginadmin_server_page.php" method="get">                    
                    <div class="form-group">
                        <input type="text" class="form-control" name="ademail" value="" placeholder="Enter Email"/>                        
                    </div>
                    <label style="color:red">*<?php echo $ademailmsg?></label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="adpass" value="" placeholder="Enter Password"/>                        
                    </div>
                    <label style="color:red">*<?php echo $adpassmsg?></label>
                    <div class="form-group">
                        <input type="submit" class="btn-primary"value="Login"/>                        
                    </div>
                    <a href=# class="Forgotpass">Forgot Password</a>
                </form>                
            </div>

        </div>
    </div>
    <script src="" async defer></script>
</body>
</html>