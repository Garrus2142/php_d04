<?php
	include('auth.php');
	session_start();

	if ($_POST['login'] !== NULL && $_POST['login'] !== ''
		&& $_POST['passwd'] !== NULL && $_POST['passwd']) {
		
		if (auth($_POST['login'], $_POST['passwd']) === TRUE) {
			$logged = TRUE;
			$_SESSION['logged_on_user'] = $_POST['login'];
		}
		else {
			$_SESSION['logged_on_user'] = '';
			echo "ERROR\n";
		}
	}
	else
		echo "ERROR\n";
?>
<?php if ($logged === TRUE) { ?>
<html>
<body>
	<a href="logout.php">Logout</a>
	<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
	<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
</body>
</html>
<?php } ?>