<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/img/favicon.png' ?>">
    <title>Login | Transmittal</title>
    <link href="<?= base_url().'assets/css/css.css?family=Fira+Sans:400,500,600,700' ?>" rel="stylesheet">
    <link href="<?= base_url().'assets/css/icon.css?family=Material+Icons' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/fullcalendar.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/dataTables.bootstrap4.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/select2.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap-datetimepicker.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/plugins/morris/morris.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/jquery.toast.min.css' ?>">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title">Login</h3>
                <div class="account-box">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <a href="#"><img src="assets/img/logo.png" alt="Preadmin"></a>
                        </div>
                        <form action="#">
                            <div class="invalid-feedback d-block text-center my-3 h5" id="login_message"></div>
                            <div class="form-group form-focus mb-0">
                                <label class="focus-label">Username or Email</label>
                                <input class="form-control floating" id="username" type="text">
                            </div>
                            <div class="invalid-feedback d-block mb-2" id="invalid-username"></div>
                            <div class="form-group form-focus mb-0">
                                <label class="focus-label">Password</label>
                                <input class="form-control floating" id="password" type="password">
                            </div>
                            <div class="invalid-feedback d-block mb-2" id="invalid-password"></div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-block account-btn" type="button" id="btn_login">Login</button>
                            </div>
                            <div class="text-center">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="sidebar-overlay" data-reff=""></div>
    <script type="text/javascript" src="<?= base_url().'assets/js/jquery-3.2.1.min.js' ?>"></script>
	<script type="text/javascript" src="<?= base_url().'assets/js/popper.min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/bootstrap.min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/jquery.slimscroll.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/select2.min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/moment.min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/plugins/morris/morris.min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/plugins/raphael/raphael-min.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/app.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/toast.js' ?>"></script>
    <script type="text/javascript" src="<?= base_url().'assets/js/jquery.toast.min.js' ?>"></script>

    <!-- ------------ VALIDATION ------------ -->
    <script src="<?= base_url().'assets/js/custom/login.js' ?>"></script>

</body>

</html>