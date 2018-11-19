<?php
include '../database/db_connect.php';
include '../include/header.php';

echo '<h3>Sign up</h3>';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '<form method="post" action="">
        Username: <input type="text" name="username" />
        Password: <input type="password" name="password">
        Password again: <input type="password" name="user_pass_check">
        E-mail: <input type="email" name="email">
        <input type="submit" value="Register" />
     </form>';
}
else
{
    $errors = array();

    if(isset($_POST['username']))
    {
        if(!ctype_alnum($_POST['username']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['username']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }


    if(isset($_POST['password']))
    {
        if($_POST['password'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
    }

    if(!empty($errors))
    {
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value)
        {
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    }
    else
    {
        $user = $_POST['username'];
        $pass_hash = sha1($_POST['password']);
        $email = $_POST['email'];

        $sql = "INSERT INTO users (username, password, email)
                VALUES('$user','$pass_hash','$email')";

        $result = mysqli_query($connection, $sql);
        if(!$result)
        {

            echo 'Something went wrong while registering. Please try again later.';
            //echo mysqli_error($connection);
        }
        else
        {
            echo 'Successfully registered. You can now <a href="../login/login.php">sign in</a> and start posting! :-)';
        }
    }
}

include '../include/footer.php';
?>
