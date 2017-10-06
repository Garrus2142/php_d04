<?php
	$salt = 'cdjuQVscPH';

	function getAccounts() {
		$content = file_get_contents("../private/passwd");
		if ($content !== FALSE) {
			$content = unserialize($content);
			return ($content === FALSE ? array() : $content);
		}
		return (array());
	}

	if ($_POST['login'] !== NULL && $_POST['login'] !== ''
		&& $_POST['oldpw'] !== NULL && $_POST['oldpw'] !== ''
		&& $_POST['newpw'] !== NULL && $_POST['newpw'] !== ''
		&& $_POST['submit'] === 'OK') {

		$accounts = getAccounts();
		
		$found = FALSE;
		foreach ($accounts as $key => $account) {
			
			if ($_POST['login'] === $account['login']
				&& hash('whirlpool', $_POST['oldpw'].$salt) === $account['passwd']) {
				
				$found = $key;
				break;
			}
		}

		if ($found === FALSE)
			echo "ERROR\n";
		else {
			$accounts[$found]['passwd'] = hash("whirlpool", $_POST['newpw'].$salt);
			file_put_contents("../private/passwd", serialize($accounts));
			echo "OK\n";
		}
	}
	else
		echo "ERROR\n";
?>