<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Join Plant's Notebook to dive into the fascinating world of botany. Access comprehensive tutorials on herbarium specimen creation, plant classification, and identification. Connect with fellow nature enthusiasts and contribute to our growing botanical community. Start your botanical journey with us today!" />
        <meta name="keywords" content="Plant's Notebook login, botany login, herbarium specimen tutorial, plant classification, plant identification, botanical community, botanical education, nature enthusiasts, plant preservation, botanical tools, herbarium techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Become Our Member To Explore The Botany World</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_reg">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="register-form-layout">
                <div class="login-form">

                    <form action="php">

                            <input type="reset" class="word">

                            <h1>
                                Register
                            </h1>

                            <br>

                            <fieldset class="contribute-fieldset">
                                <legend> Personal Info</legend>
                                <div class="contribute-input">
                                    <span class="contribute-form-info">First Name</span>
                                    <input type="text" placeholder="Andrew Yu Rui" maxlength="25" name="First Name" pattern="[A-Za-z\s]+" required="required">
                                </div>

                                
                                <div class="contribute-input">
                                    <span class="contribute-form-info">Last Name</span>
                                    <input type="text" placeholder="Ling"  maxlength="25"  name="Last Name" pattern="[A-Za-z\s]+" required="required">
                                </div>
                            </fieldset>


                            <fieldset class="contribute-fieldset">
                                <legend> Account Info</legend>
                                <div class="contribute-input">
                                    <span class="contribute-form-info">Username</span>
                                    <input type="text"  maxlength="25" placeholder="Leoooooooo" name="Username" pattern="[A-Za-z\s]+" required="required">
                                </div>

                                <div class="contribute-input">
                                    <span class="contribute-form-info">Email</span>
                                    <input type="email" placeholder="abc@gmail.com" name="Email"  required="required">
                                </div>

                                <div class="contribute-input">
                                    <span class="contribute-form-info">Password</span>
                                    <input type="password"  maxlength="25" placeholder="abcdefg" name="Password" pattern="[A-Za-z\s]+" required="required">
                                </div>

                                <div class="contribute-input">
                                    <span class="contribute-form-info">Confirm Password</span>
                                    <input type="password"  maxlength="25" placeholder="abcdefg" name="Password_Confirm"  pattern="[A-Za-z\s]+" required="required">
                                </div>
                            </fieldset>

                            <button type="submit" class="contribute-btn">
                                Register
                            </button>

                            <div class="register-link">
                                <p>Already have the account!<a href="login.php">Login</a></p>
                            </div>
                    </form>

                </div>
            </div>

            <figure class='going-up-container'>
                <a href='#top_reg'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>
            
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_reg'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>


    </body>
    
</html>