<?php

require '../include/auth.php';
// require '../functions/sales/salesFunctions.php';
?>

<!-- Wrapper -->
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
					<a href="#EM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button"
						aria-controls="EM">
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
					<a href="#CM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button"
						aria-controls="CM">
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
					<a href="#SM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button"
						aria-controls="SM">
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
					<a href="#rPort" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button"
						aria-controls="rPort">
						<i class="fas fa-file"></i>Reports
					</a>
					<ul class="collapse list-unstyled" id="rPort">
						<li>
							<a href="#">Create Sale Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#messages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
						role="button" aria-controls="messages">
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

		<!-- Dark overlay -->
		<div class="overlay"></div>

		<!-- Content -->
		<div class="content">

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
								<a class="noUnderline dropdown-toggle d-flex align-items-center ml-2" href="#"
									id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
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


			<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
			<div class="first-content">
				<div class="container-fluid">
					<div class="row pt-5 justify-content-center">
						<div class="col-4 cRound" style="background-color: rgb(197, 236, 197);">
							<div class="row justify-content-center p-3">
								<h4><u>Wallet</u></h4>
							</div>
							<div class="row justify-content-center p-3">
								<table id="walletTable">
									<tr>
										<td>Username</td>
										<td>: Dilrukshan</td>
									</tr>
									<tr>
										<td>User ID</td>
										<td>: USD10300</td>
									</tr>
									<tr>
										<td>Total Earnings</td>
										<td>: 100000</td>
									</tr>
									<tr>
										<td>Payment</td>
										<td>: 1000</td>
									</tr>
									<tr>
										<td>Commission</td>
										<td>: 10000</td>
									</tr>
								</table>
							</div>
							<div class="row justify-content-end p-3">
								<input id="resetWallet" name="resetWallet" type="button" class="btnInit btnRed" value="Reset Wallet">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------ First Content End ------------------------------------------------------------>

		</div>
		<!-- End content -->

	</div>