<?php

session_start();

include_once 'validation.php';

if(Validation::validate_presence(['email' => $_POST['email']])) { die; }

if(!Validation::validate_email(['email' => $_POST['email']])) { echo'validate email.....'; die; }

if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
        // Proceed to process the form data
        pdostuff();
    } else {
        // Log this as a warning and keep an eye on these attempts
        echo'page expired';
        die;
    }
}


function pdostuff(){

    // init....
    $servername = "localhost";$username = "root";$password = "";$dbname = "exam2";

    // connect then save record
    try {
        // connect.....
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (:email)");
        $stmt->bindParam(':email', $_POST['email']);

        // insert a row
        $email = "sample@example.com";
        $stmt->execute();

        // done....
        echo "congratulations! you subscribed";
    }
    catch(PDOException $e)
    {
        // error message
        echo "Error: " . $e->getMessage();
    }
    $conn = null;


}
