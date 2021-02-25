<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/img/favicon.png' ?>">
    <title><?= $title ?> | Transmittal</title>
    <link href="<?= base_url().'assets/css/css.css?family=Fira+Sans:400,500,600,700' ?>" rel="stylesheet">
    <link href="<?= base_url().'assets/css/icon.css?family=Material+Icons' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/fullcalendar.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/select2.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap-datetimepicker.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/plugins/morris/morris.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/jquery.toast.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/vendors/iconic-fonts/font-awesome/css/all.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/vendors/iconic-fonts/flat-icons/flaticon.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/vendors/iconic-fonts/cryptocoins/cryptocoins.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/jquery.dataTables.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/fixedColumns.dataTables.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/select.dataTables.min.css' ?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/dataTables.bootstrap4.min.css' ?>"> -->
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <style>
        table.dataTable tbody td {
            vertical-align: middle;
        }
    </style>

    <script type="text/javascript" src="<?= base_url().'assets/js/jquery-3.2.1.min.js' ?>"></script>

</head>

<body>

    <!-- ----- PRELOADER ----- -->
    <div id="preloader-wrap">
        <div class="spinner spinner-8">
            <div class="ms-circle1  ms-child"></div>
            <div class="ms-circle2  ms-child"></div>
            <div class="ms-circle3  ms-child"></div> 
            <div class="ms-circle4  ms-child"></div>
            <div class="ms-circle5  ms-child"></div>
            <div class="ms-circle6  ms-child"></div>
            <div class="ms-circle7  ms-child"></div>
            <div class="ms-circle8  ms-child"></div>
            <div class="ms-circle9  ms-child"></div>
            <div class="ms-circle10 ms-child"></div>
            <div class="ms-circle11 ms-child"></div>
            <div class="ms-circle12 ms-child"></div>
        </div>
    </div>
    <!-- ----- END PRELOADER ----- -->


    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index.html.htm" class="logo">
                    <img src="<?= base_url().'assets/img/logo.png' ?>" width="40" height="40" alt="">
                </a>
            </div>
            <div class="page-title-box pull-left">
                <h3>Transmittal</h3>
            </div>
            <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <ul class="nav user-menu pull-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="<?= base_url().'assets/img/user.jpg' ?>" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<!-- <a class="dropdown-item" href="profile.html.htm">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html.htm">Edit Profile</a>
						<a class="dropdown-item" href="settings.html.htm">Settings</a> -->
						<a class="dropdown-item" href="<?= base_url().'auth/logout' ?>">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu pull-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- <a class="dropdown-item" href="profile.html.htm">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html.htm">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html.htm">Settings</a> -->
                    <a class="dropdown-item" href="<?= base_url().'auth/logout' ?>">Logout</a>
                </div>
            </div>
        </div>

        <?php $this->view('template/sidebar'); ?>