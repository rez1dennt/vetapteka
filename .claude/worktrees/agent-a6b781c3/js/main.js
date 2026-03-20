/**
 * ВЕТАПТЕКА.ПРО — main.js
 * ES6+ · No dependencies
 */

'use strict';

/* ── DOM refs ────────────────────────────────────────────────── */
const header      = document.getElementById('site-header');
const burgerBtn   = document.getElementById('burger-btn');
const mobileMenu  = document.getElementById('mobile-menu');
const mobileLinks = document.querySelectorAll('.mobile-nav-link, .mobile-nav-cta');
const faqItems    = document.querySelectorAll('.faq-item');
const certBtn     = document.getElementById('cert-btn');
const lightbox    = document.getElementById('lightbox');
const lbBackdrop  = document.getElementById('lightbox-backdrop');
const lbClose     = document.getElementById('lightbox-close');
const lbImg       = document.getElementById('lightbox-img');
const lbCaption   = document.getElementById('lightbox-caption');

/* ════════════════════════════════════════════════════════════
   1. STICKY HEADER — add .scrolled class after 80px scroll
════════════════════════════════════════════════════════════ */
const SCROLL_THRESHOLD = 80;

const onScroll = () => {
  const scrolled = window.scrollY > SCROLL_THRESHOLD;
  header.classList.toggle('scrolled', scrolled);
};

window.addEventListener('scroll', onScroll, { passive: true });
onScroll(); // run once on load


/* ════════════════════════════════════════════════════════════
   2. BURGER MENU
════════════════════════════════════════════════════════════ */
const openMenu = () => {
  header.classList.add('menu-open');
  burgerBtn.setAttribute('aria-expanded', 'true');
  burgerBtn.setAttribute('aria-label', 'Закрыть меню');
  mobileMenu.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
};

const closeMenu = () => {
  header.classList.remove('menu-open');
  burgerBtn.setAttribute('aria-expanded', 'false');
  burgerBtn.setAttribute('aria-label', 'Открыть меню');
  mobileMenu.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
};

burgerBtn.addEventListener('click', () => {
  const isOpen = header.classList.contains('menu-open');
  isOpen ? closeMenu() : openMenu();
});

// Close on any mobile nav link click
mobileLinks.forEach(link => {
  link.addEventListener('click', closeMenu);
});

// Close on outside click
document.addEventListener('click', (e) => {
  if (
    header.classList.contains('menu-open') &&
    !header.contains(e.target)
  ) {
    closeMenu();
  }
});

// Close on ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    if (header.classList.contains('menu-open')) closeMenu();
    if (!lightbox.hidden) closeLightbox();
  }
});


/* ════════════════════════════════════════════════════════════
   3. SMOOTH SCROLL for anchor links
════════════════════════════════════════════════════════════ */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', (e) => {
    const targetId = anchor.getAttribute('href');
    if (targetId === '#') return;

    const target = document.querySelector(targetId);
    if (!target) return;

    e.preventDefault();
    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});


/* ════════════════════════════════════════════════════════════
   4. FAQ ACCORDION
════════════════════════════════════════════════════════════ */
faqItems.forEach(item => {
  const btn   = item.querySelector('.faq-q');
  const panel = item.querySelector('.faq-a');

  if (!btn || !panel) return;

  btn.addEventListener('click', () => {
    const isOpen = btn.getAttribute('aria-expanded') === 'true';

    // Close all other open items first (both animate thanks to CSS transition)
    faqItems.forEach(other => {
      const ob = other.querySelector('.faq-q');
      const op = other.querySelector('.faq-a');
      if (ob && op && ob !== btn && ob.getAttribute('aria-expanded') === 'true') {
        ob.setAttribute('aria-expanded', 'false');
        op.classList.remove('faq-open');
      }
    });

    // Toggle this item
    btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    panel.classList.toggle('faq-open', !isOpen);
  });
});


/* ════════════════════════════════════════════════════════════
   5. LIGHTBOX — certificate gallery
════════════════════════════════════════════════════════════ */
const openLightbox = (src, alt) => {
  lbImg.src = src;
  lbImg.alt = alt;
  lbCaption.textContent = alt;

  lightbox.hidden = false;
  document.body.style.overflow = 'hidden';

  // Focus trap — move focus to close button
  requestAnimationFrame(() => lbClose.focus());
};

const closeLightbox = () => {
  lightbox.hidden = true;
  document.body.style.overflow = '';
  lbImg.src = '';
  // Return focus to cert button
  if (certBtn) certBtn.focus();
};

if (certBtn) {
  certBtn.addEventListener('click', () => {
    const src = certBtn.dataset.src || 'images/certificate.jpg';
    const alt = certBtn.dataset.alt || 'Лицензия Россельхознадзора';
    openLightbox(src, alt);
  });
}

lbClose.addEventListener('click', closeLightbox);
lbBackdrop.addEventListener('click', closeLightbox);

// Prevent closing when clicking the image itself
lightbox.querySelector('.lightbox-figure').addEventListener('click', (e) => {
  e.stopPropagation();
});


/* ════════════════════════════════════════════════════════════
   6. SCROLL-TRIGGERED FADE-IN (IntersectionObserver)
════════════════════════════════════════════════════════════ */
const fadeEls = document.querySelectorAll(
  '.card, .about-image-wrap, .about-text-wrap, ' +
  '.certificate-img-col, .certificate-text-col, ' +
  '.contact-row, .faq-item, .footer-brand, .footer-nav, .footer-contact'
);

const observerOptions = {
  threshold: 0.12,
  rootMargin: '0px 0px -40px 0px',
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('is-visible');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

fadeEls.forEach((el, i) => {
  el.classList.add('fade-up');

  // Stagger cards within the same grid
  const cardsParent = el.closest('.cards-grid');
  if (cardsParent) {
    const siblings = [...cardsParent.children];
    const idx = siblings.indexOf(el);
    el.style.transitionDelay = `${idx * 0.1}s`;
  }

  // Stagger FAQ items one by one
  const faqParent = el.closest('.faq-list');
  if (faqParent) {
    const siblings = [...faqParent.children];
    const idx = siblings.indexOf(el);
    el.style.transitionDelay = `${idx * 0.09}s`;
  }

  observer.observe(el);
});
