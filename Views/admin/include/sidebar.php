<body>
    <div class="wrapper">
        <!-- Wrapper -->
        <nav class="sidebar">

            <!-- close sidebar menu -->

            <ul class="list-unstyled menu-elements">
                <li class="">
                    <h4 class="ml-4">Menu</h4>
                    <div class="dismiss">
                        <i class="fas fa-times"></i>
                    </div>

                </li>
                <li>
                    <a href="#EM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="EM">
                        <i class="fas fa-user-plus"></i>Employee Master
                    </a>
                    <ul class="collapse list-unstyled" id="EM">
                        <li>
                            <a href="Create Employee.html">Create Employee</a>
                        </li>
                        <li>
                            <a href="Search Employee.html">Search Employee</a>
                        </li>
                        <li>
                            <a href="Manage Employee.html">Manage Employee</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#CM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="CM">
                        <i class="fas fa-calculator"></i>Item Master
                    </a>
                    <ul class="collapse list-unstyled" id="CM">
                        <li>
                            <a href="Items.html">Items</a>
                        </li>
                        <li>
                            <a href="Payments.html">Payments</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#SM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="SM">
                        <i class="fas fa-receipt"></i>Sales Management
                    </a>
                    <ul class="collapse list-unstyled" id="SM">
                        <li>
                            <a href="Create Sale Order.html">Create Sale Order</a>
                        </li>
                        <li>
                            <a href="Search Sale Orders.html">Search Sale Orders</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#rPort" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="rPort">
                        <i class="fas fa-file"></i>Reports
                    </a>
                    <ul class="collapse list-unstyled" id="rPort">
                        <li>
                            <a href="#">Create Sale Order</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#messages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="messages">
                        <i class="fas fa-envelope"></i>Messages
                    </a>
                    <ul class="collapse list-unstyled" id="messages">
                        <li>
                            <a href="Send SMS.html">Send SMS</a>
                        </li>
                        <a href="Push Notification.html">Push Notification</a>
                    </ul>
                </li>
                <li>
                    <a href="UpgradeDowngrade.html"><i class="fa fa-sort "></i>Upgrade/Downgrade</a>
                </li>
            </ul>

        </nav>
        <!-- End sidebar -->

        <?php
        include 'include/accarea.php';
        ?>