<!-- Header -->

<?php require_once "includes/header.php" ?>

<?php session_start() ?>

<!-- Sign In Start -->
<div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>AttendaX</h3>
                            </a>
                            <h3>Initialize AMS</h3>

                        </div>
                        <?php
        if(isset($_POST['btn-db']))
        {
            $ip = $_POST['ip'];
            $db_name = $_POST['dbname'];
            $db_user_name = $_POST['dbusername'];
            $db_password = $_POST['dbpassword'];
            
            $myfile = fopen("includes/config.php", "w") or die("Unable to open file!");
            $txt = "<?php

            return array(
                'host' => '$ip',
                'database' => '$db_name',
                'username' => '$db_user_name',
                'password' => '$db_password'
            );
            ?>";
            fwrite($myfile, $txt);
            fclose($myfile);
            
        }
    ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" name="ip" class="form-control" placeholder="Host" id="floatingInput">
                            <label for="floatingInput">Host</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="dbname" class="form-control" placeholder="DB Name" id="floatingInput">
                            <label for="floatingInput">DB Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="dbusername" class="form-control" placeholder="DB User Name" id="floatingInput">
                            <label for="floatingInput">DB User Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="dbpassword" class="form-control" placeholder="DB Password" id="floatingPassword">
                            <label for="floatingPassword">DB Password</label>
                        </div>
                        <button type="submit" name="btn-db" class="btn btn-primary py-3 w-100 mb-4">Initialize</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>AttendaX</h3>
                            </a>
                            <h3>Initialize AMS</h3>

                        </div>
                        <?php
        if(isset($_POST['btn-initialize']))
        {

            $admin_user_name = $_POST['adminusername'];
            $admin_first_name = $_POST['adminfirstname'];
            $admin_last_name = $_POST['adminlastname'];
            $admin_email = $_POST['adminemail'];
            $admin_password = $_POST['adminpassword'];    
            
            try{
                include './includes/db.php';
                
            $sql1 = "CREATE TABLE `activitylog` (
                `activity_id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `date` datetime NOT NULL,
                `activity` varchar(255) NOT NULL,
                PRIMARY KEY (`activity_id`)
              ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4";

            $sql2 = "CREATE TABLE `attendance` (
                `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
                `date` date NOT NULL,
                `user_id` int(255) NOT NULL,
                `from_time` time NOT NULL,
                `to_time` time DEFAULT NULL,
                `work_duration` varchar(100) NOT NULL,
                PRIMARY KEY (`attendance_id`)
              ) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4";
            
            $sql3 = "CREATE TABLE `leaves` (
                `leave_id` int(11) NOT NULL AUTO_INCREMENT,
                `leave_reason` varchar(255) NOT NULL,
                `user_id` varchar(255) NOT NULL,
                `from_date` date NOT NULL,
                `to_date` date NOT NULL,
                `leave_duration` varchar(255) NOT NULL,
                `leave_status` varchar(255) NOT NULL,
                PRIMARY KEY (`leave_id`)
              ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4";

            $sql4 = "CREATE TABLE `users` (
                `user_id` int(11) NOT NULL AUTO_INCREMENT,
                `user_name` varchar(255) NOT NULL,
                `first_name` varchar(255) NOT NULL,
                `last_name` varchar(255) NOT NULL,
                `user_type` varchar(255) NOT NULL,
                `user_email` varchar(255) NOT NULL,
                `user_password` varchar(255) NOT NULL,
                `current_status` varchar(255) NOT NULL,
                PRIMARY KEY (`user_id`),
                UNIQUE KEY `user_name` (`user_name`),
                UNIQUE KEY `user_email` (`user_email`)
              ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4";

            $sql5 = "INSERT INTO `users`(
                `user_id`,
                `user_name`,
                `first_name`,
                `last_name`,
                `user_type`,
                `user_email`,
                `user_password`,
                `current_status`
            )
            VALUES(
                NULL,
                '$admin_user_name',
                '$admin_first_name',
                '$admin_last_name',
                'admin',
                '$admin_email',
                md5('$admin_password'),
                'checked out'
            )";
            $result1 = mysqli_query($con,$sql1);
            $result2 = mysqli_query($con,$sql2);
            $result3 = mysqli_query($con,$sql3);
            $result4 = mysqli_query($con,$sql4);
            $result5 = mysqli_query($con,$sql5);

            }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }
            if($result1 && $result2 && $result3 && $result4 && $result5)
            {
                echo "<script> window.location = './index.php'; </script>";
                $link = "./installer.php";
                unlink($link);
            }
            else
            {
                echo "Query Failed!";
            }
            
        }
    ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" name="adminusername" class="form-control" placeholder="Admin User Name" id="floatingInput">
                            <label for="floatingInput">Admin User Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="adminfirstname" class="form-control" placeholder="Admin User Name" id="floatingInput">
                            <label for="floatingInput">Admin First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="adminlastname" class="form-control" placeholder="Admin User Name" id="floatingInput">
                            <label for="floatingInput">Admin Last Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="adminemail" class="form-control" placeholder="Admin User Name" id="floatingInput">
                            <label for="floatingInput">Admin Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="adminpassword" class="form-control" placeholder="Admin Password<" id="floatingPassword">
                            <label for="floatingPassword">Admin Password</label>
                        </div>
                        <button type="submit" name="btn-initialize" class="btn btn-primary py-3 w-100 mb-4">Initialize</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

<!-- Footer -->
<?php require_once "includes/footer.php" ?>