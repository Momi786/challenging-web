<?php
include '../../header.php';
?>

<link rel="stylesheet" href="./index.css">

<div class="hero d-flex align-items-end bg-dark">
    <h1 class="ms-5 text-white display-5 fw-bold">Disputes</h1>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <p class="text-center fw-bold">You don't have disputes</p>
        </div>
    </div>
</div>


<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
                    <table id="example" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Game</th>
                                <th>Amount</th>
                                <th>Dispute Chat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $chal_accep = $_SESSION['id'];
                                $query = "SELECT * from challenges_log where challenge_by_claimed_result='win' AND accepted_by_claimed_result='win' AND challenge_by = '$chal_accep'";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_num_rows($result);
                                for ($i=0; $i < $count ; $i++) { 
                                    $data = mysqli_fetch_assoc($result);
                            ?>
                                <tr>
                                    <td><?= $data['challenge_id']?></td>
                                    <td><?= $data['game']?></td>
                                    <td><?= $data['amount']?></td>
                                   
									<td class="text-center  fs-2 fw-bold" colspan="3">
										<input type="hidden" id="is_active_group_chat_window" value="no"/>
										<button type="button" name="group_chat" challengeId="<?= $data['challenge_id'] ?>"  id="group_chat" class="btn btn-warning btn-xs group_chat">Group Chat</button>
									</td>
                                </tr>

                            <?php
                                    
                                }
                            ?>
                            <?php
                                $chal_accep = $_SESSION['id'];
                                $query = "SELECT * from challenges_log where challenge_by_claimed_result='win' AND accepted_by_claimed_result='win' AND accepted_by = '$chal_accep'";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_num_rows($result);
                                for ($i=0; $i < $count ; $i++) { 
                                    $data = mysqli_fetch_assoc($result);
                            ?>
                                <tr>
                                    <td><?= $data['challenge_id']?></td>
                                    <td><?= $data['game']?></td>
                                    <td><?= $data['amount']?></td>
                                   
									<td class="text-center  fs-2 fw-bold" colspan="3">
										<input type="hidden" id="is_active_group_chat_window" value="no"/>
										<button type="button" name="group_chat" challengeId="<?= $data['challenge_id'] ?>"  id="group_chat" class="btn btn-warning btn-xs group_chat">Group Chat</button>
									</td>
                                </tr>

                            <?php
                                    
                                }
                            ?>
                        </tbody>
                    </table>
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
					<label for="uploadFile"><img src="../challenges/challenge/chat/upload.png" /></label>
					<input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
				</form>
			</div>
		</div>
	</div>
	<div class="form-group mt-2" align="right">
		<button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
	</div>
</div>
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

<?php
include '../../footer.php';
?>


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
                url:"../challenges/challenge/chat/fetch_user.php",
                method:"POST",
                success:function(data){
                    $('#user_details').html(data);
                }
            })
        }

        function update_last_activity()
        {
            $.ajax({
                url:"../challenges/challenge/chat/update_last_activity.php",
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
                url:"../challenges/challenge/chat/insert_chat.php",
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
                url:"../challenges/challenge/chat/fetch_user_chat_history.php",
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
                url:"../challenges/challenge/chat/update_is_type_status.php",
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
                url:"../challenges/challenge/chat/update_is_type_status.php",
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
                    url:"../challenges/challenge/chat/group_chat.php",
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
                    url:"../challenges/challenge/chat/group_chat.php",
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