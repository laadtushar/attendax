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
                <i class="fas fa-user fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Users</p>
                    <h6 class="mb-0">View All Users</h6>
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
            <h6 class="mb-0">Users List</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr>

<?php 
            if(isset($_SESSION['db_user_id']))
            {
                $db_user_id = $_SESSION['db_user_id'];                   
            }
            
            $sql = "SELECT * FROM users";
            $user_list = mysqli_query($con,$sql);
            

            while($row = mysqli_fetch_assoc($user_list))
            {
                ?>                                    
                    
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['user_email']; ?></td>
                    <td><?php echo $row['user_type']; ?></td>
                    <td><a class="btn btn-sm btn-primary" href="users.php?del=<?php echo $row['user_id'] ?>">Delete</a>
                    <a class="btn btn-sm btn-primary" href="edit_user.php?edit=<?php echo $row['user_id'] ?>">Edit</a></td>
                    </tr> 

                            <?php
                        }
                        //delete the user
                                
                        if(isset($_GET['del']))
                        {
                            $user_del_id = $_GET['del'];
                            $sql_user_del = "delete from users where user_id ='$user_del_id'";
                            $user_del_query = mysqli_query($con,$sql_user_del);

                            if($user_del_query)
                            {
                                echo "<script> window.location = './users.php'; </script>";
                            }

                        }
                    
                    ?>
                    
        


                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<?php
        if(isset($_POST['btn_add_user']))
        {
            $user_name = $_POST['username'];
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $user_role = $_POST['usertype'];
            $user_email = $_POST['useremail'];
            $user_password = $_POST['userpassword'];    
            $current_status = 'checked out'  ;
            
            try{
            $sql4 = "insert into users (user_name, user_password, first_name, last_name, user_email, user_type, current_status) values ('$user_name', md5('$user_password'), '$first_name', '$last_name', '$user_email', '$user_role','$current_status')";

            $result = mysqli_query($con,$sql4);
            }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }
            if($result)
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
                        <h6 class="mb-0">Add User</h6>
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
                        <input type="text" name="username" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="firstname" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="lastname" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">User Type</label>
                    <div class="col-sm-10">
                    <input type="text" name="usertype" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="fromdate" class="col-sm-2 col-form-label">User Email</label>
                    <div class="col-sm-10">
                    <input type="text" name="useremail" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Duration" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="text" name="userpassword" class="form-control" >
                    </div>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-primary" name="btn_add_user">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add suer close -->

<!-- Footer -->
<?php require_once "includes/footer.php" ?>
