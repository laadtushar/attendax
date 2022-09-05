<?php
require_once './includes/db.php';
session_start();
if (!isset($_SESSION['username']) && $_SESSION['db_user_role'] == 'admin' && isset($_GET['edit'])){

    $User_ID = $_GET['edit'];
            $sql_user_query = "select * from users where user_id='$User_ID'";

            $sql_user_update = mysqli_query($con,$sql_user_query);

            while($row = mysqli_fetch_assoc($sql_user_update))
            {
                $user_db_id = $row['user_id'];
                $user_name = $row['user_name'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $user_role = $row['user_type'];
                $user_email = $row['user_email'];
                $user_password = $row['user_password'];
            }                 

} 
else {
    $_SESSION['flashMessage'] = 'Login As Admin User';
    header("location: ./users.php");
}
?>
<?php require_once "includes/header.php" ?>
<?php require_once "includes/nav.php" ?>
<!-- Recent Sales End -->

<?php
        if(isset($_POST['btn_edit_user']))
        {
            $user_name = $_POST['username'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $user_role = $_POST['usertype'];
            $user_email = $_POST['useremail'];
            $user_password = $_POST['userpassword'];    
            $current_status = 'checked out'  ;
            
            try{
                $update_query = "update users set first_name='$first_name', last_name='$last_name', user_type='$user_role', user_name='$user_name', user_email='$user_email', user_password=md5('$user_password') where user_id='$User_ID'";

                $update_user_query = mysqli_query($con,$update_query);
            }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }
            if($update_user_query)
            {
                echo "<script> window.location = './users.php'; </script>";
            }
            else
            {
                echo "Query Failed!";
            }
            
        }
    ?>

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-3 px-3">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-9">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-user-plus fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2"></p>
                    <h6 class="mb-0">User Form</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="#">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-plus fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"></p>
                        <h6 class="mb-0">Edit User</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- add user start -->
<div class="container-fluid pt-4 px-4">
    <div class="col-sm-12 col-xl-9">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Add Employee</h6>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" value="<?php echo $user_name ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="firstname" class="form-control" value="<?php echo $first_name ?>" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="lastname" class="form-control" value="<?php echo $last_name ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">User Type</label>
                    <div class="col-sm-10">
                    <input type="text" name="usertype" class="form-control" value="<?php echo $user_role ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">User Email</label>
                    <div class="col-sm-10">
                    <input type="text" name="useremail" class="form-control" value="<?php echo $user_email ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Duration" class="col-sm-2 col-form-label">Set New Password</label>
                    <div class="col-sm-10">
                    <input type="password" name="userpassword" placeholder="Set New Password" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-primary" name="btn_edit_user">Edit User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add suer close -->

<!-- Footer -->
<?php require_once "includes/footer.php" ?>