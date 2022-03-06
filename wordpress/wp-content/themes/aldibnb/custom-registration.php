<?php
/* Template Name: Custom Registration Page */
get_header();
global $wpdb;

if ($_POST) {

    $username = $wpdb->escape($_POST['txtUsername']);
    $email = $wpdb->escape($_POST['txtEmail']);
    $password = $wpdb->escape($_POST['txtPassword']);
    $ConfPassword = $wpdb->escape($_POST['txtConfirmPassword']);

    $error = array();
    if (strpos($username, ' ') !== FALSE) {
        $error['username_space'] = "Username has space";

    }

    if (empty($_POST['txtUsername']) || strlen(trim($_POST['txtUsername']))==0) {
        $error['username_empty'] = "empty user";
        echo $username;
    }

    if (username_exists($username)) {
        $error['username_exists'] = "Username already exists";
    }

    if (!is_email($email)) {
        $error['email_valid'] = "Email has no valid value";
    }

    if (email_exists($email)) {
        $error['email_existence'] = "Email already exists";
    }

    if (strcmp($password, $ConfPassword) !== 0) {
        $error['password'] = "Password didn't match";
    }

    if (count($error) == 0) {
        wp_create_user($username, $password, $email);
        echo "User Created Successfully";
        exit();
    }else{
        
        print_r($error);
        
    }
}
?>

<header>
       <div class="header__main">
        <div class="header__titles">        
            <h1>Votre inscription en deux cliques</h1>

            <form method="post" class="registration__form">

                <div>
                <label for="txtUsername">Enter username</label>
                <input type="text" name="txtUsername" id="txtUsername">
                </div>

                <div>
                <label for="txtEmail">Enter Email</label>
                <input type="email" name="txtEmail" id="txtEmail">
                </div>

                <div>
                <label for="txtPassword">Enter Password</label>
                <input type="password" name="txtPassword" id="txtPassword">
                </div>

                <div>
                <label for="txtConfirmPassword">Confirm Password</label>
                <input type="password" name="txtConfirmPassword" id="txtConfirmPassword">
                </div>


                <input type="submit" name="btnSubmit">

</form>
    
        </div>
        <div class="header__image">
            <img class="header__image" src="https://images.unsplash.com/photo-1581677787971-4d36fd7a1d35?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2232&q=80" alt="">
        </div>
    </div>

  </header>

<?php get_footer() ?>