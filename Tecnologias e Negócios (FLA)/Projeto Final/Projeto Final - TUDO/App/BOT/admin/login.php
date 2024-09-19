<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "inc/settings.php";
    include "inc/db.php";
    db_connect();

?>

<!DOCTYPE html>
<html lang="en">

    <?php

        include "inc/head.php";

    ?>

<body>
	<section class="h-100 mt-5">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
							<form method="POST" action="inc/login.php" class="needs-validation" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Email</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
										
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>
</html>