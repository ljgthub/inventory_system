<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=PT+Serif+Caption&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik+Bubbles&family=Rubik+Distressed&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            box-sizing: border-box;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cont {
            position: relative;
            width: 50%;
            margin: auto;
            width: max-content;
            padding: 40px 30px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            
            border-radius: 10px;
            height: 250px;
        }
        form > input {
            margin-top: 10px;
            margin-bottom: 10px;
            height: 25px;
            width: 300px;
        }
        form {
            height: 100%;
        }
        button {
            position: absolute;
            bottom: 25px; /* Distance from the bottom */
            background-color: #001F3F;
            color: white;
            border-radius: 15px;
            padding: 10px 30px;
            cursor: pointer;
            width: calc(100% - 60px);
        }
        h3 {
            margin-bottom: 40px;
            width: 50%;
            text-align: center;
            margin: auto;
        }
    </style>
</head>
<body>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = "admin";
            $password = "123";

            if (isset($_POST['user'])) {
                $name = $_POST['user'];
            }

            if (isset($_POST['pass'])) {
                $pass = $_POST['pass'];
            }
        

            if ($name == $username && $pass == $password) {
                session_start(); 
                $_SESSION['user'] = $name;
                header("Location: index.php");
            } else {
                $divContent = "Wrong Username or Password";
            }
        }
    ?>

    <div class="cont">
        <form id="login_form" class="item_form_show" action="" method="post">
            <h3>Admin Login</h3><br><br>
            <label for="user">Username: </label><br>     
            <input name="user" autocomplete="off" type="text" require><br>
            <label for="pass">Password: </label><br>
            <input name="pass" autocomplete="off" type="password" require>
            <?php
                if (!empty($divContent)) {
                    echo "<div style='color: red; font-size: 14px; margin-top: -5px;'>$divContent</div><br>";
                }
            ?>
            <br><button>Login</button>
        </form>
    </div>

</body>
</html>