<?php
require_once 'functions.php';
if(!is_user_logged_in()){
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Chat App</title>
</head>
<body>
    <div class="app">
        <div class="greeting">
            <h1>Hello, <?php echo get_the_user()->getUsername();?></h1>
            <img src="<?php echo get_the_user()->getProfileImage();?>" width="100" alt="profile image" style="border-radius:50%;overflow: hidden;width: 100px;height:100px;" >
            <button id="logout-button" >Logout</button>
        </div>
        <div class="msger">
            <div class="msger-header">
                <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> Chat App
                </div>
                <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
                </div>
            </div>
    
            <main class="msger-chat">
            </main>
            <form class="msger-inputarea">
                <input type="text" class="msger-input" placeholder="Enter your message...">
                <button type="submit" class="msger-send-btn">Send</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="app.js"></script>
    <script>
        document.getElementById('logout-button').addEventListener('click', function() {
            $.ajax({
                url: 'api.php',
                type: 'POST',
                data: { action: 'logout' },
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);

                    if (data.success) {
                        window.location.href = '/logout.php';
                    }
                }
            });
        });

    </script>
    <script>
        msgerForm.addEventListener("submit", event => {
            event.preventDefault();

            const msgText = msgerInput.value;
            if (!msgText) return;

            appendMessage("<?php echo get_the_user()->getUsername(); ?>", "<?php echo get_the_user()->getProfileImage(); ?>", "right", msgText);
            msgerInput.value = "";



            // Send the message to the server
            $.ajax({
                url: "api.php",
                type: "POST",
                data: { 
                    action: "send_message",
                    owner_id: <?php echo get_the_user()->getId(); ?> ,
                    content: msgText,
                    timestamp: new Date(),
                 },
                success: function (response) {
                    console.log(response);
                },
            });
            //   botResponse();
        });

    </script>
    <script>
        
    // Make an AJAX request to retrieve the messages from the server
    $.ajax({
        url: '/api.php',
        type: 'POST',
        data: { action: 'get_messages' },
        success: function(data) {
            // Parse the JSON response from the server
            const messages = JSON.parse(data);
            const currentUsername = "<?php echo get_the_user()->getUsername();?>";
            console.log(messages);
            // Iterate over the messages array
            for (const message of messages) {
                // Extract the message information
                const name = message.username;
                const img = message.profile_image;
                const text = message.content;
                const date = new Date(message.timestamp);
                console.log(date);
                const hours = date.getHours();
                const minutes = date.getMinutes();
                const seconds = date.getSeconds();
                const time = hours + ":" + minutes ; 
                // Determine the side of the message based on the current user's username
                const side = (name === currentUsername) ? 'right' : 'left';
                console.log(name, currentUsername);
                // Append the message to the chat box using the appendMessage function
                appendMessage(name, img, side, text, time);
            }
        }
    });
    
    </script>

</body>
</html>

