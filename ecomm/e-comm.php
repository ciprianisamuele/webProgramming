
<?php
session_start();
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

include("connections.php");
include("functions.php");

$user_data = checkLogin($con);

echo $_COOKIE['user_token'];

if($user_data){
    $_SESSION['nav']  = $user_data;
    $_SESSION['nav_link'] = "acc";
}
else{
    $_SESSION['nav'] = "Accedi";
    $_SESSION['nav_link'] = "log";
}
$_SESSION['just_reg']= 0;


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //se qualcosa è stato postato
    if(isset($_POST['register'])){
        
        $user_email = $_POST['email-reg'];
        $user_password = $_POST['new-password-reg'];


        if(!empty($user_email) && !empty($user_password)){

            //saves to database
            $user_id = random_num(20);
            
            $query = "insert into users (user_id, email, password, token) values ('$user_id', '$user_email', '$user_password', '-1')";
            
            mysqli_query($con,$query);

        }
        $_SESSION['just_reg'] = 1;

    }
    else{
        $user_email = $_POST['email-log'];
        $user_password = $_POST['new-password-log'];
  
        if(!empty($user_email) && !empty($user_password)){
  
          //saves to database
  
            $query = "select * from users where (email = '$user_email' and password = '$user_password') limit 1";
            
            $result = mysqli_query($con,$query);
    
            if($result && mysqli_num_rows($result)> 0){

                $user_data = mysqli_fetch_assoc($result);
                $user_data_id = $user_data['user_id'];
                
                if(isset($_POST['remember-me'])){
                    
                    $user_token = createToken();
                    setcookie("user_token", $user_token, time() + 86400*30, "/");
                    $query_add = "update users set token = '$user_token'  where user_id= '$user_data_id'";
                    mysqli_query($con,$query_add);
                }
                
                $_SESSION['user_id'] = $user_data_id;
                $_SESSION['just_reg'] = 0;
                
                header('Location: e-comm.php');
                die;
            }
    
            else{
                echo'Password sbagliata o email sbagliata';
            }
        }
    }
  }


?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" type="text/css" href="e-comm.css"> 
    <script src="https://kit.fontawesome.com/ba452e23c5.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
        Ecommerce
    </header>
    <nav>

        
        <ol id="main-nav">
                
            <li class="prova"><a href="#">Home</a></li>
            <li class="prova"><a href="#">Our team</a></li>
            <li class="prova"><a href="#">Projects</a></li>
            <li class="prova"><a href="#">Contact</a></li>
           
                
                
        </ol>

        <div id = "query">
            <input type="search" id="q" placeholder="Search here" />
            <span class="fa-solid fa-magnifying-glass"></span>
        </div>
        
        <ol id = "second-nav">
            <li class="prova"><a href="#">Assistenza</a></li>
            <li class="prova" id = "accedi"><a  onclick= "accediFunction('<?php echo $_SESSION['nav_link']?>')"> <?php echo $_SESSION['nav'] ?> <i class="fa-solid fa-caret-down"></i> </a> </li>
            <li id = "cart" class="prova">
                <a href="checkout.php"><i class="fa-solid fa-bag-shopping"></i>Cart<span class = "quantity">0</span></a>
                
          
            </li>

        </ol>
    </nav>
        

  
        <!-- A Search form is another common non-linear way to navigate through a website. -->

      
    <main>
    <div class = "sidebar">

        <div class = "cart-menu">            
            <span class= "cart-price">0</span>
            <span class = "purchase"><a href = "checkout.php">Procedi all'acquisto</a></span>
        </div>
        
        <div class = "sidebar-in">

            <button class = "remove-all" onclick = "removeAll()"><i class="fa-solid fa-trash"></i></button>

    


            <div class = "cart-content">
                    

            </div>
        </div>
    </div>
    <section class = "sub-account">

        <div class="up">
            <button class = "log" onclick= "accediFunction('<?php echo $_SESSION['nav_link']?>')"> <?php echo $_SESSION['nav'] ?>  </button>

        </div>

        <div class="under">
            <div class="cron">
                <span><a href = "#">Cronologia</a></span>
                <div class = "crono-list">
                    
                </div>



            </div>

            <ol class = "first-menu">

                <li><a href="#">Il mio account</a></li>
                <li><a href="#">I miei ordini</a></li>
                <li><a href="#">Cronologia</a></li>
                <li><a href="#">Consigliati per te</a></li>
                <li><a href="#">Preferiti</a></li>
                <li><a href="#">Sicurezza</a></li>
                <br></br>
                <li><a href="" onclick = "logOut()" >Esci</a></li>
            

            </ol>

        </div>

       

    </section>
    
    
    <div>
        <section class = "container">
            <div class = "shop-content">
         

            </div>


        </section>
    </div>

    <div class="box-log">

    </div>

   

    </main>

    <script src ="e-comm.js"></script> 

    <script> 
        if(<?php echo $_SESSION['just_reg'] ?>){
            $(".box-log").load("http://localhost:80/logg.php .box");
            $('#overlay').show();
        }

        function logOut(){
            
        }
    </script>

   

  </body>
</html>