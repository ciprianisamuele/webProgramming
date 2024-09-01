

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    
    <script src="https://kit.fontawesome.com/ba452e23c5.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <style>
      .box{
        max-width: 400px;
        max-height: 600px;
        min-width: 200px;
        min-height: 400px;
        aspect-ratio: 2/3;
        

        position: absolute;
        top: 50%;
        left:50%;
        transform: translate(-50%,-50%);
        border-radius: 10px;
        
      
        box-shadow: 0 0 5px rgba(245, 245, 245, 1);
        border: 1px solid rgb(220,220,220);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 30px;

      }
      .tit{

     

        text-transform: uppercase;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: xx-large;
        font-weight: 500;
        height: 20%;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid black;
        width: 100%;
      }
      form{
  
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: left;
        
        width: 100%;
        height: 50%;
        margin-top: 20px;
        /*border: 1px solid black;*/
     
      }
      input[type=password]{
        width: 100%;
        height: 25px;
        border-radius: 3px;
        border: 1px solid grey;
        margin-bottom: 20px;
      }
      input[type=email]{
        width: 100%;
        height: 25px;
        border-radius: 3px;
        border: 1px solid grey;
        margin-bottom: 20px;
      }
      input[type=submit]{
        width: 102%;
        height: 35px;
        border-radius: 10px;
        border: none;
        margin-top: 20px;

        

      }

      
    </style>

    <section class="box">
            <span class = "tit">Accedi</span>

            <form method="post">
                
                <label for="email">Enter Your Email:</label> <input id="email" name="email-log" type="email" required />
                <label for="new-password">Create a New Password:</label> <input id="new-password" name="new-password-log" type="password"  required />
                <span class = "remember"><label for="remember-me">Ricordami</label><input type = "checkbox" name = "remember-me"></span>
                <input type ="submit" value="Accedi" name = "login">
            </form>
            <span> Non sei ancora registrato? <span class = "change-log" onclick="changeLog('reg')">Registrati</span></span>

    </section>




  </body>
</html>