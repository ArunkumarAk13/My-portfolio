<?php
/**
 * Contact Form Mail Handler — PHPMailer + Gmail SMTP
 */

define('PORTFOLIO_ROOT', __DIR__ . '/');
require_once '_config/config.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// Accept both form-encoded and JSON body
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (stripos($contentType, 'application/json') !== false) {
    $body    = json_decode(file_get_contents('php://input'), true) ?? [];
    $name    = trim($body['name']    ?? '');
    $email   = trim($body['email']   ?? '');
    $subject = trim($body['subject'] ?? '');
    $message = trim($body['message'] ?? '');
} else {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
}

// Validate
$errors = [];
if ($name    === '')                             $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if ($subject === '')                             $errors[] = 'Subject is required.';
if ($message === '')                             $errors[] = 'Message is required.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => implode(' ', $errors)]);
    exit;
}

// Sanitize for HTML output
$safeName    = htmlspecialchars($name,    ENT_QUOTES, 'UTF-8');
$safeEmail   = htmlspecialchars($email,   ENT_QUOTES, 'UTF-8');
$safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

$htmlBody = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;padding:20px;color:#333;">
  <h2 style="color:#6c63ff;border-bottom:2px solid #6c63ff;padding-bottom:10px;">
    New Message from Portfolio
  </h2>
  <table style="width:100%;border-collapse:collapse;">
    <tr>
      <td style="padding:8px 0;font-weight:bold;width:100px;">Name:</td>
      <td style="padding:8px 0;">{$safeName}</td>
    </tr>
    <tr>
      <td style="padding:8px 0;font-weight:bold;">Email:</td>
      <td style="padding:8px 0;"><a href="mailto:{$safeEmail}" style="color:#6c63ff;">{$safeEmail}</a></td>
    </tr>
    <tr>
      <td style="padding:8px 0;font-weight:bold;">Subject:</td>
      <td style="padding:8px 0;">{$safeSubject}</td>
    </tr>
  </table>
  <h3 style="margin-top:20px;color:#555;">Message:</h3>
  <div style="background:#f5f5f5;padding:15px;border-left:4px solid #6c63ff;border-radius:4px;line-height:1.6;">
    {$safeMessage}
  </div>
  <p style="margin-top:20px;font-size:12px;color:#999;">
    Hit <strong>Reply</strong> to respond directly to {$safeName}.
  </p>
</body>
</html>
HTML;

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = SITE_EMAIL;
    $mail->Password   = GMAIL_APP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom(SITE_EMAIL, 'Portfolio Contact');
    $mail->addAddress(SITE_EMAIL, SITE_AUTHOR);
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Portfolio: ' . $subject;
    $mail->Body    = $htmlBody;
    $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\n\n$message";

    $mail->send();
    echo json_encode(['ok' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Mail error. Please try again.']);
}
