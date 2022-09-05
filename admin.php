<?php
require_once './includes/db.php';
session_start();
if (!isset($_SESSION['username']) && $_SESSION['db_user_role'] == 'admin'){} 
else {
    $_SESSION['flashMessage'] = 'Login As Admin User';
    header("location: ./index.php");
}

?>

<!-- Header -->
<?php require_once "includes/header.php" ?>

<?php require_once "includes/nav.php" ?>

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-3 px-3">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-12">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-briefcase fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Overview </p>
                    <h6 class="mb-0">Live Status</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                    <a href="">Show All</a>
                </div>
                <div id="">
                    <form action="admin.php" method="GET">
                        <div class="row mb-3">
                        <input type="text" class="form-control" name="date" id="calender">
                        </div>
                        <div class="row mb-3">
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Show Activity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Widgets End -->



<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Activity</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Name</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    <?php 
                                if(isset($_GET['date']))
                                {
                                    $Date = $_GET['date'];
                                    $newDate = date("Y-m-d", strtotime($Date));                    
                                }
                                else
                                {
                                    $newDate = date('Y-m-d');

                                }
                                
                                $sql1 = "SELECT * FROM activitylog  where DATE(date) = '$newDate' order by activity_id DESC";
                                $activity_log = mysqli_query($con,$sql1);
                                

                                while($row = mysqli_fetch_assoc($activity_log))
                                {
                                    $user_ID = $row['user_id'];
                                    ?>                                    
                                        <?php 
                                            $query = "select * from users where user_id='$user_ID'";
                                            $data = mysqli_query($con,$query);
                                            
                                            while($value = mysqli_fetch_assoc($data))
                                            {
                                                ?>
                                        <td><?php echo $value['user_name']; ?>
                                        <?php echo ' '; ?>
                                        <?php echo $value['last_name']; ?>
                                    </td>

                                                <?php
                                            }
                                        
                                        ?>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['activity']; ?></td>
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
        <div class="col-sm-6 col-xl-12">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-briefcase fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Leave</p>
                    <h6 class="mb-0">Manage Employee Leaves</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Manage Leaves</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Name</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    <?php 
                                
                                $sql = "SELECT * FROM leaves";
                                $leave_log = mysqli_query($con,$sql);
                                
                                

                                while($row = mysqli_fetch_assoc($leave_log))
                                {
                                    $user_ID = $row['user_id'];

                                    ?>                                    
                                        <?php 
                                            $query = "select * from users where user_id = '$user_ID'";
                                            $data = mysqli_query($con,$query);
                                            
                                            while($value = mysqli_fetch_assoc($data))
                                            {
                                                ?>
                                        <td><?php echo $value['user_name']; ?>
                                        <?php echo ' '; ?>
                                        <?php echo $value['last_name']; ?>
                                    </td>

                                                <?php
                                            }
                                        
                                        ?>
                                        <td><?php echo $row['from_date']; ?></td>
                    <td><?php echo $row['to_date']; ?></td>
                    <td><?php echo $row['leave_duration']; ?></td>
                    <td><?php echo $row['leave_reason']; ?></td>
                    <td><?php echo $row['leave_status']; ?></td>
                    <td><a class="btn btn-sm btn-primary" href="admin.php?approve=<?php echo $row['leave_id'] ?>">Approve</a>
                            <a class="btn btn-sm btn-primary" href="admin.php?reject=<?php echo $row['leave_id'] ?>">Reject</a></td>
                            </tr> 
                            <?php                                  
                                }  
                                //approve the comment

                                if(isset($_GET['approve']))
                                {
                                    $leave_id = $_GET['approve'];
                                    $sql_admin = "update leaves set leave_status = 'approved' where leave_id='$leave_id'";

                                    $sql_result_admin = mysqli_query($con,$sql_admin);
                                    if($sql_result_admin)
                                    {
                                        echo "<script> window.location = './admin.php'; </script>";
                                    }
                                }

                                //unnaprove the comment
                                if(isset($_GET['reject']))
                                {
                                    $leave_id = $_GET['reject'];
                                    $sql_admin = "update leaves set leave_status = 'rejected' where leave_id='$leave_id'";

                                    $sql_result_admin = mysqli_query($con,$sql_admin);
                                    if($sql_result_admin)
                                    {
                                        echo "<script> window.location = './admin.php'; </script>";
                                    }
                                }
                                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- Footer -->
<?php require_once "includes/footer.php" ?>