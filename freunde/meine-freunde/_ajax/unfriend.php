<?php
	include_once '../../../includes/db_connect.php';
	include_once '../../../includes/functions.php';
	
	secure_session_start();
	if(login_check($mysqli) == true){
		if(isset($_POST['friend'], $_POST['uid']) && $_POST['uid'] == $_SESSION['username']){
			if($stmt = $mysqli->prepare("DELETE FROM freunde WHERE (uid = ? AND friend = ?) OR (uid = ? AND friend = ?)")){
				$stmt->bind_param('ssss', $_POST['uid'], $_POST['friend'], $_POST['friend'], $_POST['uid']);
				$stmt->execute();
				if($stmt->affected_rows > 0){
					echo success(["message"=>"Freundschaft gekündigt. Die Antworten bleiben erhalten, solltest du dich umentscheiden"]);
				} else {
					echo error('internalError', 500, 'Could not delete friend association');
				}
			} else {
				echo error('internalError', 500, 'Could not initiate SQL');
			}
		} else {
			echo error('clientError', 400, 'Bad Request');	
		}
	} else {
		echo error('clientError', 403, 'Forbidden');
	}
?>