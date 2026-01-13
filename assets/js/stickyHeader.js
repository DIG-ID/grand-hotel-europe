// resources/js/features/grandHotelEurope-sticky-header.js
// -----------------------------------------------------------
// grandHotelEurope: Sticky header body class toggler (direction + threshold)
// - Vanilla JS, rAF-throttled, passive listeners
// - Self-contained: no external options, auto-inits on import
// - Plays nice with Lenis if present; robust on refresh mid-page & bfcache
// - WordPress theme prefix: "grandHotelEurope"
// -----------------------------------------------------------


(function grandHotelEuropeStickyHeaderIIFE() {
  if (window.__grandHotelEuropeStickyHeaderInit) return;
  window.__grandHotelEuropeStickyHeaderInit = true;

  const cfg = {
    headerSelector: ".header-main",
    threshold: null,     // header height fallback
    dirDelta: 4,
    topEpsilon: 1,
    footerSelector: ".footer-main",
    footerTriggerMargin: 700, // px before footer enters view to start hiding
  };

  const body = document.body;
  if (!body) return;

  const header = document.querySelector(cfg.headerSelector);
  const footer = document.querySelector(cfg.footerSelector);

  // --- Threshold (avoid mixing ?? with ||) ---------------------------------
  let dynamicThreshold = Number.isFinite(cfg.threshold)
    ? Number(cfg.threshold)
    : ((header && header.getBoundingClientRect().height) || 64);

  // State
  let lastY = 0;
  let lastDir = 0; // -1 up, +1 down
  let ticking = false;

  // Footer fallback state (when no IO support)
  let footerTopAbs = null;
  let useFooterFallback = false;

  // Helpers
  const clampY = (y) => Math.max(0, y | 0);

  function grandHotelEuropeApplyState(y) {
    const atTop = y <= cfg.topEpsilon;
    const beyond = y > dynamicThreshold;
    body.classList.toggle("at-top", atTop);
    body.classList.toggle("is-scrolled", beyond || (!atTop && y > 0));
  }

  function grandHotelEuropeApplyDirection(y) {
    const dy = y - lastY;
    if (Math.abs(dy) <= cfg.dirDelta) return;
    const dir = dy > 0 ? 1 : -1;
    if (dir !== lastDir) {
      lastDir = dir;
      body.classList.toggle("scroll-dir-down", dir === 1);
      body.classList.toggle("scroll-dir-up", dir === -1);
    }
    lastY = y;
  }

  function grandHotelEuropeMeasure() {
    if (!Number.isFinite(cfg.threshold)) {
      const h = header && header.getBoundingClientRect().height;
      if (h && h > 0) dynamicThreshold = h;
    }
    // Recompute footer absolute top if using fallback
    if (useFooterFallback && footer) {
      const rect = footer.getBoundingClientRect();
      footerTopAbs = (window.pageYOffset || 0) + rect.top;
    }
  }

  // --- Footer observer (prefer IO, fall back if unsupported) ---------------
  if (footer && "IntersectionObserver" in window) {
    // When any part of the footer is visible (with an early trigger margin),
    // toggle grandHotelEurope-at-footer
    const io = new IntersectionObserver(
      (entries) => {
        const near = entries.some((e) => e.isIntersecting);
        body.classList.toggle("at-footer", near);
      },
      {
        root: null,
        threshold: 0,
        // Start "near footer" a bit earlier so the header hides before overlapping
        rootMargin: `0px 0px -${cfg.footerTriggerMargin}px 0px`,
      }
    );
    io.observe(footer);
  } else if (footer) {
    // Fallback: compute based on scroll position
    useFooterFallback = true;
    const rect = footer.getBoundingClientRect();
    footerTopAbs = (window.pageYOffset || 0) + rect.top;
  }

  function grandHotelEuropeUpdate(yRaw) {
    const y =
      Number.isFinite(yRaw) ? clampY(yRaw) :
      clampY(window.scrollY || window.pageYOffset || 0);

    grandHotelEuropeApplyState(y);
    grandHotelEuropeApplyDirection(y);

    // Footer fallback: set grandHotelEurope-at-footer when viewport bottom reaches footer
    if (useFooterFallback && footerTopAbs != null) {
      const viewBottom =
        y + (window.innerHeight || document.documentElement.clientHeight || 0);
      const near = viewBottom >= (footerTopAbs - cfg.footerTriggerMargin);
      body.classList.toggle("at-footer", !!near);
    }

    ticking = false;
  }

  function grandHotelEuropeOnScroll(yFromAdapter) {
    if (!ticking) {
      ticking = true;
      window.requestAnimationFrame(() => grandHotelEuropeUpdate(yFromAdapter));
    }
  }

  // Initial
  grandHotelEuropeMeasure();
  grandHotelEuropeUpdate();

  // Native scroll
  window.addEventListener("scroll", () => grandHotelEuropeOnScroll(), { passive: true });

  // Resize/layout changes
  window.addEventListener("resize", () => { grandHotelEuropeMeasure(); grandHotelEuropeOnScroll(); }, { passive: true });

  // bfcache restore
  window.addEventListener("pageshow", (e) => {
    if (e.persisted) {
      grandHotelEuropeMeasure();
      grandHotelEuropeOnScroll();
    }
  }, { passive: true });

  // Lenis integration (optional)
  if (window.lenis && typeof window.lenis.on === "function") {
    window.lenis.on("scroll", ({ scroll }) => grandHotelEuropeOnScroll(scroll));
  }

  // Manual refresh if needed
  window.grandHotelEuropeStickyHeaderRefresh = function () {
    grandHotelEuropeMeasure();
    grandHotelEuropeOnScroll();
  };
})();