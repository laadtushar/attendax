<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>AttendaX</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">

                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">                            <?php 
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
     
                            ?></h6>
                        <span><?php 
                                if(isset($_SESSION['db_user_role']))
                                {
                                    echo ucwords($_SESSION['db_user_role']);
                                    echo ' ';
                                }
     
                            ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">

                <?php
                    if (!isset($_SESSION['username']) && $_SESSION['db_user_role'] == 'employee'){ 
                    ?>
                    <a href="employee.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <?php 
                    } 
                ?>

                    <?php
                        if (!isset($_SESSION['username']) && $_SESSION['db_user_role'] == 'admin'){ 
                    ?>
                    <a href="admin.php" class="nav-item nav-link active" ><i class="fa fa-user-lock me-2"></i>Manage</a>
                    <a href="users.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Users</a>
                    <?php 
                    } 
                ?>

                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->