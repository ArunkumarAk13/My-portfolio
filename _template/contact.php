<?php
$p       = $data['personal'] ?? [];
$email   = $p['email']    ?? '';
$phone   = $p['phone']    ?? '';
$loc     = $p['location'] ?? '';
$socials = $p['socials']  ?? [];
?>
<section id="contact" class="contact-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">Let's Talk</span>
      <h2 class="section-title">Get In <span class="gradient-text">Touch</span></h2>
      <p class="section-desc">Have a project in mind? I'd love to hear from you.</p>
    </div>

    <div class="contact-grid">

      <!-- Left: Contact Info -->
      <div class="contact-info reveal">

        <p class="contact-intro">
          I'm currently available for freelance work and open to discussing exciting projects.
          Don't hesitate to reach out — let's build something great together!
        </p>

        <div class="contact-cards">
          <div class="contact-card glass-card">
            <div class="contact-card-icon">
              <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="contact-card-body">
              <span class="contact-card-label">Email</span>
              <a href="mailto:<?= e($email) ?>" class="contact-card-value"><?= e($email) ?></a>
            </div>
          </div>

          <div class="contact-card glass-card">
            <div class="contact-card-icon">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div class="contact-card-body">
              <span class="contact-card-label">Phone</span>
              <a href="tel:<?= e(preg_replace('/\s+/', '', $phone)) ?>" class="contact-card-value"><?= e($phone) ?></a>
            </div>
          </div>

          <div class="contact-card glass-card">
            <div class="contact-card-icon">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="contact-card-body">
              <span class="contact-card-label">Location</span>
              <span class="contact-card-value"><?= e($loc) ?></span>
            </div>
          </div>
        </div>

        <div class="contact-socials">
          <p class="contact-social-label">Connect with me</p>
          <div class="contact-social-links">
            <?php foreach ($socials as $s): ?>
            <a href="<?= e($s['url']) ?>"
               class="social-pill"
               target="_blank" rel="noopener noreferrer"
               aria-label="<?= e($s['platform']) ?>">
              <i class="<?= e($s['icon']) ?>"></i>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="contact-form-wrap reveal reveal-right">
        <div class="contact-form-card glass-card">
          <h3 class="form-title">Send a Message</h3>

          <!-- Alert Messages -->
          <div id="formSuccess" class="form-alert form-alert--success" role="alert" hidden>
            <i class="fa-solid fa-circle-check"></i>
            <span>Message sent! I'll get back to you soon.</span>
          </div>
          <div id="formError" class="form-alert form-alert--error" role="alert" hidden>
            <i class="fa-solid fa-circle-xmark"></i>
            <span>Something went wrong. Please try again.</span>
          </div>

          <form id="contactForm" data-endpoint="<?= CONTACT_ENDPOINT ?>" novalidate>

            <div class="form-row">
              <div class="form-group">
                <input type="text" id="contactName" name="name"
                       class="form-input" placeholder=" " required>
                <label for="contactName" class="form-label">Your Name</label>
                <span class="form-line"></span>
              </div>

              <div class="form-group">
                <input type="email" id="contactEmail" name="email"
                       class="form-input" placeholder=" " required>
                <label for="contactEmail" class="form-label">Email Address</label>
                <span class="form-line"></span>
              </div>
            </div>

            <div class="form-group">
              <input type="text" id="contactSubject" name="subject"
                     class="form-input" placeholder=" " required>
              <label for="contactSubject" class="form-label">Subject</label>
              <span class="form-line"></span>
            </div>

            <div class="form-group">
              <textarea id="contactMessage" name="message"
                        class="form-input form-textarea"
                        rows="5" placeholder=" " required></textarea>
              <label for="contactMessage" class="form-label">Your Message</label>
              <span class="form-line"></span>
            </div>

            <button type="submit" class="btn btn-primary btn-submit" id="submitBtn">
              <span class="btn-text">
                <i class="fa-solid fa-paper-plane"></i> Send Message
              </span>
              <span class="btn-loading" hidden>
                <i class="fa-solid fa-spinner fa-spin"></i> Sending…
              </span>
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
