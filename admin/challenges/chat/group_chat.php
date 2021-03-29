<?php

//group_chat.php

include('database_connection.php');

session_start();


if($_POST["action"] == "insert_data")
{
	$data = array(
		':admin_id'		=>	"0",
		':chat_message'		=>	$_POST['chat_message'],
		':challenge_id'		=>	$_POST['challenge_Id'],
		':status'			=>	'1'
	);

	$query = "
	INSERT INTO chat_message 
	(admin_id, chat_message, challenge_id, status) 
	VALUES (:admin_id, :chat_message, :challenge_id, :status)
	";

	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		echo fetch_group_chat_history($connect,$_POST['challenge_Id']);
	}

}

if($_POST["action"] == "fetch_data")
{
	echo fetch_group_chat_history($connect,$_POST["challenge_Id"]);
}

?>