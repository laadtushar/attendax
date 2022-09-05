
<?php

    session_start();
    require_once 'db.php';


    if(isset($_POST['btn-login']))

    {
        $UserName = $_POST['username'];
        $Password = $_POST['password'];

        $UserName = mysqli_real_escape_string($con,$UserName);
        $Password = mysqli_real_escape_string($con,$Password);


        $query = "select * from users where user_name = '$UserName'";
        $data = mysqli_query($con,$query);

        while($row = mysqli_fetch_assoc($data))
        {
            $db_user_ID = $row['user_id'];
            $db_UserName = $row['user_name'];
            $db_Password = $row['user_password'];
            $db_FirstName = $row['first_name'];
            $db_LastName = $row['last_name'];
            $user_email = $row['user_email'];
            $user_role = $row['user_type'];
        }

        if($UserName === $db_UserName && md5($Password) === $db_Password && $user_role === 'admin')
        {
            $_SESSION['db_user_name'] = $db_UserName;
            $_SESSION['db_user_role'] = $user_role;
            $_SESSION['db_first_name'] = $db_FirstName;
            $_SESSION['db_last_name'] = $db_LastName;
            $_SESSION['db_user_id'] = $db_user_ID;
            $_SESSION['flashMessage'] = 'Success!';

            header('location: ../admin.php');
        }
        else if ($UserName === $db_UserName && md5($Password) === $db_Password && $user_role === 'employee')
        {
            $error = 'Success!';
            $_SESSION['db_user_name'] = $db_UserName;
            $_SESSION['db_user_role'] = $user_role;
            $_SESSION['db_first_name'] = $db_FirstName;
            $_SESSION['db_last_name'] = $db_LastName;
            $_SESSION['db_user_id'] = $db_user_ID;
            $_SESSION['flashMessage'] = 'Success!';

            header('location: ../employee.php');
        }
        else 
        {
            $_SESSION['flashMessage'] = 'Invalid Credentials!';
            header('location: ../index.php');
        }


    }


?>