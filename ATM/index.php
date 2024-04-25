<?php


$host = '127.0.0.1';
$port = 4306;
$dbusername = 'root';
$dbpassword = 'root';
$dbname = 'contact_db';

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname, $port);

$message = [];

// Form 1
if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $numbertr2 = mysqli_real_escape_string($conn, $_POST['numberttr2']);
    $datetime = mysqli_real_escape_string($conn, $_POST['datetime']);
    $email = $_POST['email'];
    
 
    $insert = mysqli_query($conn, "INSERT INTO `userdb`(username,pas,numberttr2, email,date) VALUES('$name','$number','$numbertr2','$email','$datetime')") or die('query failed');
    if ($insert) {
        $message['form1'][] = 'Appointment made successfully!';
    } else {
        $message['form1'][] = 'Appointment failed';
    }
}


// Form 2
if (isset($_POST['submitdb'])) {
    if (isset($_POST["usernamedb"]) && isset($_POST["passworddb"]) && isset($_POST["emaildb"])) {
        $usernamedb = $_POST["usernamedb"];
        $numbertr2 = $_POST['numberttr2'];
        $passworddb = $_POST["passworddb"];
        $emaildb = $_POST["emaildb"];

        $usernameExists = mysqli_query($conn, "SELECT * FROM `userdb` WHERE username='$usernamedb' and pas = '$passworddb' and numberttr2 ='$numbertr2'");
        if (mysqli_num_rows($usernameExists) > 0) {
            header("location:http://localhost/ATM/ATM.php");
    
            $message['form2'][] = 'The account is in the database.';
        } else {
            $message['form2'][] = 'The account is not in the database.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<header ID ="heder" class="heder">
        <h3>ATM</h3>
        
        <a href="#about">ABOUT</a>
        <a href="#log">LOG</a>
        
    </header>

       
    <section id="about" class="about">
<div class="logabout">
    <h2>atm</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam deleniti odit facere. Porro vero, itaque quia recusandae dolores ipsa temporibus sit. Pariatur facere error eligendi veniam dolore eveniet laborum delectus?</p>
</div>

<div class="transbout">
    <h2>our serveses</h2>
    <h3>order</h3>
    <h3>desposit</h3>
    <h3>withdraw</h3>
</div>




    </section>
    
    
    <section id="log" class="log">
    <form class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        
        if (isset($message['form1']) && !empty($message['form1'])) {
            foreach ($message['form1'] as $msg) {
                echo '<p class="message">' . $msg . '</p>';
            }
        }
         
        ?>
        <h3 style="text-shadow: 3px 3px 1px #ededed; text-align: center;">create account</h3>
        <label for="">username</label>
        <input type="text" name="name" require>
        <label for="">password</label>
        <input type="password" name="number" require>
        <label for="">id</label>
        <input type="number" name="numberttr2" require>
        <label for="">email</label>
        <input type="email" name="email"require>
        <label for="">date</label>
        <input type="date" name="datetime" id="">
        <input class ="down" type="submit" name="submit" value="Save" class="btn">
        <p class="removee" style="color: black; cursor: pointer;     transform: translateY(22px);">I have account</p>
    </form>

    <form class="form2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        if (isset($message['form2']) && !empty($message['form2'])) {
            foreach ($message['form2'] as $msg) {
                echo '<p class="message">' . $msg . '</p>';
            }
        }
        ?>
        <h2 style="text-shadow: 3px 3px 1px #ededed; text-align: center;">log in</h2>
        <label for="">username</label>
        <input type="text" name="usernamedb" require >
        <label for="">password</label>
        <input type="password" name="passworddb" require>
        <label for="">id</label>
        <input type="number" name="numberttr2" require >
        <label for="">email</label>
        <input type="email" name="emaildb" require>

        <input class ="down" type="submit" name="submitdb" value="save" class="btn">
        <p class="adde" style="color: black; cursor: pointer; transform: translateY(24px);">I don't have an account</p>
    </form>
    <div class="cover"></div>
    </section>
    <script src="script.js"></script>
</body>
</html>