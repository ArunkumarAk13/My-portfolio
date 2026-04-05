/**
 * Portfolio Contact Mailer — Node.js + Nodemailer
 * Runs on port 3001, proxied via Nginx as /api/contact
 */

const http       = require('http');
const nodemailer = require('nodemailer');

// ── Config ────────────────────────────────────────────────────────────────────
const CONFIG = {
  port:      3001,
  toEmail:   'arunkumar132004@gmail.com',
  gmailUser: 'arunkumar132004@gmail.com',
  gmailPass: 'YOUR_GMAIL_APP_PASSWORD',   // 16-char App Password, no spaces
};

// ── Mailer ────────────────────────────────────────────────────────────────────
const transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: CONFIG.gmailUser,
    pass: CONFIG.gmailPass,
  },
});

// ── Helpers ───────────────────────────────────────────────────────────────────
function readBody(req) {
  return new Promise((resolve, reject) => {
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end',  ()    => {
      try { resolve(JSON.parse(body)); }
      catch { reject(new Error('Invalid JSON')); }
    });
    req.on('error', reject);
  });
}

function send(res, status, payload) {
  res.writeHead(status, {
    'Content-Type':                'application/json',
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Headers':'Content-Type',
  });
  res.end(JSON.stringify(payload));
}

function escapeHtml(str = '') {
  return String(str)
    .replace(/&/g,  '&amp;')
    .replace(/</g,  '&lt;')
    .replace(/>/g,  '&gt;')
    .replace(/"/g,  '&quot;')
    .replace(/\n/g, '<br>');
}

// ── Server ────────────────────────────────────────────────────────────────────
const server = http.createServer(async (req, res) => {

  // CORS preflight
  if (req.method === 'OPTIONS') {
    res.writeHead(204, {
      'Access-Control-Allow-Origin':  '*',
      'Access-Control-Allow-Methods': 'POST, OPTIONS',
      'Access-Control-Allow-Headers': 'Content-Type',
    });
    return res.end();
  }

  if (req.method !== 'POST') {
    return send(res, 405, { ok: false, error: 'Method not allowed' });
  }

  // Parse body
  let body;
  try {
    body = await readBody(req);
  } catch {
    return send(res, 400, { ok: false, error: 'Invalid request' });
  }

  // Validate
  const { name = '', email = '', subject = '', message = '' } = body;
  const errors = [];
  if (!name.trim())                              errors.push('Name is required.');
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors.push('Valid email is required.');
  if (!subject.trim())                           errors.push('Subject is required.');
  if (!message.trim())                           errors.push('Message is required.');

  if (errors.length) {
    return send(res, 422, { ok: false, error: errors.join(' ') });
  }

  // Build & send email
  const mailOptions = {
    from:     `"Portfolio Contact" <${CONFIG.gmailUser}>`,
    to:       CONFIG.toEmail,
    replyTo:  `"${name}" <${email}>`,
    subject:  `Portfolio: ${subject}`,
    text:     `Name: ${name}\nEmail: ${email}\nSubject: ${subject}\n\nMessage:\n${message}`,
    html: `
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
            <td style="padding:8px 0;">${escapeHtml(name)}</td>
          </tr>
          <tr>
            <td style="padding:8px 0;font-weight:bold;">Email:</td>
            <td style="padding:8px 0;">
              <a href="mailto:${escapeHtml(email)}" style="color:#6c63ff;">${escapeHtml(email)}</a>
            </td>
          </tr>
          <tr>
            <td style="padding:8px 0;font-weight:bold;">Subject:</td>
            <td style="padding:8px 0;">${escapeHtml(subject)}</td>
          </tr>
        </table>
        <h3 style="margin-top:20px;color:#555;">Message:</h3>
        <div style="background:#f5f5f5;padding:15px;border-left:4px solid #6c63ff;border-radius:4px;line-height:1.6;">
          ${escapeHtml(message)}
        </div>
        <p style="margin-top:20px;font-size:12px;color:#999;">
          Hit <strong>Reply</strong> to respond directly to ${escapeHtml(name)}.
        </p>
      </body>
      </html>
    `,
  };

  try {
    await transporter.sendMail(mailOptions);
    send(res, 200, { ok: true });
  } catch (err) {
    console.error('Mail error:', err.message);
    send(res, 500, { ok: false, error: 'Failed to send email. Please try again.' });
  }
});

server.listen(CONFIG.port, () => {
  console.log(`Mailer running on port ${CONFIG.port}`);
});
