<?php
// Check if the honeypot field is filled (a bot would fill it)
if (!empty($_POST['honeypot'])) {
    // Log the spam detection
    error_log("Spam detected - honeypot filled by bot.");
    // Stop form processing and prevent the email from being sent
    die("Spam detected.");
}

// Manually sanitize form data
$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$address = htmlspecialchars(trim($_POST['address']));
$date = htmlspecialchars(trim($_POST['date']));
$start_time = htmlspecialchars(trim($_POST['start-time']));
$finish_time = htmlspecialchars(trim($_POST['finish-time']));
$message = htmlspecialchars(trim($_POST['message'])); // Sanitize text area input

// Create email subject and message with Bulgarian translations
$subject = "Ново съобщение от формата";

// Email message with translated labels
$email_message = "Име: " . $name . "\n";
$email_message .= "Имейл: " . $email . "\n";
$email_message .= "Адрес: " . $address . "\n";
$email_message .= "Дата: " . $date . "\n";
$email_message .= "Начален час: " . $start_time . "\n";
$email_message .= "Краен час: " . $finish_time . "\n";
$email_message .= "Съобщение: " . $message . "\n"; // Include message from text area

// Set the email recipient (change to your email address)
$to = 'YOUR EMAIL';  // Replace this with your email
$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Set content type to plain text

// Send the email if honeypot is not filled (not spam)
if (mail($to, $subject, $email_message, $headers)) {
    echo "Success";
} else {
    echo "Failure";
}
?>
