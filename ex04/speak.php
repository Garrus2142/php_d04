<?php
	session_start();

	function addMessage($login, $msg) {
		if (file_exists("../private") === FALSE)
			mkdir('../private');

		if (($file = fopen("../private/chat", 'c+')) !== FALSE && flock($file, LOCK_EX) === TRUE) {

			if (file_exists("../private/chat") === TRUE)
				$content = unserialize(file_get_contents("../private/chat"));
			else
				$content = array();
			
			$content[] = array(
				'login' => $login,
				'time' => time(),
				'msg' => $msg
			);

			file_put_contents("../private/chat", serialize($content));
			flock($file, LOCK_UN);
			fclose($file);
		}
	}

	if ($_SESSION['logged_on_user'] !== NULL && $_SESSION['logged_on_user'] !== '') {
		$logged = TRUE;
		if ($_POST['msg'] !== NULL && $_POST['msg'] !== '' && $_POST['submit'] === 'OK') {
			
			addMessage($_SESSION['logged_on_user'], $_POST['msg']);
		}
	}
	else
		echo "ERROR\n";
?>
<?php if ($logged === TRUE) {?>
<html>
<head>
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>
<body>
	<form method="post">
		<input type="text" name="msg" />
		<input type="submit" name="submit" height="100%" width="100%" value="OK" />
	</form>
</body>
</html>
<?php } ?>