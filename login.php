<?php session_start();
include_once('header.php');
?>
	<p>
		<?php
					if(isset($_SESSION['message']) && !empty($_SESSION["message"])){
						echo "<span>" . $_SESSION['message']. "</span>";
						session_destroy();
					}
		?>
	</p>

	Login form Here

	<form method="POST" action="process_register.php">
			<p>
				<?php
					if(isset($_SESSION['error']) && !empty($_SESSION["error"])){
						echo "<span style='color:red'>" . $_SESSION['error']. "</span>";
						session_destroy();
					}
				?>
			</p>
				<label>Email</label><br />
				<input 
				<?php
				if(isset($_SESSION['email'])){
							echo "value=" . $_SESSION['email'];
				}
				?>
				type="text" name="email" placeholder="Email"  />
			</p>
			<p>
				<label>Password</label><br />
				<input 
				type="text" name="password" placeholder="Password"  />
			</p>
<?php include_once('footer.php'); ?>