/*
 * DJ Franco — client-side polish
 * Scroll reveal, sticky header shade, marquee pause on hover.
 * Respects prefers-reduced-motion.
 */
(function () {
  'use strict';

  var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ---------- Scroll reveal ----------
  function initReveal() {
    var targets = document.querySelectorAll('.djfranco-reveal');
    if (!targets.length) return;

    if (reduced || !('IntersectionObserver' in window)) {
      targets.forEach(function (el) { el.classList.add('is-visible'); });
      return;
    }

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, {
      rootMargin: '0px 0px -8% 0px',
      threshold: 0.08
    });

    targets.forEach(function (el) { io.observe(el); });
  }

  // ---------- Sticky header state ----------
  function initHeaderShade() {
    var header = document.querySelector('.site-header');
    if (!header) return;
    var onScroll = function () {
      if (window.scrollY > 4) header.classList.add('is-scrolled');
      else header.classList.remove('is-scrolled');
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // ---------- Marquee pause on hover ----------
  function initMarquee() {
    var m = document.querySelectorAll('.djfranco-marquee');
    m.forEach(function (el) {
      var track = el.querySelector('.djfranco-marquee__track');
      if (!track) return;
      el.addEventListener('mouseenter', function () { track.style.animationPlayState = 'paused'; });
      el.addEventListener('mouseleave', function () { track.style.animationPlayState = 'running'; });
    });
  }

  // ---------- Boot ----------
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      initReveal();
      initHeaderShade();
      initMarquee();
    });
  } else {
    initReveal();
    initHeaderShade();
    initMarquee();
  }
})();
