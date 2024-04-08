<?php
require '../include/auth.php';

?>

<div class="wrapper">
    <nav class="sidebar">

        <!-- close sidebar menu -->

        <div class="m-1">
            <h3></h3>
        </div>

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
    <div class="overlay"></div>

    <nav id="naviBar" class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <i class="fas fa-angle-double-right fa-sm mr-3 text-light open-menu" style="cursor:pointer;"></i>
            <span class="comName">Dashboard</span>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="fas fa-user"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="naviIcon">
                    </li>
                    <li class="naviIcon">
                        <i class="fa fa-calendar fa-lg mr-2" style="font-size: 18px;"></i>
                        <span id="currentDate" class="bd-highlight align-self-center">[Current date]</span>
                    </li>
                    <li class="naviIcon ml-2">
                        <div class="mr-2 ml-2">
                            <div>
                                <span style="font-size: 15px;">Marley Botosh</span>
                            </div>
                            <div class="d-flex justify-content-center">
                                <span style="font-size: 11px;">Administrator</span>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown naviIcon ml-2">
                        <a class="noUnderline dropdown-toggle d-flex align-items-center ml-2" href="#" id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle" style="font-size: 23px;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="first-content">
        <div class="container-fluid">
            <div class="row pt-5 pl-3 pr-3">
                <h5 class="mb-1">Upgrade / Downgrade</h5>
                <!-- Section rectangle inside -->
                <div class="col-12 ">
                    <form action="" id="referralForm">
                        <div class="input-group m-2 justify-content-center">
                            <div class="searchIcon fa fa-search d-flex align-items-center" style="width: 38px; height: 38px;"></div>
                            <input id="upwardandDown" name="upward" placeholder="Enter Empoyee Id" type="text" class="searchBox cRound mr-2" placeholder="Search User ID" style="width: 30%;">
                            <input id="updownBtn" class="btnInit btnGreen text-light" type="submit" value="View Up and Down" style="font-size: 12px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col cRound" style="background-color: rgb(223, 222, 222);">
                <div class="row justify-content-center p-3">
                    <h4>Upward Results</h4>
                    <table id="showTable1" class="table table-hover backTheam m-0">
                        <thead>
                            <tr style="background-color: #b4b3b3">
                                <th scope="col">Employee ID</th>
                                <th scope="col">Level</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center p-3">
                    <h4>Downgrade Results</h4>
                    <table id="showTable2" class="table table-hover backTheam m-0">
                        <thead>
                            <tr style="background-color: #b4b3b3">
                                <th scope="col">Employee ID</th>
                                <th scope="col">Level</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>




<!-- Divs for displaying the results -->
<!-- <div class="center">
    <h3>upwardResults</h3>
    <div id="upwardResults"></div>

    <h3>downwardResults</h3>
    <div id="downwardResults"></div>
</div> -->


<script>
    $(document).ready(function() {
        $('#referralForm').on('submit', function(event) {
            event.preventDefault();

            var empId = $('#upwardandDown').val();

            $.ajax({
                url: '../salesOrder/UpDownConfig.php',
                type: 'GET',
                data: {
                    action: 'getReferralLevels',
                    empId: empId
                },
                success: function(response) {
                    // Clear previous results from the tables
                    $('#showTable1 tbody').empty();
                    $('#showTable2 tbody').empty();

                    // Process and display upward referral levels in showTable1
                    if (Object.keys(response.upward).length === 0) {
                        $('#showTable1 tbody').html('<tr><td colspan="2">No upward referral levels found.</td></tr>');
                    } else {
                        $.each(response.upward, function(empId, level) {
                            $('#showTable1 tbody').append('<tr><td>' + empId + '</td><td>' + 'Level ' + level + '</td></tr>');
                        });
                    }

                    // Process and display downward referral levels in showTable2
                    if (Object.keys(response.downward).length === 0) {
                        $('#showTable2 tbody').html('<tr><td colspan="2">No downward referral levels found.</td></tr>');
                    } else {
                        $.each(response.downward, function(empId, level) {
                            $('#showTable2 tbody').append('<tr><td>' + empId + '</td><td>' + 'Level ' + level + '</td></tr>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>