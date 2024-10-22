<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Log in to Plant's Notebook to explore detailed tutorials on herbarium specimen creation and preservation, classify plants, discover new species, and contribute to our botanical community. Join us today!" />
        <meta name="keywords" content="Plant's Notebook login, botany login, herbarium specimen tutorial, plant classification, plant identification, botanical community, botanical education, nature enthusiasts, plant preservation, botanical tools, herbarium techniques" />
        <meta name="author" content=" Andrew Yii Teck Foon"  />
        <title>Plant's Notebook | Login To Discover The Botany World</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>
    
    <body>

        <header id="top_log">
            <?php include 'include/header.php';?>
        </header>

        <article>

            <?php include 'include/chatbot.php';?>

            <div class="login-form-layout">
                <div class="login-form">

                    <form action="php">

                        <h1>
                            Login
                        </h1>

                        <div class="contribute-input">
                            <span class="contribute-form-info">Username</span>
                            <input type="text"  name="Username" maxlength="25" pattern="[A-Za-z\s]+" required="required">
                        </div>

                        <div class="contribute-input">
                            <span class="contribute-form-info">Password</span>
                            <input type="password"  name="Password" maxlength="25" pattern="[A-Za-z\s]+" required="required">
                        </div>

                        <div class="remember-forgot">
                            <label for="remember"><input id="remember" type="checkbox">Remember me </label>
                            <a href="#">Forgot password?</a>
                        </div>

                        <button type="submit" class="contribute-btn">
                            Sign In
                        </button>

                        <div class="register-link">
                            <p>Don't have an account?<a href="registration.php">Register</a></p>
                        </div>

                    </form>

                </div>
            </div>
        </article>


        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_log'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure>

    </body>

</html>