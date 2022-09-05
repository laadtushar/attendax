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
                            <h3>Sign In</h3>

                        </div>

                        <form action="includes/login.php" method="POST">
                        <?php 
                            if (isset($_SESSION['flashMessage'])) 
                                {
                                    echo $_SESSION['flashMessage'];
                                    unset($_SESSION['flashMessage']);
                                } 
                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" placeholder="User Name" id="floatingInput">
                            <label for="floatingInput">User Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="floatingPassword">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" name="btn-login" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

<!-- Footer -->
<?php require_once "includes/footer.php" ?>