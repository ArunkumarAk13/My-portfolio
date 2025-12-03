// ============ COMPONENT SYSTEM ============

// Global data storage
let resumeData = {};

// Load resume data from JSON
async function loadResumeData() {
  try {
    const response = await fetch('resume.json');
    resumeData = await response.json();
    console.log('Resume data loaded successfully:', resumeData);
    initializeComponents();
  } catch (error) {
    console.error('Error loading resume data:', error);
  }
}

// Initialize all components
function initializeComponents() {
  renderHomeSection();
  renderAboutSection();
  renderSkillsSection();
  renderProjectsSection();
  renderSocialLinks();
  initializeContactForm();
}

// ============ HOME SECTION COMPONENT ============
function renderHomeSection() {
  const personal = resumeData.personal;
  
  // Set name and title
  document.querySelector('.home-name').textContent = personal.name;
  document.querySelector('.home-title').textContent = personal.title;
  
  // Set resume button
  const resumeBtn = document.querySelector('.resume-btn');
    const resumeButton = resumeBtn.querySelector('.resume-animated');
    resumeBtn.href = personal.resumeFile;
    resumeBtn.download = `${personal.name} resume.pdf`;
    // Add click event for animated download
    if (resumeButton) {
      resumeButton.onclick = (e) => {
        e.preventDefault();
        const link = document.createElement('a');
        link.href = personal.resumeFile;
        link.download = `${personal.name} resume.pdf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        resumeButton.classList.add('downloading');
        setTimeout(() => resumeButton.classList.remove('downloading'), 1200);
      };
    }
}

// ============ ABOUT SECTION COMPONENT ============
function renderAboutSection() {
  const personal = resumeData.personal;
  document.querySelector('.about-bio').textContent = personal.bio;
}

// ============ SKILLS SECTION COMPONENT ============
function renderSkillsSection() {
  const skillsContainer = document.getElementById('skills-container');
  skillsContainer.innerHTML = '';
  
  const skillsHTML = resumeData.skills.map(category => `
    <div class="skill-category">
      <h3 class="category-title">${category.category}</h3>
      <div class="skill-set">
        ${category.items.map(skill => `
          <div class="progress-bar-container">
            <h4 class="skill-name">${skill.name}</h4>
            <div class="progress-bar">
              <div class="percentage-per" per="${skill.percentage}%" style="max-width:${skill.percentage}%;"></div>
            </div>
          </div>
        `).join('')}
      </div>
    </div>
  `).join('');
  
  skillsContainer.innerHTML = skillsHTML;
}

// ============ PROJECTS SECTION COMPONENT ============
function renderProjectsSection() {
  const projectsContainer = document.getElementById('projects-container');
  projectsContainer.innerHTML = '';
  
  const projectsHTML = resumeData.projects.map((project, index) => `
    <div class="project-box" style="animation-delay: ${index * 0.1}s">
      <div class="project-img">
        ${project.image ? `<img src="${project.image}" alt="${project.title} Image" loading="lazy"/>` : `<i class="fas fa-project-diagram"></i>`}
      </div>
      <div class="project-content">
        <h3 class="project-title">${project.title}</h3>
        <p class="project-description">${project.description}</p>
        <div class="project-tech">
          ${project.technologies.map(tech => `<span class="tech-badge">${tech}</span>`).join('')}
        </div>
        <a href="${project.link}" target="_blank" class="project-link">
          View Project <i class="fa-solid fa-up-right-from-square"></i>
        </a>
      </div>
    </div>
  `).join('');
  
  projectsContainer.innerHTML = projectsHTML;
}

// ============ SOCIAL LINKS COMPONENT ============
function renderSocialLinks() {
  const socialContainer = document.getElementById('social-links');
  socialContainer.innerHTML = '';
  
  const socialsHTML = resumeData.socials.map(social => `
    <a href="${social.url}" target="_blank" title="${social.platform}">
      <i class="${social.icon}"></i>
    </a>
  `).join('');
  
  socialContainer.innerHTML = socialsHTML;
}

// ============ CONTACT FORM COMPONENT ============
function initializeContactForm() {
  const form = document.getElementById('contact-form');
  const messageDiv = document.getElementById('form-message');
  const submitBtn = document.getElementById('submit-btn');
  
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(form);
    const data = {
      name: formData.get('name'),
      email: formData.get('email'),
      phone: formData.get('phone'),
      subject: formData.get('subject'),
      message: formData.get('message')
    };

    // Validate form
    if (!validateForm(data)) {
      showMessage('Please fill in all fields correctly', 'error');
      return;
    }

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending...';
      const contactText = submitBtn ? submitBtn.querySelector('.contact-text') : null;
      const contactIcon = submitBtn ? submitBtn.querySelector('.contact-icon') : null;
      if (contactText) contactText.textContent = 'Sending...';
      if (contactIcon) contactIcon.classList.add('fa-spin');
    try {
      // Send email using Formspree
      const response = await fetch('https://formspree.io/f/xnnadjyd', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          name: data.name,
          email: data.email,
          phone: data.phone,
          subject: data.subject,
          message: data.message,
          _subject: `New Message from ${data.name}: ${data.subject}`,
          _replyto: data.email
        })
      });

      if (response.ok) {
        showMessage('✓ Message sent successfully! I\'ll get back to you soon.', 'success');
        form.reset();
        
        // Reset button after success
        setTimeout(() => {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Send Message';
        }, 3000);
      } else {
        throw new Error('Failed to send message');
      }
    } catch (error) {
      console.error('Error:', error);
      showMessage('✗ Error sending message. Please try again.', 'error');
      submitBtn.disabled = false;
      submitBtn.textContent = 'Send Message';
    }
  });

  function showMessage(text, type) {
    messageDiv.textContent = text;
    messageDiv.className = `form-message ${type}`;
    messageDiv.style.display = 'block';
    
    // Auto hide error messages after 5 seconds
    if (type === 'error') {
      setTimeout(() => {
        messageDiv.style.display = 'none';
      }, 5000);
    }
  }

  function validateForm(data) {
    // Validate name
    if (!data.name || data.name.trim().length < 2) {
      return false;
    }

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!data.email || !emailRegex.test(data.email)) {
      return false;
    }

    // Validate phone
    const phoneRegex = /^[0-9\s\-\+\(\)]{10,}$/;
    if (!data.phone || !phoneRegex.test(data.phone.replace(/\s/g, ''))) {
      return false;
    }

    // Validate subject
    if (!data.subject || data.subject.trim().length < 3) {
      return false;
    }

    // Validate message
    if (!data.message || data.message.trim().length < 10) {
      return false;
    }

    return true;
  }
}

// ============ NAVIGATION & UI INTERACTIONS ============

let menuBar = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');

menuBar.onclick = () => {
  menuBar.classList.toggle("fa-xmark");
  navbar.classList.toggle("active");
}

// Close menu when a link is clicked
document.querySelectorAll('.navbar a').forEach(link => {
  link.addEventListener('click', () => {
    menuBar.classList.remove("fa-xmark");
    navbar.classList.remove("active");
  });
});

let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

window.onscroll = () => {
  sections.forEach(sec => {
    let top = window.scrollY;
    let offset = sec.offsetTop - 150;
    let height = sec.offsetHeight;
    let id = sec.getAttribute('id');

    if (top >= offset && top < offset + height) {
      navLinks.forEach(link => {
        link.classList.remove('active');
        document.querySelector('header nav a[href*="' + id + '"]').classList.add('active');
      });
    }
  });

  let header = document.querySelector('header');
  header.classList.toggle('sticky', window.scrollY > 100);

  menuBar.classList.remove('fa-xmark');
  navbar.classList.remove('active');
}

// ============ SCROLL REVEAL ANIMATION ============
ScrollReveal({
  distance: '80px',
  duration: 2000,
  delay: 200
});

ScrollReveal().reveal('.home-items, .heading', { origin: 'top' });
ScrollReveal().reveal('.home-img, .skills-container, .contact form', { origin: 'bottom' });
ScrollReveal().reveal('.home-items h1, .project-box, .about-img', { origin: 'left' });
ScrollReveal().reveal('.home-items h3, .about-items, .social-media', { origin: 'right' });

// ============ INITIALIZATION ============
document.addEventListener('DOMContentLoaded', () => {
  loadResumeData();
});
