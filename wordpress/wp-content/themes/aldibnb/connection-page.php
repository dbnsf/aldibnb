<?php 
/* Template Name: Connection Page */

get_header();
global $wpdb;

?>
<header>
       <div class="header__main">
        <div class="header__titles">        
            <h1>Connectez-vous</h1>
        <p>Lorem ipsum dolor sit amet, consectetur
            adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et</p>
        </div>
        <div class="header__image">
            <img class="header__image" src="https://images.unsplash.com/photo-1581677787971-4d36fd7a1d35?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2232&q=80" alt="">
        </div>
    </div>
</header>
<div class="connectionFormContainer">
    <div class="connection_form">
        <form method="post" action="<?=home_url('wp-login.php'); ?>">


            <p>
            <label class="emailLabel" for="txtEmail">Adresse email</label>
            <div>
            <input class="emailInput" type="email" name="txtEmail" id="txtEmail"></div>
            </p>

            <p>
            <label class="passwordLabel" for="txtPassword">Mot de passe</label>
            <div>
            <input class="passwordInput" type="password" name="txtPassword" id="txtPassword"></div>
            </p>

            <p>
            <label class="passwordConfirmationLabel" for="txtConfirmPassword">Confirmez votre mot de passe</label>
            <div>
            <input class="passwordConfirmationInput" type="password" name="txtConfirmPassword" id="txtConfirmPassword"></div>
            </p>


            <input class="submitConnection" type="submit" name="btnSubmit">

        </form>
    </div>
</div>
<?php get_footer();?>