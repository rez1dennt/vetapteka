/**
 * ВЕТАПТЕКА.ПРО — main.js
 * ES6+ · No dependencies
 */

'use strict';

/* ── DOM refs ────────────────────────────────────────────────── */
const header        = document.getElementById('site-header');
const burgerBtn     = document.getElementById('burger-btn');
const mobileMenu    = document.getElementById('mobile-menu');
const menuOverlay   = document.getElementById('menu-overlay');
const menuCloseBtn  = document.getElementById('mobile-menu-close');
const mobileLinks   = document.querySelectorAll('.mobile-nav-link, .mobile-nav-cta');
const faqItems      = document.querySelectorAll('.faq-item');
const certBtn       = document.getElementById('cert-btn');
const lightbox      = document.getElementById('lightbox');
const lbBackdrop    = document.getElementById('lightbox-backdrop');
const lbClose       = document.getElementById('lightbox-close');
const lbImg         = document.getElementById('lightbox-img');
const lbCaption     = document.getElementById('lightbox-caption');

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
   2. BURGER MENU — правая панель
════════════════════════════════════════════════════════════ */

// Ширина скроллбара — измеряем один раз до любых манипуляций с overflow
const _sw = window.innerWidth - document.documentElement.clientWidth;
document.documentElement.style.setProperty('--scrollbar-w', _sw + 'px');

let _closeTimer = null;
const MENU_DURATION = 420; // чуть дольше CSS transition (0.38s)

const openMenu = () => {
  clearTimeout(_closeTimer);

  // ── 1. Сначала компенсируем ширину скроллбара ──────────────
  // Делаем ДО скрытия overflow, чтобы контент не прыгал
  if (_sw > 0) {
    document.body.style.paddingRight    = _sw + 'px';
    header.style.paddingRight           = _sw + 'px';
  }

  // ── 2. Блокируем прокрутку ─────────────────────────────────
  // Нужно оба: html + body — только body не работает в Safari/iOS
  document.documentElement.style.overflow = 'hidden';
  document.body.style.overflow = 'hidden';

  // ── 3. Анимация: панель + оверлей ─────────────────────────
  header.classList.add('menu-open');          // бургер → ×, панель вылезает
  document.body.classList.add('menu-open');   // оверлей появляется

  burgerBtn.setAttribute('aria-expanded', 'true');
  burgerBtn.setAttribute('aria-label', 'Закрыть меню');
  mobileMenu.setAttribute('aria-hidden', 'false');
  menuOverlay.setAttribute('aria-hidden', 'false');

  // Focus trap
  requestAnimationFrame(() => {
    const first = mobileMenu.querySelector('.mobile-menu-close, .mobile-nav-link');
    if (first) first.focus();
  });
};

const closeMenu = () => {
  // ── 1. Запускаем анимации закрытия ────────────────────────
  header.classList.remove('menu-open');         // панель уходит вправо
  document.body.classList.remove('menu-open');  // оверлей тает

  burgerBtn.setAttribute('aria-expanded', 'false');
  burgerBtn.setAttribute('aria-label', 'Открыть меню');
  mobileMenu.setAttribute('aria-hidden', 'true');
  menuOverlay.setAttribute('aria-hidden', 'true');

  // ── 2. Восстанавливаем скролл ПОСЛЕ анимации ──────────────
  // Если убрать раньше — скроллбар появляется во время анимации → скачок
  clearTimeout(_closeTimer);
  _closeTimer = setTimeout(() => {
    document.documentElement.style.overflow = '';
    document.body.style.overflow            = '';
    document.body.style.paddingRight        = '';
    header.style.paddingRight               = '';
  }, MENU_DURATION);
};

burgerBtn.addEventListener('click', () => {
  header.classList.contains('menu-open') ? closeMenu() : openMenu();
});

// Кнопка × внутри панели
if (menuCloseBtn) menuCloseBtn.addEventListener('click', closeMenu);

// Клик по оверлею
if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);

// Клик по ссылкам меню
mobileLinks.forEach(link => link.addEventListener('click', closeMenu));

// ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    if (header.classList.contains('menu-open')) closeMenu();
    if (!lightbox.hidden) closeLightbox();
  }
});

// Изменение ориентации / ресайз — закрываем чтобы не было артефактов
window.addEventListener('resize', () => {
  if (header.classList.contains('menu-open')) closeMenu();
}, { passive: true });


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
  document.body.classList.add('lightbox-open');

  requestAnimationFrame(() => lbClose.focus());
};

const closeLightbox = () => {
  lightbox.hidden = true;
  document.body.classList.remove('lightbox-open');
  lbImg.src = '';
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
