/**
 * Arun Kumar S — Portfolio JS  v2.0
 * Pure vanilla JS — no external libraries required.
 */

'use strict';

// Mark document as JS-ready so reveal animations activate
document.documentElement.classList.add('js-ready');

/* =====================================================================
   1. THEME TOGGLE
   ===================================================================== */
(function initTheme() {
  const html   = document.documentElement;
  const btn    = document.getElementById('themeToggle');
  const stored = localStorage.getItem('portfolio-theme');

  // Apply saved theme on load (overrides PHP default)
  if (stored) html.setAttribute('data-theme', stored);

  if (!btn) return;

  btn.addEventListener('click', () => {
    const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('portfolio-theme', next);
  });
})();

/* =====================================================================
   2. LOADING SCREEN
   ===================================================================== */
(function initLoader() {
  const screen = document.getElementById('loadingScreen');
  if (!screen) return;

  const hide = () => screen.classList.add('hidden');

  if (document.readyState === 'complete') {
    setTimeout(hide, 400);
  } else {
    window.addEventListener('load', () => setTimeout(hide, 600));
  }
})();

/* =====================================================================
   3. MOBILE MENU + HAMBURGER
   ===================================================================== */
(function initMobileMenu() {
  const hamburger  = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobileMenu');
  if (!hamburger || !mobileMenu) return;

  const open  = () => {
    hamburger.classList.add('active');
    hamburger.setAttribute('aria-expanded', 'true');
    mobileMenu.classList.add('open');
    mobileMenu.removeAttribute('aria-hidden');
    document.body.style.overflow = 'hidden';
  };
  const close = () => {
    hamburger.classList.remove('active');
    hamburger.setAttribute('aria-expanded', 'false');
    mobileMenu.classList.remove('open');
    mobileMenu.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  hamburger.addEventListener('click', () =>
    mobileMenu.classList.contains('open') ? close() : open()
  );

  // Close on link click
  mobileMenu.querySelectorAll('.mobile-nav-link').forEach(link =>
    link.addEventListener('click', close)
  );

  // Close on outside click
  document.addEventListener('click', e => {
    if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) close();
  });

  // Close on Escape
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') close();
  });
})();

/* =====================================================================
   4. NAVBAR SCROLL BEHAVIOUR (shrink + shadow)
   ===================================================================== */
(function initNavbarScroll() {
  const navbar = document.getElementById('navbar');
  if (!navbar) return;

  const update = () => {
    if (window.scrollY > 60) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  };

  window.addEventListener('scroll', update, { passive: true });
  update();
})();

/* =====================================================================
   5. ACTIVE NAV LINK ON SCROLL (Intersection Observer)
   ===================================================================== */
(function initActiveNavLink() {
  const sections  = document.querySelectorAll('section[id]');
  const navLinks  = document.querySelectorAll('.nav-link');
  if (!sections.length || !navLinks.length) return;

  const activate = id => {
    navLinks.forEach(link => {
      link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
    });
  };

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) activate(entry.target.id);
      });
    },
    { rootMargin: '-40% 0px -55% 0px', threshold: 0 }
  );

  sections.forEach(sec => observer.observe(sec));
})();

/* =====================================================================
   6. PARTICLE CANVAS ANIMATION
   ===================================================================== */
(function initParticles() {
  const canvas = document.getElementById('particleCanvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let W, H, particles, animId;

  const resize = () => {
    W = canvas.width  = canvas.offsetWidth;
    H = canvas.height = canvas.offsetHeight;
  };

  const rand = (min, max) => Math.random() * (max - min) + min;

  const createParticles = () => {
    const count = Math.floor((W * H) / 14000);
    particles   = Array.from({ length: count }, () => ({
      x:  rand(0, W),
      y:  rand(0, H),
      r:  rand(0.5, 2.5),
      dx: rand(-0.4, 0.4),
      dy: rand(-0.4, 0.4),
      o:  rand(0.2, 0.7),
    }));
  };

  const drawLine = (a, b, dist) => {
    const alpha = 1 - dist / 140;
    ctx.strokeStyle = `rgba(108,99,255,${alpha * 0.3})`;
    ctx.lineWidth   = 0.6;
    ctx.beginPath();
    ctx.moveTo(a.x, a.y);
    ctx.lineTo(b.x, b.y);
    ctx.stroke();
  };

  const loop = () => {
    ctx.clearRect(0, 0, W, H);

    particles.forEach(p => {
      p.x += p.dx;
      p.y += p.dy;
      if (p.x < 0) p.x = W;
      if (p.x > W) p.x = 0;
      if (p.y < 0) p.y = H;
      if (p.y > H) p.y = 0;

      ctx.fillStyle = `rgba(108,99,255,${p.o})`;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
    });

    // Connect nearby particles
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx   = particles[i].x - particles[j].x;
        const dy   = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 140) drawLine(particles[i], particles[j], dist);
      }
    }

    animId = requestAnimationFrame(loop);
  };

  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      resize();
      createParticles();
    }, 200);
  });

  resize();
  createParticles();
  loop();
})();

/* =====================================================================
   7. TYPED TEXT ANIMATION  (pure JS)
   ===================================================================== */
(function initTyped() {
  const el = document.getElementById('typedText');
  if (!el) return;

  let roles;
  try {
    roles = JSON.parse(el.dataset.roles || '[]');
  } catch (_) {
    roles = ['Web Developer'];
  }
  if (!roles.length) return;

  let roleIdx = 0;
  let charIdx = 0;
  let deleting = false;
  let paused   = false;

  const type = () => {
    const current = roles[roleIdx];

    if (paused) return;

    if (!deleting) {
      el.textContent = current.slice(0, ++charIdx);
      if (charIdx === current.length) {
        paused = true;
        setTimeout(() => { paused = false; deleting = true; }, 1800);
      }
    } else {
      el.textContent = current.slice(0, --charIdx);
      if (charIdx === 0) {
        deleting  = false;
        roleIdx   = (roleIdx + 1) % roles.length;
      }
    }

    const speed = deleting ? 55 : 95;
    setTimeout(type, speed);
  };

  setTimeout(type, 800);
})();


/* =====================================================================
   9. SKILLS TAB SWITCHER
   ===================================================================== */
(function initSkillTabs() {
  const tabs   = document.querySelectorAll('.skills-tab');
  const panels = document.querySelectorAll('.skills-panel');
  if (!tabs.length) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      panels.forEach(p => p.classList.remove('active'));
      tab.classList.add('active');
      const panel = document.getElementById('panel-' + tab.dataset.tab);
      if (panel) panel.classList.add('active');
    });
  });
})();

/* =====================================================================
   10. PROJECTS FILTER
   ===================================================================== */
(function initProjectFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const cards      = document.querySelectorAll('.project-card');
  if (!filterBtns.length) return;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;

      cards.forEach(card => {
        const match = filter === 'all' || card.dataset.category === filter;
        card.classList.toggle('hidden', !match);
      });
    });
  });
})();

/* =====================================================================
   11. TIMELINE LINE DRAW ON SCROLL
   ===================================================================== */
(function initTimeline() {
  const line = document.getElementById('timelineLine');
  if (!line) return;

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          line.classList.add('animated');
          observer.unobserve(line);
        }
      });
    },
    { threshold: 0.1 }
  );

  observer.observe(line);
})();

/* =====================================================================
   12. COUNTER ANIMATION (stat numbers)
   ===================================================================== */
(function initCounters() {
  const els = document.querySelectorAll('.stat-value[data-count]');
  if (!els.length) return;

  const animateCount = el => {
    const target  = parseFloat(el.dataset.count);
    const isFloat = el.dataset.count.includes('.');
    const dur     = 1600;
    const step    = 16;
    const steps   = dur / step;
    let   current = 0;
    let   tick    = 0;

    const timer = setInterval(() => {
      tick++;
      current = target * (tick / steps);
      if (tick >= steps) {
        clearInterval(timer);
        current = target;
      }
      el.textContent = isFloat
        ? current.toFixed(1)
        : Math.floor(current).toString() + (el.textContent.endsWith('+') ? '+' : '');
    }, step);
  };

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 }
  );

  els.forEach(el => observer.observe(el));
})();

/* =====================================================================
   13. SCROLL REVEAL (.reveal → .visible)
   ===================================================================== */
(function initScrollReveal() {
  const els = document.querySelectorAll('.reveal');
  if (!els.length) return;

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          const delay = entry.target.style.getPropertyValue('--delay') || '0s';
          entry.target.style.transitionDelay = delay;
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.05, rootMargin: '0px 0px 0px 0px' }
  );

  els.forEach(el => observer.observe(el));

  // Fallback: force-reveal anything still hidden after 1.5 s
  setTimeout(() => {
    document.querySelectorAll('.reveal:not(.visible)').forEach(el => {
      el.style.transitionDelay = '0s';
      el.classList.add('visible');
    });
  }, 1500);
})();

/* =====================================================================
   14. CONTACT FORM (Formspree AJAX)
   ===================================================================== */
(function initContactForm() {
  const form      = document.getElementById('contactForm');
  const successEl = document.getElementById('formSuccess');
  const errorEl   = document.getElementById('formError');
  const submitBtn = document.getElementById('submitBtn');
  if (!form) return;

  const btnText    = submitBtn ? submitBtn.querySelector('.btn-text')    : null;
  const btnLoading = submitBtn ? submitBtn.querySelector('.btn-loading') : null;

  const setLoading = loading => {
    if (!submitBtn) return;
    submitBtn.disabled = loading;
    if (btnText)    btnText.hidden    =  loading;
    if (btnLoading) btnLoading.hidden = !loading;
  };

  const showAlert = (el, show) => {
    if (!el) return;
    el.hidden = !show;
  };

  form.addEventListener('submit', async e => {
    e.preventDefault();

    showAlert(successEl, false);
    showAlert(errorEl,   false);
    setLoading(true);

    try {
      const res  = await fetch(form.action, {
        method:  'POST',
        body:    new FormData(form),
        headers: { Accept: 'application/json' },
      });
      const data = await res.json().catch(() => ({}));

      if (res.ok && data.ok) {
        showAlert(successEl, true);
        form.reset();
      } else {
        const errSpan = errorEl && errorEl.querySelector('span');
        if (errSpan && data.error) errSpan.textContent = data.error;
        showAlert(errorEl, true);
      }
    } catch (_) {
      showAlert(errorEl, true);
    } finally {
      setLoading(false);
    }
  });
})();

/* =====================================================================
   15. BACK TO TOP BUTTON
   ===================================================================== */
(function initBackToTop() {
  const btn = document.getElementById('backToTop');
  if (!btn) return;

  const update = () => btn.classList.toggle('visible', window.scrollY > 400);

  window.addEventListener('scroll', update, { passive: true });

  btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  update();
})();

/* =====================================================================
   16. SMOOTH SCROLL for anchor links
   ===================================================================== */
(function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      const target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
})();

/* =====================================================================
   17. CURSOR GLOW EFFECT (desktop only)
   ===================================================================== */
(function initCursorGlow() {
  const glow = document.getElementById('cursorGlow');
  if (!glow) return;

  // Only on non-touch devices
  if ('ontouchstart' in window) { glow.style.display = 'none'; return; }

  let mx = -1000, my = -1000;
  let cx = -1000, cy = -1000;
  let raf;

  const lerp = (a, b, t) => a + (b - a) * t;

  const update = () => {
    cx = lerp(cx, mx, 0.1);
    cy = lerp(cy, my, 0.1);
    glow.style.left = cx + 'px';
    glow.style.top  = cy + 'px';
    raf = requestAnimationFrame(update);
  };

  document.addEventListener('mousemove', e => {
    mx = e.clientX;
    my = e.clientY;
  });

  document.addEventListener('mouseleave', () => {
    glow.style.opacity = '0';
  });
  document.addEventListener('mouseenter', () => {
    glow.style.opacity = '1';
  });

  update();
})();
