/*
 * DJ Franco — client-side polish
 * Scroll reveal, sticky header shade, marquee pause on hover,
 * marquee content injection, mix card generation (waveform + play button).
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
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

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
    var m = document.querySelectorAll('.djfranco-marquee, .djf-marquee');
    m.forEach(function (el) {
      var track = el.querySelector('.djfranco-marquee__track, .djf-marquee__track');
      if (!track) return;
      el.addEventListener('mouseenter', function () { track.style.animationPlayState = 'paused'; });
      el.addEventListener('mouseleave', function () { track.style.animationPlayState = 'running'; });
    });
  }

  // ---------- Marquee content injection (for empty tracks) ----------
  function initMarqueeContent() {
    var tracks = document.querySelectorAll('[data-djf-marquee="true"]');
    if (!tracks.length) return;
    var items = ['Book Now', 'Weddings', 'Clubs', 'Festivals', 'Corporate', 'Private Events', 'Mind Blowing Sets'];
    var loop = items.concat(items, items);
    var html = loop.map(function (l) {
      return '<span class="djf-marquee__item djfranco-marquee__item">' + l +
             '</span><span class="djf-marquee__dot djfranco-marquee__dot">●</span>';
    }).join('');
    tracks.forEach(function (t) { t.innerHTML = html; });
  }

  // ---------- Mix cards ----------
  var MIXES_HOME = [
    { n:'001', title:'Open Format Vol. 01', sub:'Peak-hour energy. Afrobeats × Amapiano × hip-hop.', tags:['SoundCloud','78 min'], plays:'12.4k plays', date:'Apr 2026' },
    { n:'002', title:'Wedding Showcase',    sub:'How an Oxford Exchange reception is built track by track.', tags:['Mixcloud','62 min'],  plays:'8.1k plays',  date:'Feb 2026' },
    { n:'003', title:'Gators Game-Day',     sub:'UF Basketball arena cuts · tip-off to final buzzer.', tags:['SoundCloud','95 min'],plays:'22.6k plays', date:'Mar 2025' }
  ];
  var MIXES_ALL = MIXES_HOME.concat([
    { n:'004', title:'Afrobeats x Amapiano', sub:'South of the equator · all night.',   tags:['Mixcloud','55 min'],   plays:'6.3k plays',  date:'Jun 2025' },
    { n:'005', title:'Brand Activation',     sub:'Coca-Cola · on-tone, on-cue.',        tags:['SoundCloud','72 min'], plays:'3.9k plays',  date:'May 2025' },
    { n:'006', title:'Timeless Classics',    sub:'R&B, hip-hop, slow jams from the vault.', tags:['Spotify','60 min'],    plays:'15.2k plays', date:'Mar 2025' },
    { n:'007', title:'Dancehall · Vol. 02',  sub:'Yard to dancefloor.',                 tags:['SoundCloud','82 min'], plays:'9.8k plays',  date:'Feb 2025' },
    { n:'008', title:'Armature Works — Live',sub:'Rooftop set · Tampa summer.',          tags:['Mixcloud','68 min'],   plays:'11.7k plays', date:'Jan 2025' },
    { n:'009', title:'Warmup Room',          sub:'Slow burners. 100–120 BPM.',           tags:['Spotify','45 min'],    plays:'4.5k plays',  date:'Dec 2024' }
  ]);

  function waveformHTML(seed) {
    var html = '';
    var x = seed * 9301 + 49297;
    for (var i = 0; i < 60; i++) {
      x = (x * 9301 + 49297) % 233280;
      var h = 20 + (x % 75);
      html += '<i style="height:' + h + '%"></i>';
    }
    return html;
  }

  function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]);
    });
  }

  function mixCard(m, i) {
    var tags = m.tags.map(function (t) {
      return '<span class="djf-mix-card__tag">' + escapeHtml(t) + '</span>';
    }).join('');
    return '<article class="djf-mix-card">' +
      '<div class="djf-mix-card__art">' +
        '<div class="djf-waveform">' + waveformHTML(i + 3) + '</div>' +
        '<button class="djf-mix-card__play" aria-label="Play ' + escapeHtml(m.title) + '">▶</button>' +
        '<span class="djf-mix-card__num">' + escapeHtml(m.n) + '</span>' +
      '</div>' +
      '<div class="djf-mix-card__body">' +
        '<div class="djf-mix-card__meta">' + tags + '</div>' +
        '<h3 class="djf-mix-card__title">' + escapeHtml(m.title) + '</h3>' +
        '<p class="djf-mix-card__sub">' + escapeHtml(m.sub) + '</p>' +
      '</div>' +
      '<div class="djf-mix-card__footer">' +
        '<span>' + escapeHtml(m.date) + '</span>' +
        '<span class="djf-plays">' + escapeHtml(m.plays) + '</span>' +
      '</div>' +
      '</article>';
  }

  function initMixGrids() {
    // Server-rendered grids (mix-grid.php) keep their existing HTML; legacy
    // empty grids fall back to the hardcoded MIXES_HOME / MIXES_ALL data.
    document.querySelectorAll('[data-djf-mix-grid]').forEach(function (grid) {
      if (grid.children.length > 0) return;
      var mode = grid.getAttribute('data-djf-mix-grid');
      var list = (mode === 'home') ? MIXES_HOME : MIXES_ALL;
      grid.innerHTML = list.map(mixCard).join('');
    });
  }

  // ---------- Inline audio playback for mix cards ----------
  function initMixPlayback() {
    var current = null;
    document.querySelectorAll('.djf-mix-card__play[data-djf-play]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var card  = btn.closest('.djf-mix-card');
        var audio = card && card.querySelector('.djf-mix-card__audio');
        if (!audio) return;
        if (current && current !== audio) {
          current.pause();
          var prev = current.closest('.djf-mix-card');
          if (prev) prev.classList.remove('is-playing');
        }
        if (audio.paused) { audio.play(); card.classList.add('is-playing'); current = audio; }
        else              { audio.pause(); card.classList.remove('is-playing'); }
      });
    });
  }

  // ---------- Boot ----------
  function boot() {
    initReveal();
    initHeaderShade();
    initMarqueeContent();
    initMarquee();
    initMixGrids();
    initMixPlayback();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
