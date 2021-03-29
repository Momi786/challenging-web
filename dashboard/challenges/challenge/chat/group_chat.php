<?php

//group_chat.php

include("../../../../php-apis/db-config.php");

session_start();

if($_POST["action"] == "insert_data")
{
	$data = array(
		':from_user_id'		=>	$_SESSION["user_id"],
		':chat_message'		=>	$_POST['chat_message'],
		':challenge_id'		=>	$_POST['challenge_Id'],
		':status'			=>	'1'
	);

	$query = "
	INSERT INTO chat_message 
	(from_user_id, chat_message, challenge_id, status) 
	VALUES (:from_user_id, :chat_message, :challenge_id, :status)
	";

	$statement = $conn->prepare($query);

	if($statement->execute($data))
	{
		echo fetch_group_chat_history($conn,$_POST['challenge_Id']);
	}

}

if($_POST["action"] == "fetch_data")
{
	echo fetch_group_chat_history($conn,$_POST["challenge_Id"]);
}

?>