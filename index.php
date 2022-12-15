<!DOCTYPE html>
<html lang="es">
	<head>
		<title>TECOLOTE</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Sistema Integral de Autotransporte">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/material-design-iconic-font.min.css" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css?1425466569" />

        <link rel="shortcut icon" href="favicon.ico">
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="img-backdrop" style="background-image: url('assets/img/fondo.jpg')"></div>
			<div class="spacer"></div>
			<div class="card contain-sm style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-10">
							<h1 class="text-xxxxl text-primary">TECOLOTE<br>
              <small class="text-default-light">S. DE R.L. DE C.V.</small></h1>
              <br/>
							<img class="img-circle" src="assets/img/logo.jpg">

              <form class="form floating-label  col-sm-10" action="login.php" accept-charset="utf-8" method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="username" name="usuario" required>
									<label for="username">Usuario</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="pass" required>
									<label for="password">Contrase&ntilde;a</label>
								</div>
								<br/>
								<div class="row">
									<div class="col-xs-12 text-center">
										<button class="btn btn-primary btn-raised" type="submit">Iniciar Sesion</button>
	                  <div class="text-center">
	                    <p><br><br>©2018 Ing. Ricardo J. Villavicencio L.</p>
	                  </div>
									</div><!--end .col -->
								</div><!--end .row -->
							</form>

						</div><!--end .col -->
					</div><!--end .row -->



                        </div>
				</div><!--end .card-body -->
				</div><!--end .card -->
				</section>
				<!-- END LOGIN SECTION -->

				<!-- BEGIN JAVASCRIPT -->
				<script src="assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
        <script src="assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/js/libs/bootstrap/bootstrap.min.js"></script>
        <script src="assets/js/libs/spin.js/spin.min.js"></script>
        <script src="assets/js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
				<script src="assets/js/core/source/App.js"></script>
				<script src="assets/js/core/source/AppForm.js"></script>
        <script src="assets/js/libs/toastr/toastr.js"></script>
				<!-- END JAVASCRIPT -->
        <?php
				session_start();
				if (isset( $_SESSION['ATZacceso']))
				{
					?>
        <script language="javascript">
				toastr.warning('<?php echo $_SESSION['ATZacceso'];?>', 'Hubo un error!',{
					closeButton: true,
					timeOut: 5000,
					});
				</script>
    		<?php
					session_destroy();
				}
				?>

				<!-- BEGIN JAVASCRIPT -->
          <style>
            .clearfix:after,
						form:after {
						    content: ".";
						    display: block;
						    height: 0;
						    clear: both;
						    visibility: hidden;
						}
          </style>
				<!-- END JAVASCRIPT -->

			</body>
		</html>
