<?php
	session_start();
	
	if ($_SESSION['logged_on_user'] !== NULL && $_SESSION['logged_on_user'] !== '') {
		if (file_exists("../private/chat") === TRUE) {
			$messages = unserialize(file_get_contents("../private/chat"));
			date_default_timezone_set("Europe/Paris");

			if ($message !== FALSE) {
				foreach ($messages as $message) {
					$datef = date("[H:i]", $message['time']);
					$login = $message['login'];
					$msg = $message['msg'];

					echo "$datef <b>$login</b>: $msg<br />\n";
				}
			}
		}
	}
	else
		echo "ERROR\n";
?>