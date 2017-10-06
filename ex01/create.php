<?php
	$salt = 'cdjuQVscPH';

	function getAccounts() {
		if (file_exists("../private/passwd")) {
			$content = file_get_contents("../private/passwd");
			if ($content !== FALSE) {
				return (unserialize($content));
			}
			else
				return (array());
		}
		return (array());
	}

	function createAccount($accounts, $login, $passwd) {
		if (file_exists("../private") === FALSE)
			mkdir("../private");

		$accounts[] = array(
			'login' => $login,
			'passwd' => hash("whirlpool", $passwd.$salt)
		);

		file_put_contents("../private/passwd", serialize($accounts));
	}

	if ($_POST['login'] !== NULL && $_POST['login'] !== ''
		&& $_POST['passwd'] !== NULL && $_POST['passwd'] !== ''
		&& $_POST['submit'] === 'OK') {

		$accounts = getAccounts();
		
		foreach ($accounts as $account) {
			if ($_POST['login'] == $account['login']) {
				$error = TRUE;
				break;
			}
		}

		if ($error === TRUE)
			echo "ERROR\n";
		else {
			createAccount($accounts, $_POST['login'], $_POST['passwd']);
			echo "OK\n";
		}
	}
	else
		echo "ERROR\n";
?>