<?php
include 'db_insert.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./npm/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <title>CRUD PHP</title>
    <style>
        .req {
            color:red;
        }
        .alert {
            position: absolute;
            right: 10px;
            bottom: 150px;
        }
        body {
            background-color: #EEE;
        }
        .added {
            animation-name: fade;
            animation-duration: 8s;
            animation-iteration-count: 1;
        }
        
        @keyframes fade {
            0% {opacity:0;}
            25% {opacity:.5;}
            50% {opacity:1;}
            60%{opacity:1}
            70%{opacity:1}
            80%{opacity:.4}
            90%{opacity:.2}
            100%{opacity:0}
        }
    </style>
</head>
<body>
    <p class="h2 w-50 mx-auto mt-5">User Registration Form</p>
    <p class="w-50 mx-auto">please fill this form and submit to add user record to database</p>

    <form action="<?php $_PHP_SELF?>" method="post"  class="w-50 mx-auto mt-4">
        <!-- Name -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label h6">Name</label>
            <span class="req">* <?php if (isset($_REQUEST['submit'])) {echo $nameErr;}?></span><br>
            <input type="text" name="name" class="form-control" id="InputName" value="<?php echo $userName;?>">
        </div>
        
        <!-- Email -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label h6">Email address</label>
            <span class="req">* <?php if (isset($_REQUEST['submit'])) {echo $emailErr;}?></span><br>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $userEmail;?>">
        </div>
        
        <!-- Gender -->
        <div class="form-check">
            <p class="h6 d-inline">Gender</p>
            <span class="req">* <?php if (isset($_REQUEST['submit'])) {echo $genderErr;}?></span><br>
            <label class="form-check-label">
                Male
                <input class="form-check-input" type="radio" name="gender" value="M" <?php if (isset($userGender) && $userGender=="M") echo "checked";?>>
            </label>
            <br>
            <label class="form-check-label">
                Female
                <input class="form-check-input" type="radio" name="gender" value="F" <?php if (isset($userGender) && $userGender=="F") echo "checked";?>>
            </label>
        </div>
        <br>
        
        <!-- Email US-->
        <div class="mb-3 form-check">
            <input type="checkbox" name="agree" class="form-check-input" id="exampleCheck1" <?php if($mailStatus == "yes") echo "checked";?>>
            <label class="form-check-label" for="exampleCheck1">Recieve Emails From Us</label>
        </div>

        <div class="row justify-space-between">
            <input type="submit" id="sub-btn" value="Submit" name='submit' class="btn btn-primary w-25">
            <a href="show.php" class='btn btn-info mt-4'>Show all users</a>
        </div>
    </form>

    <div class="alert alert-success alert-dismissible fade w-25 ms-auto" role="alert">
        <button type="button" class="close btn btn-success px-2 py-1" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Done</strong>, user added sucessfully.
    </div>

<script src="./npm/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    setTimeout(() => {
        document.querySelector('.added').classList.add('fade');
    }, 4000);
</script>
</body>
</html>