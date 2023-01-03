<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="registration.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Sign Up</title>
</head>
<body>
    <div class="content">
        <div class="content-centered">
        <form id="signup-form" action="api.php" method="post">
            <h1>Sign Up</h1>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image <img id="preview" src="#" alt="Your image" width="100" style="display:none;" /></label>
                <input id="profile_image" type="file" class="form-control" name="profile_image" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
            <div class="form-group">
                Already have an account? <a href="login.php">Login</a>
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

        $('#signup-form').submit(function(e) {
            e.preventDefault();
            var data = getFormData($(this));
            var formData = new FormData();
            formData.append('profile_image', $('#profile_image')[0].files[0]);
            for(key in data) {
                formData.append(key,data[key])
            }
            formData.append('action', 'signup');
            $.ajax({
                    url : 'api.php',
                    type : 'POST',
                    data : formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success : function(data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success) {
                            window.location.href = "/";
                        }
                    }
            });
        })

        // the image preview
        document.getElementById('profile_image').addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
</body>
</html>