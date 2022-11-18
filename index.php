<?php
    require 'functions.php';
    $conn = OpenCon();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reactions</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
    if(isset($_SESSION['usuario'])){
        header("Location: main.php");
        
    }
    
    if(isset($_GET['action'])){
        $action = (string) $_GET['action'];
    }
    else{
        $action = '';
    }
    if($action == 'Login'){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST['username'];
            $sql = "SELECT * FROM accounts WHERE matricula='$username'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $user = $result->fetch_array();
                $_SESSION['usuario'] = $user;
                header("Location: main.php");
            }
            else{
                $sql = "SELECT * FROM accounts WHERE email='$username'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $user = $result->fetch_array();
                    $_SESSION['usuario'] = $user;
                    header("Location: main.php");
                }
                else{
                    $error = "Email ou Matricula não registrada!";
                }
            }
        }
        $result -> free_result();
    }

?>

<body>
    <section>
        <div class="login-box">
            <h2>Login</h2>
            <form action="index.php?action=Login" method="POST">
                <div class="user-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div id="button">
                    <input type="submit" value="Submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class"erro">
                    <?=isset($error) ? $error : "";?>
                </div>

            </form>
    </div>
    </section>
    <footer>

    </footer>
</body>
</html>