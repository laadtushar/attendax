<body>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- sidebar -->
        <?php require_once "includes/sidebar.php" ?>


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->

            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-2">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i> 
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex"><?php 
                                if(isset($_SESSION['db_first_name']))
                                {
                                    echo $_SESSION['db_first_name'];
                                    echo ' ';
                                }
                                if(isset($_SESSION['db_last_name']))
                                {
                                    echo $_SESSION['db_last_name'];
                                    echo ' ';
                                }
     
                            ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="./includes/logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->