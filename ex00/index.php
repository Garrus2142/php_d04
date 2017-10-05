<?php
	session_start();

	if ($_GET['submit'] === 'OK') {
		if ($_GET['login'] !== NULL)
			$_SESSION['login'] = $_GET['login'];
		if ($_GET['passwd'] !== NULL)
			$_SESSION['passwd'] = $_GET['passwd'];
	}

	$login = ($_SESSION['login'] !== NULL) ? $_SESSION['login'] : '';
	$passwd = ($_SESSION['passwd'] !== NULL) ? $_SESSION['passwd'] : '';
?>
<html><body>
	<form method="get">
		Identifiant: <input type="text" name="login" value="<?php echo $login ?>"/>
		<br/>
		Mot de passe: <input type="text" name="passwd" value="<?php echo $passwd ?>"/>
		<input type="submit" name="submit" value="OK"/>
	</form>
</body></html>
