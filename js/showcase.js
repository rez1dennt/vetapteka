/**
 * ВЕТАПТЕКА.ПРО — Витрина: load more + lazy image observer
 */

(function () {
  'use strict';

  const loadMoreBtn = document.getElementById('vitrina-load-more');
  const grid        = document.getElementById('vitrina-grid');

  if (!loadMoreBtn || !grid) return;

  // ── Intersection Observer for fade-in on new cards ──────────
  const fadeObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          fadeObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.08 }
  );

  function observeNewCards(container) {
    const cards = container.querySelectorAll('.showcase-card');
    cards.forEach((card) => {
      // Only observe cards that haven't been observed yet
      if (!card.dataset.observed) {
        card.dataset.observed = '1';
        card.style.opacity = '0';
        card.style.transform = 'translateY(18px)';
        card.style.transition = 'opacity 0.45s ease, transform 0.45s ease';
        fadeObserver.observe(card);
      }
    });
  }

  // Observe initial cards
  observeNewCards(grid);

  // ── Load more click handler ──────────────────────────────────
  loadMoreBtn.addEventListener('click', async function () {
    const offset    = parseInt(grid.dataset.offset, 10) || 0;
    const btn       = loadMoreBtn;

    // Disable button, show loading state
    btn.classList.add('is-loading');
    btn.disabled = true;

    const formData = new FormData();
    formData.append('action', 'vetapteka_showcase_load_more');
    formData.append('nonce',  vetaptekaAjax.nonce);
    formData.append('offset', offset);

    try {
      const response = await fetch(vetaptekaAjax.url, {
        method: 'POST',
        body:   formData,
        credentials: 'same-origin',
      });

      if (!response.ok) {
        throw new Error('Network response was not ok: ' + response.status);
      }

      const data = await response.json();

      if (!data.success) {
        throw new Error('Server returned success: false');
      }

      const result = data.data;

      // Append new cards
      grid.insertAdjacentHTML('beforeend', result.html);

      // Update offset
      grid.dataset.offset = result.new_offset;

      // Observe newly added cards for fade-in
      observeNewCards(grid);

      if (!result.has_more) {
        // Remove the button entirely
        const wrapper = btn.closest('.vitrina-more');
        if (wrapper) {
          wrapper.remove();
        } else {
          btn.remove();
        }
      } else {
        // Update remaining count
        const total     = parseInt(grid.dataset.total, 10) || 0;
        const newOffset = parseInt(result.new_offset, 10);
        const remaining = Math.max(0, total - newOffset);
        const countEl   = btn.querySelector('.vitrina-more__count');
        const countLabel = btn.dataset.countLabel || 'ещё';
        if (countEl) {
          countEl.textContent = '(' + countLabel + ' ' + remaining + ')';
        }
        btn.dataset.remaining = remaining;

        // Re-enable button
        btn.classList.remove('is-loading');
        btn.disabled = false;
      }
    } catch (err) {
      console.error('Витрина load more error:', err);
      btn.classList.remove('is-loading');
      btn.disabled = false;
    }
  });
})();
