<?php
/* $name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];


//database connection
$conn=new mysqli('localhost','root','','divija');
if($conn->connect_error){
    die('Connection Failed :'.$conn->connect_error);
}
else{
    $stmt=$conn->prepare("insert into student (name,email,message) values(?,?,?)");
    $stmt->bind_param("sss",$name,$email,$message);
    $stmt->execute();
    echo "submitted";
    $stmt->close();
    $conn->close();
} */

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'divija');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO student (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    echo "Submitted";
    $stmt->close();
    $conn->close();

    // Send thank you email
    $thankYouSubject = "Thank you for your submission";
    $thankYouMessage = "Dear $name,\n\nThank you for submitting the form. We appreciate your message and will get back to you as soon as possible.\n\nBest regards,\nThe Example Team";
    $thankYouHeaders = "From: divijashreeneerla@gmail.com";

    mail($email, $thankYouSubject, $thankYouMessage, $thankYouHeaders);

    // Send email notification
    $to = "divijashreeneerla@gmail.com";
    $subject = "New Form Submission";
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Message: $message\n";
    $email_headers = "From: $email";
    $email_headers .= "Reply-To: $email";

    mail($to, $subject, $email_message, $email_headers);
}
?>
