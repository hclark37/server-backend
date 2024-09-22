<?php 
session_start();
$cooldownTime = 1;

$commentFile = './comments.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['comment'])) {
	if (isset($_SESSION['last_comment_time']) && (time() - $_SESSION['last_comment_time']) < $cooldownTime) { //checks to see if last post set or if less than that time 
		echo "You must wait before posting another comment. <a href='index.php'>Go back.</a>";
		exit();
	} else { //post condition 
		if (!empty($_POST['poster'])) {
			$poster = htmlspecialchars($_POST['poster']); //if poster is given. 
		}  else {
			$poster = "Anonymous";
		}
		$comment = ($_POST['comment']);
		file_put_contents($commentFile, "[" . date("Y-m-d H:i:s") . "]" . " " . substr($poster, 0, 15) . ": " . PHP_EOL . substr($comment, 0, 400) . PHP_EOL, FILE_APPEND);
		$_SESSION['last_comment_time'] = time();
	}
}

header("Location: index.php");
exit();
?>
