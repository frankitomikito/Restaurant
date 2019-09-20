<?php

if(($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost:8000/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;
    
    require 'dbCon.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM tbl_pwdreset WHERE pwdResetEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){

            echo "There was an error !";
            exit();
        }else {
            mysqli_stmt_bind_param($stmt, "s",  $userEmail);
            mysqli_stmt_execute($stmt);      
        }


    $sql = "INSERT INTO tbl_pwdreset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){

        echo "There was an error !";
        exit();
    }else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss",  $userEmail, $selector, $hashedToken, $expires );
        mysqli_stmt_execute($stmt);      
    } 

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        $to = $userEmail;
        $subject = 'Reset your passwords';
        $message = '<p>we receive a passport request</p>';

        $message .= '<p>Here is your password reset link </br>';       
        $message .= '<a href = " '. $url . '">' . $url . '</a></p>';

        $headers = "From: anvic <anvicmosquera0818@gmail.com>\r\n";  
        $headers .= "Reply to: anvic <anvicmosquera0818@gmail.com>\r\n";  
        $headers .= "Content type: text/html\r\n";
        
        mail($to, $subject, $message, $headers);

        header("Location: ../forgot.php?reset=success");
 

} else {
     header("location: ../index.php");

}