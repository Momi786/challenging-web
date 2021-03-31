<?php 
    include '../../../header.php'; 
    include_once '../../../php-apis/db-config.php';
    include_once '../../../php-apis/clean-input.php';

?>
<?php
$_SESSION['user_id'] = $_SESSION['id'];
$_SESSION['username'] = "Momi";
$loginCorrect = 0;
$logged_in_player_id = $_SESSION['id'];
$tournament_id = mysqli_real_escape_string($conn, clean_input($_GET["tournament-id"]));
?>
<div class="container my-5">
    <div class="row">
        <div class="col">
            <?php 
             
             $sql2 = "SELECT * FROM tourney_players WHERE tourney_id = $tournament_id";
             $result2 = mysqli_query($conn, $sql2);
             $countResult2 = mysqli_num_rows($result2);
             for ($i=0;$i < $countResult2; $i++) {
                 $row23 = mysqli_fetch_assoc($result2);
                 if ($row23['player_id'] == $logged_in_player_id) {
                     $loginCorrect = 1;
                 }
             }
             ?>
            <?php if (empty($_GET['tournament-id']) || is_null($_GET['tournament-id'])) { ?>

                <h1 class="text-center">Tournament ID Missing</h1>
                <p class="text-center">
                    <a href="../" class="btn btn-primary">Go Back To Tournaments...</a>
                </p>

            <?php } elseif($loginCorrect != 1) { ?>

               
                    <p class="text-center fs-4">You Are Not A Part Of This Tournament</p>
                    <p class="text-center">
                        <a href="../" class="btn btn-primary">Go Back To Tournaments...</a>
                    </p>
                <?php } else { ?>
                <?php

                $sql1 = "SELECT * FROM tournaments_log WHERE tournament_id = $tournament_id";
                $result1 = mysqli_query($conn,$sql1);
                $row1 = mysqli_fetch_assoc($result1);

               

                $sql = "SELECT * FROM tourney_players WHERE tourney_id = $tournament_id";
                $result = mysqli_query($conn, $sql);
                $countResult = mysqli_num_rows($result);

                if ( $countResult > 0) {
                        if ($row1['status'] === 'confirmed') {
                ?>

                            <h1 class="text-center">Tournament # <?php echo $row1['tournament_id']; ?></h1>
                            <h2 class="text-center my-5">
                                <?php echo (($row1['game'] === 'fifa_21') ? (strtoupper(str_replace("_", " ", $row1['game']))) : (ucwords(str_replace("_", " ", $row1['game'])))) . ' - ' . (($row1['console'] === 'ps4' || $row1['console'] === 'pc') ? (strtoupper($row1['console'])) : (ucwords($row1['console']))); ?>
                            </h2>
                            <h3 class="text-center my-5">
                                Tournament Amount <?= '($' . ($row1['amount'] * $countResult) . ')' ?>
                            </h3>
                            <table class="table table-borderless fs-4">
                                <tbody>
                                    <?php
                                        $IsLoginmatch = 0;
                                        for($i = 0; $i < $countResult; $i++ ){
                                            $row = mysqli_fetch_assoc($result);
                                        ?>
                                            <?php
                                                if($_SESSION['id'] == $row['player_id']){
                                                    $IsLoginmatch = 1; 
                                                }
                                                if($i%2 == 0){
                                                    echo "<tr>";
                                                }else{
                                                    if($IsLoginmatch == 1){
                                                        echo "<td class='text-center fw-bold'><a href='match.php?tournament-id=".$tournament_id."' class='btn btn-primary matchData'>Go To Match</a></td>";
                                                        $IsLoginmatch = 0; 
                                                    }else{
                                                        echo "<td class='text-center fw-bold'>vs</td>";
                                                    };
                                                }
                                            ?>     
                                            
                                            <td class="text-uppercase text-<?= $i%2 == 0 ? 'start' : 'end' ?> fw-bold" playerId = "<?= $row['player_id'] ?>">

                                                <?php

                                                $playerId = $row['player_id'];

                                                $sql2 = "SELECT * FROM users WHERE id = $playerId";
                                                $result2 = mysqli_query($conn, $sql2);

                                                if (mysqli_num_rows($result2) > 0) {
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                        echo $row2['username'];
                                                    }
                                                } else {
                                                    echo 'User Not Found!';
                                                }

                                                ?>

                                            </td>
                                            <?php 
                                                if($i%2 != 0){
                                                    echo "</tr>";
                                                }
                                            ?>  
                                    <?php } ?>
                                </tbody>
                            </table>

                            <hr/>

                             <h4 class="text-center">
                                Tournament Date Time -
                                <?= $row1['start_date'] . ' ' . $row1['start_time'] ?>
                             </h4>   

                        <?php } else { ?>

                            <h1 class="text-center">Tournament # <?php echo $row['tournament_id']; ?> Not In Confirmed State</h1>
                            <p class="text-center">
                                <a href="../" class="btn btn-primary">Go Back To Tournaments...</a>
                            </p>

                        <?php } ?>


                <?php } else { ?>

                    <h1 class="text-center">Invalid Tournament ID</h1>
                    <p class="text-center">
                        <a href="../" class="btn btn-primary">Go Back To Tournaments...</a>
                    </p>

                <?php } ?>

            <?php } ?>

        </div>
    </div>
</div>

<div id="group_chat_dialog" title="Group Chat Window">
	<div id="group_chat_history" style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">

	</div>
	<div class="form-group">
		<!--<textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>!-->
		<div class="chat_message_area" style="position: relative;">
			<div id="group_chat_message" contenteditable class="form-control">

			</div>
			<div class="image_upload">
				<form id="uploadImage" method="post" action="chat/upload.php">
					<label for="uploadFile"><img src="chat/upload.png" /></label>
					<input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
				</form>
			</div>
		</div>
	</div>
	<div class="form-group mt-2" align="right">
		<button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
	</div>
</div>
<script src="./index1.js"></script>
<style>
    
    #group_chat_message
    {
        width: 100%;
        height: auto;
        min-height: 80px;
        overflow: auto;
        padding:6px 24px 6px 12px;
    }

    .image_upload
    {
        position: absolute;
        top:3px;
        right:3px;
    }
    .image_upload > form > input
    {
        display: none;
    }

    .image_upload img
    {
        width: 24px;
        cursor: pointer;
    }
</style>
<?php include '../../../footer.php'; ?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<script>  
    var matchData1 = $(".matchData").parent().parent().children()[0];
    var matchData1 = $(matchData1).attr('playerId');
    var matchData2 = $(".matchData").parent().parent().children()[2];
    var matchData2 = $(matchData2).attr('playerId');
    console.log(matchData1);
    console.log(matchData2);
    document.cookie = "matchData1="+matchData1+"&"+matchData2+";";

    $(document).ready(function(){
		var challengeId;
        fetch_user();

        setInterval(function(){
            update_last_activity();
            fetch_user();
            update_chat_history_data();
            fetch_group_chat_history();
        }, 5000);

        function fetch_user()
        {
            $.ajax({
                url:"chat/fetch_user.php",
                method:"POST",
                success:function(data){
                    $('#user_details').html(data);
                }
            })
        }

        function update_last_activity()
        {
            $.ajax({
                url:"chat/update_last_activity.php",
                success:function()
                {

                }
            })
        }

        function make_chat_dialog_box(to_user_id, to_user_name)
        {
            var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content += fetch_user_chat_history(to_user_id);
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            $('#user_model_details').html(modal_content);
        }

        $(document).on('click', '.start_chat', function(){
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400
            });
            $('#user_dialog_'+to_user_id).dialog('open');
            $('#chat_message_'+to_user_id).emojioneArea({
                pickerPosition:"top",
                toneStyle: "bullet"
            });
        });

        $(document).on('click', '.send_chat', function(){
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_'+to_user_id).val();
            $.ajax({
                url:"chat/insert_chat.php",
                method:"POST",
                data:{to_user_id:to_user_id, chat_message:chat_message},
                success:function(data)
                {
                    //$('#chat_message_'+to_user_id).val('');
                    var element = $('#chat_message_'+to_user_id).emojioneArea();
                    element[0].emojioneArea.setText('');
                    $('#chat_history_'+to_user_id).html(data);
                }
            })
        });

        function fetch_user_chat_history(to_user_id)
        {
            $.ajax({
                url:"chat/fetch_user_chat_history.php",
                method:"POST",
                data:{to_user_id:to_user_id},
                success:function(data){
                    $('#chat_history_'+to_user_id).html(data);
                }
            })
        }

        function update_chat_history_data()
        {
            $('.chat_history').each(function(){
                var to_user_id = $(this).data('touserid');
                fetch_user_chat_history(to_user_id);
            });
        }

        $(document).on('click', '.ui-button-icon', function(){
            $('.user_dialog').dialog('destroy').remove();
            $('#is_active_group_chat_window').val('no');
        });

        $(document).on('focus', '.chat_message', function(){
            var is_type = 'yes';
            $.ajax({
                url:"chat/update_is_type_status.php",
                method:"POST",
                data:{is_type:is_type},
                success:function()
                {

                }
            })
        });

        $(document).on('blur', '.chat_message', function(){
            var is_type = 'no';
            $.ajax({
                url:"chat/update_is_type_status.php",
                method:"POST",
                data:{is_type:is_type},
                success:function()
                {
                    
                }
            })
        });

        $('#group_chat_dialog').dialog({
            autoOpen:false,
            width:400
        });

        $('#group_chat').click(function(){
			challengeId = $(this).attr("challengeId");
            $('#group_chat_dialog').dialog('open');
            $('#is_active_group_chat_window').val('yes');
            fetch_group_chat_history();
            $('.ui-dialog-titlebar-close').html("x");
            $('.ui-dialog-titlebar-close').css("font-size","10px");
            $('.ui-dialog-titlebar-close').css("color","black");
        });

        $('#send_group_chat').click(function(){
            var chat_message = $('#group_chat_message').html();
            var action = 'insert_data';
            var challenge_Id =  challengeId;
            if(chat_message != '')
            {
                $.ajax({
                    url:"chat/group_chat.php",
                    method:"POST",
                    data:{chat_message:chat_message, action:action , challenge_Id:challenge_Id},
                    success:function(data){
                        $('#group_chat_message').html('');
                        $('#group_chat_history').html(data);
                    }
                })
            }
        });

        function fetch_group_chat_history()
        {
            var group_chat_dialog_active = $('#is_active_group_chat_window').val();
            var action = "fetch_data";
            var challenge_Id = challengeId;
            if(group_chat_dialog_active == 'yes')
            {
                $.ajax({
                    url:"chat/group_chat.php",
                    method:"POST",
                    data:{action:action, challenge_Id:challenge_Id},
                    success:function(data)
                    {
                        $('#group_chat_history').html(data);
                    }
                })
            }
        }

        $('#uploadFile').on('change', function(){
            $('#uploadImage').ajaxSubmit({
                target: "#group_chat_message",
                resetForm: true
            });
        });
        
    });  
</script>