<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pnr = $_POST["pnr"];

    // Dummy function to get email by PNR (Replace with actual DB query)
    function getEmailByPNR($pnr)
    {
        $dummyData = [
            "1234567890" => "pavankumarb580@gmail.com",
            "0987654321" => "pavan.parvam@gmail.com"
        ];
        return $dummyData[$pnr] ?? null;
    }

    $user_email = getEmailByPNR($pnr);
    if (!$user_email) {
        echo "Error: No email found for this PNR.";
        exit;
    }

    // Handle file upload
    if (isset($_FILES["pdf"]) && $_FILES["pdf"]["error"] == 0) {
        $pdf_tmp = $_FILES["pdf"]["tmp_name"];
        $pdf_name = "Invoice_" . $pnr . ".pdf";
    } else {
        echo "Error: Invoice file missing.";
        exit;
    }

    // Send email with invoice
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // Show SMTP debug info (change to 0 in production)
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pavan.parvam@gmail.com'; // Your Gmail ID
        $mail->Password = 'YOUR_APP_PASSWORD_HERE'; // ✅ Use Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('pavan.parvam@gmail.com', 'Train Shopping'); // ✅ Use the same Gmail ID
        $mail->addAddress($user_email);
        $mail->Subject = "Your Invoice for Train Shopping";
        $mail->Body = "Dear Customer,\n\nAttached is your invoice for the recent purchase.\n\nThank you!";
        $mail->addAttachment($pdf_tmp, $pdf_name);

        $mail->send();
        echo "Invoice sent successfully to $user_email.";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>