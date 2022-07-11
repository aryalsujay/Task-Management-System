<!-- Assign Task template -->
<div class="rightinnerdiv">
                <div id="assigntask" class="innerright portion" style="display:none">
                    <button class="greenbtn">Assign Task</button>

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
                                <th class='table-header' width='10%'>Status</th>
                                <th class='table-header' width='10%'>Assign To</th>
                            </tr>
                        </thead>
                        <tbody id='table-body'>

                        <?php
                        if(!empty($result)) {
                            foreach($result as $row) {
                        ?>
                        <form action="9userviewtask.php" method="post" enctype="multipart/form-data">
                        <tr class='table-row'>
                            <td><select name="id">
                                    <?php echo "<option value='" . $row['tid'] . "'>" . $row['tid'] . "</option>"; ?>
                                </select>
                            </td>
                            <?php $uid=$row['uid']; ?>
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
                            <td><button type='btn btn-primary' value='submit'>ASSIGN</button></td>
                        </tr>
                        </form>
                        <?php
                            }
                        }
                        ?>
                </div>
            </div>