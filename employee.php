<?php
require_once './includes/db.php';
session_start();
if (!isset($_SESSION['username']) && $_SESSION['db_user_role'] == 'employee'){} 
else {
    $_SESSION['flashMessage'] = 'Login As Admin User';
    header("location: ./index.php");
}
?>

<!-- Header -->
<?php require_once "includes/header.php" ?>

<?php require_once "includes/nav.php" ?>

<!-- check current status -->
<?php 
            if(isset($_SESSION['db_user_id']))
            {
                $db_user_id = $_SESSION['db_user_id'];                   
            }
            
            $sql_status = "SELECT * FROM attendance where user_id = '$db_user_id'";
            $cur_status = mysqli_query($con,$sql_status);
            $status = 'out';

            while($row = mysqli_fetch_assoc($cur_status))
            
            {
                if($row['to_time'] === NULL){
                    $status = 'in';
                }else{
                    $status = 'out';
                }
            }
                ?>

<!-- check in -->
<?php



        if(isset($_GET['checkin'] ) && $status==='out')
        {
            $User_ID = $_GET['checkin'];
            $current_date = date('Y-m-d');
            $current_time = date("h:i:s");

            $insert_query = "insert into attendance(date,from_time,user_id) values ('$current_date', '$current_time', '$User_ID')";

                    $update_user_query = mysqli_query($con,$insert_query);

                    if($update_user_query)
                    {   
                        $current_date = date('Y-m-d h:i:s');
                        $insert_query_activity = "insert into activitylog(user_id,date,activity) values ('$User_ID','$current_date', 'checked in')";
                        $update_user_query = mysqli_query($con,$insert_query_activity);
                        echo "<script> window.location = './employee.php'; </script>";

                    }
                    else
                    {
                        echo "Something is Wrong";
                    }


        
        }
    ?>

<!-- check out -->
<?php



if(isset($_GET['checkout']) && $status==='in')
{
    $User_ID = $_GET['checkout'];
    $current_date = date('Y-m-d');
    $current_time = date("h:i:s");
    $update_query = "update attendance set to_time='$current_time',work_duration=TIMEDIFF('$current_time',from_time) where to_time IS NULL ";

            $update_user_query = mysqli_query($con,$update_query);
            

            if($update_user_query)

            {
                $current_date = date('Y-m-d h:i:s');
                $insert_query_activity = "insert into activitylog(user_id,date,activity) values ('$User_ID','$current_date', 'checked out')";
                $update_user_query = mysqli_query($con,$insert_query_activity);
                echo "<script> window.location = './employee.php'; </script>";

            }
            else
            {
                echo "Something is Wrong";
            }



}
?>






<!-- Sale & Revenue Start -->
<div class="container-fluid pt-3 px-3">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-6">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-calendar-alt fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2"></p>
                    <h6 class="mb-0"><?php echo date("l\, jS F Y"); ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="#">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-door-open fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"></p>
                        <?php if($status==='out') {?>
                        <a class="btn btn-sm btn-primary" href="employee.php?checkin=<?php echo $_SESSION['db_user_id'] ?>">Check In</a>
                    <?php
                    }else{
                        ?>
                        <h6 class="mb-0">Checked In</h6>
                        <?php
                    } ?>
                        </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="#">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-door-closed fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"></p>
                        <?php if($status==='in') {?>
                        <a class="btn btn-sm btn-primary" href="employee.php?checkout=<?php echo $_SESSION['db_user_id'] ?>">Check Out</a>
                        <?php
                    }else{
                        ?>
                        <h6 class="mb-0">Checked Out</h6>
                        <?php
                    } ?>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Attendance</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Date</th>
                        <th scope="col">Check In</th>
                        <th scope="col">Check Out</th>
                        <th scope="col">Duration</th>
                    </tr>
                </thead>
                <tbody>
                <tr>

<?php 
            if(isset($_SESSION['db_user_id']))
            {
                $db_user_id = $_SESSION['db_user_id'];                   
            }
            
            $sql = "SELECT * FROM attendance where user_id = '$db_user_id' order by attendance_id DESC";
            $attendance_log = mysqli_query($con,$sql);
            

            while($row = mysqli_fetch_assoc($attendance_log))
            
            {
                if($row['to_time'] === NULL){
                    $status = 'in';
                }else{
                    $status = 'out';
                }
                ?>                                    
                    
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['from_time']; ?></td>
                    <td><?php echo $row['to_time']; ?></td>
                    <td><?php echo $row['work_duration']; ?></td>
                    </tr> 
                            <?php
                            
                        }
                    
                    ?>
                    
        


                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-3 px-3">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-9">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-plane-departure fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2"></p>
                    <h6 class="mb-0">Your Leaves</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="#">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-plus fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"></p>
                        <h6 class="mb-0">Apply Leave</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Leaves</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <tr>

<?php 
            if(isset($_SESSION['db_user_id']))
            {
                $db_user_id = $_SESSION['db_user_id'];                   
            }
            
            $sql2 = "SELECT * FROM leaves where user_id = '$db_user_id'";
            $leave_log = mysqli_query($con,$sql2);
            

            while($row = mysqli_fetch_assoc($leave_log))
            {
                ?>                                    
                    
                    <td><?php echo $row['from_date']; ?></td>
                    <td><?php echo $row['to_date']; ?></td>
                    <td><?php echo $row['leave_duration']; ?></td>
                    <td><?php echo $row['leave_reason']; ?></td>
                    <td><?php echo $row['leave_status']; ?></td>
                    </tr>
                            <?php
                        }
                    
                    ?>
                    
         
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

if(isset($_SESSION['db_user_id']))
            {
                $db_user_id = $_SESSION['db_user_id'];                   
            }

        if(isset($_POST['btn_apply_leave']))
        {
            $from_date = $_POST['fromdate'];
            $to_date = $_POST['todate'];
            $leave_duration = $_POST['duration'];
            $leave_reason = $_POST['reason'];
            
            try{
            $sql5 = "insert into leaves (leave_reason, from_date, to_date, leave_duration, leave_status, user_id) values ( '$leave_reason', '$from_date', '$to_date', '$leave_duration', 'in process','$db_user_id')";
            $result = mysqli_query($con,$sql5);
            }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }
            if($result)
            {
                echo "<script> window.location = './employee.php'; </script>";
            }
            else
            {
                echo "Query Failed!";
            }
            
        }
    ?>

<!-- apply leave start -->
<div class="container-fluid pt-4 px-4">
    <div class="col-sm-12 col-xl-6">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Apply For Leave </h6>
            <form action="" method="POST" enctype="multipart/form-data">
                   <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">User</label>
                    <div class="col-sm-10">
                        <input disabled type="text" class="form-control" name="username" value="<?php echo $_SESSION['db_user_name']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">From</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="fromdate">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="todate" class="col-sm-2 col-form-label">To</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="todate">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Duration" class="col-sm-2 col-form-label">Duration</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="duration">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="reason">
                    </div>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-primary" name="btn_apply_leave">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- apply leave close -->

<!-- Footer -->
<?php require_once "includes/footer.php" ?>
