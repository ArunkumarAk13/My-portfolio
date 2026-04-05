<?php
/**
 * Contact Form Mail Handler — PHP native mail(), no dependencies
 */

define('PORTFOLIO_ROOT', __DIR__ . '/');
require_once '_config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// Validate
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

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

// Sanitize
$name    = htmlspecialchars($name,    ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars($email,   ENT_QUOTES, 'UTF-8');
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

$headers = implode("\r\n", [
    'From: Portfolio Contact <' . SITE_EMAIL . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
]);

$body = <<<HTML
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
      <td style="padding:8px 0;">{$name}</td>
    </tr>
    <tr>
      <td style="padding:8px 0;font-weight:bold;">Email:</td>
      <td style="padding:8px 0;"><a href="mailto:{$email}" style="color:#6c63ff;">{$email}</a></td>
    </tr>
    <tr>
      <td style="padding:8px 0;font-weight:bold;">Subject:</td>
      <td style="padding:8px 0;">{$subject}</td>
    </tr>
  </table>
  <h3 style="margin-top:20px;color:#555;">Message:</h3>
  <div style="background:#f5f5f5;padding:15px;border-left:4px solid #6c63ff;border-radius:4px;line-height:1.6;">
    {$message}
  </div>
  <p style="margin-top:20px;font-size:12px;color:#999;">
    Hit <strong>Reply</strong> to respond directly to {$name}.
  </p>
</body>
</html>
HTML;

$sent = mail(SITE_EMAIL, 'Portfolio: ' . $subject, $body, $headers);

if ($sent) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Mail server error. Please try again.']);
}
