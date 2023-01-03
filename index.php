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
                <div class="msg left-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                    ></div>
    
                    <div class="msg-bubble">
                        <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                        </div>
    
                        <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                        </div>
                    </div>
                </div>
    
                <div class="msg right-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                    ></div>
    
                    <div class="msg-bubble">
                        <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                        </div>
    
                        <div class="msg-text">
                        You can change your name in JS div!
                        </div>
                    </div>
                </div>
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
</body>
</html>

