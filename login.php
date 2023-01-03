<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="registration.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="content">
        <div class="content-centered">
            <form id="login-form" action="api.php" method="post">
                <h1>Login</h1>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="form-group">
                    Don't have an account? <a href="signup.php">Sign Up</a>
                </div>
            </form>

        </div>
    </div>
    <script>
        function getFormData(form){
            var unindexed_array = form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

        $("#login-form").submit(function(e) {
            e.preventDefault();
            var data = getFormData($(this));
            data.action = 'login';
            $.ajax({
                type: "POST",
                url: "api.php",
                data: data,
                success: function(data) {
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.success) {
                        window.location.href = "/";
                    }
                }
            });
        });
    </script>
</body>
</html>