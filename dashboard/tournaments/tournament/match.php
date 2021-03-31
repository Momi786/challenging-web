<?php 
    include '../../../header.php'; 
?>
<?php
$_SESSION['user_id'] = $_SESSION['id'];
$_SESSION['username'] = "Momi";
$matchData = explode('&',$_COOKIE['matchData1']);
$challenge_by = $matchData[0];
$accepted_by = $matchData[1];
unset($_COOKIE['matchData1']);
?>
<div class="container my-5">
    <div class="row">
        <div class="col">
        
            <?php if (empty($_GET['tournament-id']) || is_null($_GET['tournament-id'])) { ?>

                <h1 class="text-center">Tournament ID Missing</h1>
                <p class="text-center">
                    <a href="../" class="btn btn-primary">Go Back To Tournaments...</a>
                </p>

            <?php } else { ?>

                <?php

                include_once '../../../php-apis/db-config.php';
                include_once '../../../php-apis/clean-input.php';

                $logged_in_player_id = $_SESSION['id'];
                $tournament_id = mysqli_real_escape_string($conn, clean_input($_GET["tournament-id"]));

                $sql = "SELECT * FROM tournaments_log WHERE tournament_id = $tournament_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['status'] === 'confirmed' || $row['status'] === 'completed' || $row['status'] === 'tie' || $row['status'] === 'disputed') {

                ?>
                            <h1 class="text-center">Tournament # <?php echo $row['tournament_id']; ?></h1>

                            <h2 class="text-center my-5">
                                <?php echo (($row['game'] === 'fifa_21') ? (strtoupper(str_replace("_", " ", $row['game']))) : (ucwords(str_replace("_", " ", $row['game'])))) . ' - ' . (($row['console'] === 'ps4' || $row['console'] === 'pc') ? (strtoupper($row['console'])) : (ucwords($row['console']))); ?>
                            </h2>

                            <h3 class="text-center my-5">
                                <?php 
                                    $sql = "SELECT * FROM tourney_players WHERE tourney_id = $tournament_id";
                                    $result15 = mysqli_query($conn, $sql);
                                    $countResult5 = mysqli_num_rows($result15);
                                ?>
                                Tournament Amount <?= '($' . ($row['amount'] * $countResult5) . ')' ?>
                            </h3>
                            <table class="table table-borderless fs-4">
                                <tbody>
                                    <tr>
                                        <td class="text-uppercase text-start fw-bold">

                                            <?php

                                            $challenge_by = $challenge_by;

                                            $sql2 = "SELECT * FROM users WHERE id = $challenge_by";
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
                                        <td class="text-center fw-bold">VS</td>
                                        <td class="text-uppercase text-end fw-bold">

                                            <?php

                                            $accepted_by = $accepted_by;

                                            $sql3 = "SELECT * FROM users WHERE id = $accepted_by";
                                            $result3 = mysqli_query($conn, $sql3);

                                            if (mysqli_num_rows($result3) > 0) {
                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                    echo $row3['username'];
                                                }
                                            } else {
                                                echo 'User Not Found!';
                                            }

                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-center">Tournament Date Time</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="3"><?php echo $row['start_date'] . ' ' . $row['start_time'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="3">Game Mode</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="3">

                                            <?php

                                            if (empty($row['game_mode']) || is_null($row['game_mode'])) {
                                                echo 'None';
                                            } else {
                                                echo $row['game_mode'];
                                            }

                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="3">Rules</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="3">

                                            <?php

                                            if (empty($row['rules']) || is_null($row['rules'])) {
                                                echo 'None';
                                            } else {
                                                echo $row['rules'];
                                            }

                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="3">Timestamps</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="3">

                                            <?php

                                            echo 'Created: ' . $row['created_timestamp'] . '<br />';
                                            echo (empty($row['reset_timestamp']) || is_null($row['reset_timestamp'])) ? ('') : ('Reset: ' . $row['reset_timestamp'] . '<br />');
                                            echo (empty($row['reopen_timestamp']) || is_null($row['reopen_timestamp'])) ? ('') : ('Re-Open: ' . $row['reopen_timestamp'] . '<br />');
                                            echo 'Confirmed: ' . $row['confirmed_timestamp'] . '<br />';

                                            ?>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <hr />

                            <?php if ($logged_in_player_id === $challenge_by || $logged_in_player_id === $accepted_by) { ?>

                                <table class="table table-borderless fs-4">
                                    <tbody>

                                        <?php

                                        $sql4 = "SELECT NOW() AS now_timestamp";
                                        $result4 = mysqli_query($conn, $sql4);

                                        if (mysqli_num_rows($result4) > 0) {
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $now_timestamp = $row4['now_timestamp'];
                                            }
                                        } else {
                                            $now_timestamp = '0000-00-00 00:00:00';
                                        }

                                        ?>

                                        <?php if (($row['start_date'] . ' ' . $row['start_time']) > $now_timestamp) { ?>

                                            <tr>
                                                <td class="text-center" colspan="3">Once the Tournament Starts Both Players Will Have One (1) Hour From The Set Tournament Date Time To Report Their Results</td>
                                            </tr>

                                        <?php } else { ?>

                                            <?php

                                            if ($logged_in_player_id === $challenge_by) {
                                                if ((empty($row['challenge_by_claimed_result']) || is_null($row['challenge_by_claimed_result'])) && (empty($row['challenge_by_claim_timestamp']) || is_null($row['challenge_by_claim_timestamp']))) {
                                                    $result_claimed = false;
                                                } else {
                                                    $result_claimed = true;
                                                }
                                            } else {
                                                if ((empty($row['accepted_by_claimed_result']) || is_null($row['accepted_by_claimed_result'])) && (empty($row['accepted_by_claim_timestamp']) || is_null($row['accepted_by_claim_timestamp']))) {
                                                    $result_claimed = false;
                                                } else {
                                                    $result_claimed = true;
                                                }
                                            }

                                            ?>

                                            <?php if ($result_claimed) { ?>

                                                <tr>
                                                    <td class="text-center fs-1 fw-bold" colspan="3">Claimed Results</td>
                                                </tr>
                                                <tr class="text-start">
                                                    <td>
                                                        <span class="text-uppercase fw-bold text-start"><?php echo $row['challenge_by_claimed_result']; ?></span>
                                                        <br />
                                                        <?php echo $row['challenge_by_claim_timestamp']; ?>
                                                    </td>
                                                    <td></td>
                                                    <td class="text-end">
                                                        <span class="text-uppercase fw-bold text-end"><?php echo $row['accepted_by_claimed_result']; ?></span>
                                                        <br />
                                                        <?php echo $row['accepted_by_claim_timestamp']; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3">
                                                        <hr />
                                                    </td>
                                                </tr>

                                                <?php if ($row['status'] === 'completed' || $row['status'] === 'tie' || $row['status'] === 'disputed') { ?>

                                                    <tr>
                                                        <td class="text-center fs-1 fw-bold" colspan="3">The Tournament Has Ended!</td>
                                                    </tr>

                                                    <?php if ($row['status'] === 'completed') { ?>

                                                        <?php
                                                        if ($row['challenge_by_claimed_result'] === 'win') {
                                                            $won_by = $challenge_by;
                                                            $lost_by = $accepted_by;
                                                        } else {
                                                            $won_by = $accepted_by;
                                                            $lost_by = $challenge_by;
                                                        }

                                                        $sql5 = "SELECT * FROM users WHERE id = $won_by";
                                                        $result5 = mysqli_query($conn, $sql5);

                                                        if (mysqli_num_rows($result5) > 0) {
                                                            while ($row5 = mysqli_fetch_assoc($result5)) {
                                                                $won_by_username = $row5['username'];
                                                            }
                                                        } else {
                                                            $won_by_username = 'User Not Found!';
                                                        }

                                                        ?>

                                                        <tr>
                                                            <td class="text-center text-success fs-2 fw-bold" colspan="3">The Tournament Is Won By <?php echo $won_by_username; ?></td>
                                                        </tr>

                                                    <?php } elseif ($row['status'] === 'tie') { ?>
                                                        <tr>
                                                            <td class="text-center text-secondary fs-2 fw-bold" colspan="3">The Tournament Has Ended With A Tie</td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td class="text-center text-danger fs-2 fw-bold" colspan="3">The Tournament Has Ended With A Dispute</td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center  fs-2 fw-bold" colspan="3">
                                                                <input type="hidden" id="is_active_group_chat_window" value="no" />
                                                                <button type="button" name="group_chat" challengeId="<?= $_GET['challenge-id'] ?>" id="group_chat" class="btn btn-warning btn-xs">Group Chat</button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                <?php } ?>

                                            <?php } else { ?>

                                                <tr>
                                                    <td class="text-center fs-1 fw-bold" colspan="3">The Tournament Has Begun!</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-capitalize text-center" colspan="3">You have within one (1) hour from the set Tournament date and time to declare your result. Failing to do so will result in a loss</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <button type="button" class="challenge-result fs-1 text-uppercase btn btn-lg btn-success" data-result="win" data-challenge-id="<?php echo $row['tournament_id']; ?>">I Won</button>
                                                        <button type="button" class="challenge-result fs-1 text-uppercase btn btn-lg btn-danger" data-result="loss" data-challenge-id="<?php echo $row['tournament_id']; ?>">I Lost</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <button type="button" class="challenge-result fs-1 text-uppercase btn btn-lg btn-secondary" data-result="tie" data-challenge-id="<?php echo $row['tournament_id']; ?>">We Tied</button>
                                                        <button type="button" class="challenge-result fs-1 text-uppercase btn btn-lg btn-dark" data-result="no-play" data-challenge-id="<?php echo $row['tournament_id']; ?>">We Didn’t Play</button>
                                                    </td>
                                                </tr>

                                            <?php } ?>

                                        <?php } ?>

                                    </tbody>
                                </table>

                            <?php } else { ?>

                                <p class="text-center fs-4">You Are Not A Part Of This Challenge</p>

                            <?php } ?>

                        <?php } else { ?>

                            <h1 class="text-center">Tournament # <?php echo $row['challenge_id']; ?> Not In Confirmed State</h1>
                            <p class="text-center">
                                <a href="../" class="btn btn-primary">Go Back To Tournament...</a>
                            </p>

                        <?php } ?>

                    <?php } ?>

                <?php } else { ?>

                    <h1 class="text-center">Invalid Tournament ID</h1>
                    <p class="text-center">
                        <a href="../" class="btn btn-primary">Go Back To Tournament...</a>
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