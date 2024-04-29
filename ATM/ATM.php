/*start php file*/
<?php
/* start create connect with server and database*/
$host = '127.0.0.1';
$port = 4306;/**/
$dbusername = 'root';/*name of server*/
$dbpassword = 'root';/*password of server*/
$dbname = 'contact_db';/*name of database*/
/*create varibale to connect*/
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname, $port);
/*create varibale to API message*/
$message = [];

 /* end create connect with server and database*/
/*start order file*/
// form tr
if(isset($_POST['submittr'])) {
    
    $nametr = mysqli_real_escape_string($conn, $_POST['nametr']);
    $numbertr = mysqli_real_escape_string($conn, $_POST['numberttr']);
    $numbertr2 = mysqli_real_escape_string($conn, $_POST['numberttr2']);
    $datetimetr = mysqli_real_escape_string($conn, $_POST['datetimetr']);

    // Check if the user exists in the userdb tables
    //$insert = mysqli_query($conn, "INSERT INTO `userdb`(username,numberttr2,bankaccount, email,) VALUES('$nametr','$numbertr','$numbertr2','$datetimetr')") or die('query failed');
    #if safe
        // User exists, proceed with inserting data into datatr table
        $updateQuery = mysqli_query($conn, "UPDATE userdb SET bankaccount = bankaccount + $numbertr2 WHERE username = '$nametr' AND numberttr2 = '$numbertr'");
        $insert = mysqli_query($conn, "INSERT INTO datatr (nametr, numbrttr, numbrttr2, date) VALUES ('$nametr','$numbertr','$numbertr2','$datetimetr')") or die('Query failed');
        
        if ($insert) {
            $message['formtr'][] = "Order made successfully! <div class='MESSAGE '>
            <H3>name: $nametr</H3>
            <H3>ID: $numbertr</H3>
            <H3>mony: +$$numbertr2 </H3>
            <H3> DATE: $datetimetr</H3>
        </div>";
        
        } else {
            $message['formtr'][] = 'Failed to insert data into datatr table';
        } 
         $usernameExists = mysqli_query($conn, "SELECT * FROM `userdb` WHERE username='$nametr'  and numberttr2 ='$numbertr'");
       
         if (mysqli_num_rows($usernameExists) > 0) {
            $message['formtr'][] = 'The account is in the database.';
        } 
        else {
            $message['formtr'][] = 'The account is not in the database.';
        }
        
    
    }
/*end order file*/
/* Start Deposit file*/
// form ds
if(isset($_POST['submitds'])){

    $nameds = mysqli_real_escape_string($conn, $_POST['nameds']);
    $numberds = mysqli_real_escape_string($conn, $_POST['numbertds']);
    $numberds2 = mysqli_real_escape_string($conn, $_POST['numbertds2']);
    $datetimeds = mysqli_real_escape_string($conn, $_POST['datetimeds']);
    
    
 // Check if the user exists in the userdb table
 $userExistsQuery = mysqli_query($conn, "SELECT * FROM userdb WHERE username = '$nameds'  and numberttr2 = '$numberds'");
 if (mysqli_num_rows($userExistsQuery) > 0) {
    // User exists, proceed with updating the bank account
    $userRow = mysqli_fetch_assoc($userExistsQuery);
        $currentBalance = $userRow['bankaccount'];
        $remainingBalance = $currentBalance + $numberds2;
    // Update the bank account with additional value
    $updateQuery = mysqli_query($conn, "UPDATE userdb SET bankaccount = bankaccount + $numberds2 WHERE username = '$nameds' AND numberttr2 = '$numberds'");
    $insert = mysqli_query($conn, "INSERT INTO datatds (nameds, numbertds, numbertds2, date) VALUES ('$nameds','$numberds','$numberds2','$datetimeds')") or die('Query failed');
    if ($updateQuery) {
        $message['formds'][] = "Deposit made successfully!
        <div class='MESSAGE '>
            <p>name: $nameds</p>
            <p>ID: $numberds</p>
            
            <p>How money you had in your bank account $$currentBalance </p>
            <p>amount added to your bank account + $$numberds2</p>
            <p>How much money is in your bank account: $$remainingBalance</p>
            <p> DATE: $datetimeds</p>
        </div>";
    } else {
        $message['formds'][] = 'Failed to update bank account';
    }
} else {
    $message['formds'][] = 'User does not exist in the database';
}
}
/* end  Deposit file*/

/* Start Withdrawal file*/
// form aw
if (isset($_POST['submitaw'])) {
    $nameaw = mysqli_real_escape_string($conn, $_POST['nameaw']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $numberaw = mysqli_real_escape_string($conn, $_POST['numbertaw']);
    $numberaw2 = mysqli_real_escape_string($conn, $_POST['numbertaw2']);
    $datetimeaw = mysqli_real_escape_string($conn, $_POST['datetimeaw']);

    // Check if the user exists in the userdb table
    $userExistsQuery = mysqli_query($conn, "SELECT * FROM userdb WHERE username = '$nameaw' AND pas = $password AND numberttr2 = '$numberaw'");
    if (mysqli_num_rows($userExistsQuery) > 0) {
        // User exists, proceed with updating the bank account

        $userRow = mysqli_fetch_assoc($userExistsQuery);
        $currentBalance = $userRow['bankaccount'];
        $remainingBalance = $currentBalance - $numberaw2;
        if ($currentBalance >= $numberaw2) {
            // Sufficient balance, proceed with the withdrawal

            // Update the bank account with the deducted value
            $updateQuery = mysqli_query($conn, "UPDATE userdb SET bankaccount = bankaccount - $numberaw2 WHERE username = '$nameaw' AND numberttr2 = '$numberaw'");
            $insert = mysqli_query($conn, "INSERT INTO datataw (nameaw,password, numbertaw, numbertaw2, date) VALUES ('$nameaw','$password','$numberaw','$numberaw2','$datetimeaw')") or die('Query failed');
            if ($updateQuery) {
                $message['formaw'][] = "Withdrawal made successfully!;
    <div class='MESSAGEaw '>
        
        <p>Name: $nameaw</p>
        
        <p>ID: $numberaw</p>
        <p>How money you had in your bank account $$currentBalance </p>
        <p>money withdrawn from your bank account - $$numberaw2</p>
        <p>How much money is in your bank account $$remainingBalance</p>
        <p>Date: $datetimeaw</p>
    </div>";
            } else {
                $message['formaw'][] = 'Failed to update bank account';
            }
        } else {
            // Insufficient balance
            $message['formaw'][] = 'Insufficient balance in the account';
        }
    } else {
        $message['formaw'][] = 'User does not exist in the database';
    }
}
 /* end Withdrawal file*/
#if asve
 /* end php file*/
?>
/*Start html file*/
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
  /* some edit with css*/
  <style>
    section{
        height: 29rem;
        margin: 132px auto  ;
    }
    form{
        height: 87%;
    }
    input.down{
        transform: translateY(18px);
    }
    .MESSAGE{
        height: 20rem;
        width: 23rem;
        border-radius: 5px;
        background-color: rebeccapurple;
        
        position: absolute;
        transform: translate(30rem, 20%)  scaleX(0);
        opacity: 0;
        animation: identifier 1s  forwards ;
        display: grid;
        justify-content: center;
        align-items: center;
        grid-template-columns: 100%;
        
        grid-template-rows: repeat(6,16.6%);
        box-shadow: 3px 3px 1px 0px black;
        
    }
    .MESSAGEaw{
        height: 22rem;
        width: 23rem;
        border-radius: 5px;
        background-color: rebeccapurple;
        
        position: absolute;
        transform: translate(30rem, 20%)  scaleX(0);
        opacity: 0;
        animation: identifier 1s  forwards ;
        display: grid;
        justify-content: center;
        align-items: center;
        grid-template-columns: 100%;
        
        grid-template-rows: repeat(6,16.6%);
        box-shadow: 3px 3px 1px 0px black;
        
    }
    
    @keyframes identifier {
        from {
            transform: translate(30rem, 20%)   scaleX(0.5);
           opacity: 0.4;
        }

        to {
            transform: translate(30rem, 20%)  scaleX(1.5);
           opacity: 1;
        }
    }

    .tes{
    display: flex;
    justify-content: space-evenly;
    position: absolute;
    /* bottom: 74PX; */
    height: 32rem;
    width: 6rem;
    left: 17px;
    border-radius: 23px 271px;
    text-align: center;
    background-color: var(--back-color);
    flex-direction: column;
    flex-wrap: nowrap;
    /* transform: translateY(-36rem); */
    /* top: 10px; */
    margin: 0px;
    transform: scaleX(0) translate(-18px,29px);

    }
    .tes.tes.visible{
        transform: scaleX(1) translate(-18px,29px);
    }
    
    .find{
       
    position: sticky;
    left: 17px;
     border-radius:116px 23px; 
    text-align: center;
    background-color: var(--back-color);
    /* transform: translateY(-36rem); */
    top: 10px;
    height: 24px;
    width: 32px;
    
    top: 5px;
    transform: translateY(16px);
    }
    .cover{
        width: 47%;
    }
    .tes a{
        position: relative;
    }
    ::selection {
    background-color: #ededed;
    color: black;
}
    /* Original CSS rules here */

@media screen and (max-width: 768px) {
    /* Apply rules for screens smaller than 768 pixels in width */
    header {
        /* Modify properties for the header element in the media query */
        height: 3rem;
    }

    section {
        /* Modify properties for the section element in the media query */
        height: 20rem;
        width: 90%;
    }

    /* Continue modifying properties for other elements as needed */
}

@media screen and (max-width: 480px) {
    /* Apply rules for screens smaller than 480 pixels in width */
    header {
        /* Modify properties for the header element in the media query */
        height: 2rem;
    }

    section {
        /* Modify properties for the section element in the media query */
        height: 15rem;
        width: 90%;
    }

    /* Continue modifying properties for other elements as needed */
}


  </style>
<header ID ="heder" class="heder">
 /* hedar section*/
        <h3>ATM</h3>
        <a href="">home</a>
        <a href="#about">ABOUT</a>
        <a href="#index.php">LOG</a>
        <a href="#order">order</a>
        <a href="#desposit">desposit</a>
        <a href="#withdraw">withdraw</a>
    </header>
 /*end hedar section*/
    <div class="find"><div class="tes">
        <a href="#heder">home</a>
        
        <a href="#about">ABOUT</a>
        <a href="index.php">LOG</a>
        <a href="#order">order</a>
        <a href="#desposit">desposit</a>
        <a href="#withdraw">withdraw</a>
    </div></div>
    
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
    
    <section class="order" id="order">
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        
        if (isset($message['formtr']) && !empty($message['formtr'])) {
            foreach ($message['formtr'] as $msg) {
                echo '<p class="message">' . $msg . '</p>';
            }
        }
         
        ?>
        <h2 class="c"> make your order</h2>
        <label for="">username</label>
        <input type="text" name="nametr" require>
        <label for="">id</label>
        <input type="number" name="numberttr" require>
        <label for="">mony</label>
        <input type="number" name="numberttr2"  require>
        <label for="">date</label>
        <input type="date" name="datetimetr" id="">
        <input class="down" type="submit" name="submittr" value="Save" >
        
    </form>
    </section>
    <section class="desposit" id="desposit">
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        
        if (isset($message['formds']) && !empty($message['formds'])) {
            foreach ($message['formds'] as $msg) {
                echo '<p class="message">' . $msg . '</p>';
            }
        }
         
        ?>
        <h2 class="c"> make your desposit</h2>
        <label for="">username</label>
        <input type="text" name="nameds" require>
        <label for="">id</label>
        <input type="number" name="numbertds" require>
        <label for="">mony</label>
        <input type="number" name="numbertds2"  require>
        <label for="">date</label>
        <input type="date" name="datetimeds" id="">
        <input class="down" type="submit" name="submitds" value="Save" >
        
    </form>
    </section>
    <section class="withdraw" id="withdraw">
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        
        if (isset($message['formaw']) && !empty($message['formaw'])) {
            foreach ($message['formaw'] as $msg) {
                echo '<p class="message">' . $msg . '</p>';
            }
        }
         
        ?>
        <h2 class="c"> make your withdraw </h2>
        <label for="">username</label>
        <input type="text" name="nameaw" require>
        <label for="">password</label>
        <input type="password" name="password" id="" require>
        <label for="">id</label>
        <input type="number" name="numbertaw" require>
        <label for="">mony</label>
        <input type="number" name="numbertaw2"  require>
        <label for="">date</label>
        <input type="date" name="datetimeaw" id="">
        <input class="down" type="submit" name="submitaw" value="Save" >
        
    </form>
    
    </section>
    
    
    <script src="script.js"></script>
    <!--java script-->
    <script>let find = document.querySelector('.find');
let tes = document.querySelector('.tes')

find.addEventListener('click', () => {
    tes.classList.add('visible');
});
tes.addEventListener('click', () => {
    tes.classList.remove('visible');
});

</script>
</body>

</html>
