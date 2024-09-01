<?php


session_start();
include("connections.php");
include("functions.php");



?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel  = "stylesheet" href = e-comm.css>
    <script src="https://kit.fontawesome.com/ba452e23c5.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
        Ecommerce
    </header>
    <nav>

        
        <ol id="main-nav">
                
            <li><span class="prova"><a href="e-comm.php">Home</a></span></li>
            <li><span class="prova"><a href="#">Our team</a></span></li>
            <li><span class="prova"><a href="#">Projects</a></span></li>
            <li><span class="prova"><a href="#">Contact</a></span></li>
           
                
                
        </ol>

        <div id = "query">
            <input type="search" id="q" placeholder="Search here" />
            <span class="fa-solid fa-magnifying-glass"></span>
        </div>
        
        <ol id = "second-nav">
            <li><span class="prova"><a href="#">Assistenza</a></span></li>
            <li class="prova" id = "accedi"><a  onclick= "accediFunction('<?php echo $_SESSION['nav_link'] ?>')"> <?php echo $_SESSION['nav'] ?> <i class="fa-solid fa-caret-down"></i> </a> </li>
            <li id = "cart" ><span class="prova"><a href="checkout.html"><i class="fa-solid fa-bag-shopping"></i>Cart<span class = "quantity">0</span></a> 
            </span></li>
        </ol>
    </nav>
        
    <main class = "checkout">
        
        <section class = "cart-checkout">
            <div class="cart-menu-checkout">
                <span class="left-cart">Carrello </span>

                <div class="right-cart">
                <span class= "right-cart-seleziona">Seleziona tutto</span>
                <label class="checkbox">

                    
                    <input type = "checkbox" class = "chec" checked = "true" id = "selected" onchange = "selectAll()"/>
                    <span class="checkmark"></span>
                    <i class="fa-solid fa-square-check" id = "checkk"></i>
                    
                </label>
                </div>


            </div>
            

            <div class = "cart-list">

            </div>
            <span class = "add-to-cart-menu">Aggiungi al carrello</span>
            <div class = "add-to-cart">


            </div>

        </section>
        <section class = "payment-checkout">
            <span class = "tit">Riepilogo ordine</span>
            <div class ="first-line">
                <span class = "tot-article">Totale (0 articoli)</span>
                <span class="cart-price">0</span>
            </div>

            <span class="continue-checkout"><a href="#">Procedi all'ordine</a></span>

        </section>

    </main>



    <script src = "checkout.js">
        


    </script>
    <script src = "e-comm.js">


</script>
  </body>

</html>