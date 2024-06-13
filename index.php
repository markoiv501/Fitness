<?php
	ob_start();
	require_once 'config.php';
?>
	
<html>
  <head>
    <title>Log in</title>
    <link rel="stylesheet" href="general.css" />
    <link rel="stylesheet" href="style-index.css" />
	<style>
		
		
	</style>
  </head>
  <body>
	
    <div class="login-section">
      <div class="left-side">
        <div class="admin-dash">
          <ion-icon name="ellipse"></ion-icon>
          <p>Administratorska kontrolna tabla</p>
        </div>
        <div class="login-form">
          <h1>Log in</h1>
          <p class="welcome-msg">Dobrodošli Fitness. Molimo Vas unesite svoje podatke.</p>
          <form method="POST">
            <p>Korisničko ime</p>
            <input type="text" name="username" placeholder="admin"><br /><br />
            <p>Šifra</p>
            <input type="password" name="password" placeholder="admin123"><br /><br />
			
            <button class="btn btn-signin" type="submit" value="login" >Prijava</button>
          </form><br>

		<?php
	
		if(isset($_SESSION['error'])){
			echo $_SESSION['error'] . "<br>";
			unset($_SESSION['error']);
		}
		



		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = $_POST['username'];
			$password = $_POST['password'];
			

			$sql = "SELECT admin_id, password FROM admins WHERE username = ?";

			$run = $conn -> prepare($sql);
			$run->bind_param("s", $username);
			$run -> execute();

		//	$results = $run->get_result();
		// zamjena
			$run->bind_result($admin_id, $admin_password);

if ($run->fetch()) {
    // Provjerite lozinku
    if (password_verify($password, $admin_password)) {
        $_SESSION['adminov_id'] = $admin_id;
        header('location: admin_dashboard.php');
        exit;
    } else {
        $_SESSION['error'] = "<p class ='error-msg'>Pogrešna šifra.</p>";
        header('location: index.php');
        exit;
    }
} else {
    $_SESSION['error'] = "<p class ='error-msg'>Pogrešno ime.</p>";
    header('location: index.php');
    exit;
}

$run->close();
			
			// kraj zamjene
			
			
			$conn->close();

			if($username == '' && $password == ''){
				$_SESSION['error'] = "<p class ='error-msg'>Input Username and Password.</p>";
				header('location: index.php');
				exit;
			
			}elseif ($username == ''){
				$_SESSION['error'] = "<p class ='error-msg'>Input Username.</p>";
				header('location: index.php');
				exit;
			} elseif ($password == ''){
				$_SESSION['error'] = "<p class ='error-msg'>Input Password.</p>";
				header('location: index.php');
				exit;
				
			} elseif($results->num_rows == 1){
				$admin = $results->fetch_assoc();

				if(password_verify($password, $admin['password'])) {
					$_SESSION['adminov_id'] = $admin['admin_id'];
					header('location: admin_dashboard.php');
			
	
					
				} else {
					$_SESSION['error'] = "<p class ='error-msg'>Incorect Password.</p>";
					header('location: index.php');
					exit;
				}
			} else {
				$_SESSION['error'] = "<p class ='error-msg'>Incorect Username.</p>";
				header('location: index.php');
				exit;

				
			}
			
		}

		

		
		?>
		
		

        </div>
		
        <div class="copyright">
          <p>© Fitness 2023</p>
        </div>
      </div>
      <div class="right-side">
        <img class="logo" src="logo/logo_with_shadow.png" alt="" />
      </div>
    </div>
	

    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
