<?php
	function auth($login, $passwd) {
		$salt = 'cdjuQVscPH';

		if (file_exists("../private/passwd")) {
			$content = file_get_contents("../private/passwd");
			if ($content !== FALSE) {
				$accounts = unserialize($content);
				
				foreach ($accounts as $account) {
					if ($account['login'] === $login
						&& $account['passwd'] === hash('whirlpool', $passwd.$salt)) {

						return (TRUE);
					}
				}
			}
		}
		return (FALSE);
	}
?>