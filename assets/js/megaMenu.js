import gsap from "gsap";

export function initMegaMenu({ lenis } = {}) {
  const openBtn = document.querySelector(".mega-menu-button-open");
  const closeBtn = document.querySelector(".mega-menu-button-close");
  const mega = document.querySelector(".mega-menu-wrapper");
  if (!openBtn || !closeBtn || !mega) return;

  const panelLeft = mega.querySelector(".mega-panel--left");
  const panelRight = mega.querySelector(".mega-panel--right");

  const animatedEls = gsap.utils.toArray(
    mega.querySelectorAll(".mega-menu-button-close, ul.mega-menu > li.menu-item, .mega-menu-language-switcher")
  );

  // ---------------------------
  // Accessibility state + helpers
  // ---------------------------
  let isOpen = false;
  let lastFocusedEl = null;

  if (!mega.id) mega.id = "mega-menu";
  openBtn.setAttribute("aria-controls", mega.id);
  openBtn.setAttribute("aria-expanded", "false");
  mega.setAttribute("aria-hidden", "true");

  const setInert = (el, value) => {
    if ("inert" in el) el.inert = value;
  };

  const getFocusable = (root) => {
    return Array.from(
      root.querySelectorAll(
        'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
      )
    ).filter((el) => !el.hasAttribute("disabled") && !el.getAttribute("aria-hidden"));
  };

  const focusFirstInMega = () => {
    const focusables = getFocusable(mega);
    (focusables[0] || closeBtn || mega).focus?.({ preventScroll: true });
  };

  // ---------------------------
  // open/close setup
  // ---------------------------
  const isPanelRightHidden = () => {
    if (!panelRight) return true;
    const styles = window.getComputedStyle(panelRight);
    return styles.display === "none";
  };

  gsap.set(mega, { autoAlpha: 0, pointerEvents: "none", xPercent: -100 });
  gsap.set(panelLeft, { x: -200 });
  if (panelRight && !isPanelRightHidden()) gsap.set(panelRight, { xPercent: -120 });
  gsap.set(animatedEls, { x: -12, autoAlpha: 0 });

  setInert(mega, true);



  const tl = gsap.timeline({
    paused: true,
    defaults: { ease: "power3.out", duration: 0.75 },
  });

  tl.to(mega, { autoAlpha: 1, pointerEvents: "auto", xPercent: 0, immediateRender: false }, 0)
    .to(panelLeft, { x: 0 }, 0);

  if (!isPanelRightHidden()) {
    tl.to(panelRight, { xPercent: 0 }, 0.2);
  }

  tl.to(animatedEls, { x: 0, autoAlpha: 1, stagger:  { each: 0.05, from: "start" } }, 0.45);

  tl.pause(0);
  tl.reverse();

  // ---------------------------
  // Drilldown setup (menu/submenu panels)
  // ---------------------------
  const drilldown = initMegaMenuDrilldown({
    mega,
    stageSelector: ".mega-panel--left nav",
    mainMenuSelector: "ul.mega-menu",
    submenuSelector: "ul.sub-menu",
    backSelector: ".submenu-back",
  });

  const setOpenState = (nextOpen) => {
    isOpen = nextOpen;
    openBtn.setAttribute("aria-expanded", String(nextOpen));
    mega.setAttribute("aria-hidden", String(!nextOpen));
    setInert(mega, !nextOpen);

    if (lenis) nextOpen ? lenis.stop() : lenis.start();
  };

  const open = () => {
    if (!tl.reversed()) return;

    lastFocusedEl = document.activeElement;
    setOpenState(true);

    // Ensure drilldown is always clean on open
    drilldown.reset(true);

    tl.play();
  };

  const close = () => {
    if (tl.reversed()) return;

    // If submenu is open, animate it back first, then close the mega menu
    if (drilldown.isSubmenuOpen()) {
      drilldown.back(false, () => {
        setOpenState(false);
        tl.reverse();
      });
      return;
    }

    setOpenState(false);
    tl.reverse();
  };

  openBtn.addEventListener("click", open);
  closeBtn.addEventListener("click", close);

  // ---------------------------
  // Unified keyboard handling
  // - Escape: close submenu first, otherwise close mega
  // - Tab: focus trap inside mega when open
  // ---------------------------
  document.addEventListener("keydown", (e) => {
    if (!isOpen) return;

    if (e.key === "Escape") {
      e.preventDefault();
      if (drilldown.isSubmenuOpen()) drilldown.back(false);
      else close();
      return;
    }

    if (e.key === "Tab") {
      const focusables = getFocusable(mega);
      if (!focusables.length) return;

      const first = focusables[0];
      const last = focusables[focusables.length - 1];
      const active = document.activeElement;

      if (e.shiftKey) {
        if (active === first || !mega.contains(active)) {
          e.preventDefault();
          last.focus({ preventScroll: true });
        }
      } else {
        if (active === last) {
          e.preventDefault();
          first.focus({ preventScroll: true });
        }
      }
    }
  });

  tl.eventCallback("onReverseComplete", () => {
    gsap.set(mega, { pointerEvents: "none" });

    if (lastFocusedEl && typeof lastFocusedEl.focus === "function") {
      lastFocusedEl.focus({ preventScroll: true });
    } else {
      openBtn.focus?.({ preventScroll: true });
    }
  });

  tl.eventCallback("onComplete", () => {
    gsap.set(mega, { pointerEvents: "auto" });
    focusFirstInMega();
  });
}

/**
 * Drilldown:
 * Goal:
 * - Animate the whole "main menu panel" out left
 * - Animate the submenu panel in from the right
 *
 * Key trick:
 * - WP nests submenus inside the UL, so translating UL would move submenu too.
 * - We move each submenu out into its own sibling panel inside the stage.
 */
function initMegaMenuDrilldown({
  mega,
  stageSelector = ".mega-panel--left nav",
  mainMenuSelector = "ul.mega-menu",
  submenuSelector = "ul.sub-menu",
  backSelector = ".submenu-back",
} = {}) {
  const stage = mega.querySelector(stageSelector);
  if (!stage) return noopDrilldown();

  const mainUl = stage.querySelector(mainMenuSelector);
  if (!mainUl) return noopDrilldown();

  // Ensure stage is a positioning context
  const computedPos = window.getComputedStyle(stage).position;
  if (computedPos === "static") stage.style.position = "relative";

  const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const dur = prefersReduced ? 0 : 0.65;

  // Wrap the main UL so we can translate it cleanly
  const mainWrap = document.createElement("div");
  mainWrap.className = "mega-drilldown-main";
  mainWrap.style.width = "100%";
  mainWrap.style.position = "relative";

  mainUl.parentNode.insertBefore(mainWrap, mainUl);
  mainWrap.appendChild(mainUl);

  // Build a map: parent LI key -> submenu panel element
  const panelsByKey = new Map();

  const topLis = Array.from(mainUl.children).filter((el) => el.tagName === "LI");
  topLis.forEach((li, index) => {
    // Find direct child submenu without using :scope
    const submenu = Array.from(li.children).find(
      (el) => el.tagName === "UL" && el.classList.contains("sub-menu")
    );
    if (!submenu) return;

    // Stable key (WP provides li.id like "menu-item-52")
    const key = li.id || li.getAttribute("data-drilldown-key") || `drilldown-${index}`;
    if (!li.id) li.setAttribute("data-drilldown-key", key);

    // Create a sibling panel that fills the stage
    const panel = document.createElement("div");
    panel.className = "mega-drilldown-panel";
    panel.dataset.parentKey = key;

    panel.style.position = "absolute";
    panel.style.inset = "0";
    panel.style.width = "100%";

    // Move submenu into its own panel (so it won't inherit mainWrap transforms)
    panel.appendChild(submenu);
    stage.appendChild(panel);

    panelsByKey.set(key, panel);
  });

  // Basic focus management helpers (small but solid)
  const setSubtreeEnabled = (root, enabled) => {
    if (!root) return;

    if ("inert" in root) {
      root.inert = !enabled;
      root.setAttribute("aria-hidden", String(!enabled));
      return;
    }

    root.setAttribute("aria-hidden", String(!enabled));
    const focusables = root.querySelectorAll(
      'a[href], button, input, select, textarea, [tabindex]'
    );
    focusables.forEach((el) => {
      if (!enabled) {
        if (!el.hasAttribute("data-orig-tabindex")) {
          const orig = el.getAttribute("tabindex");
          el.setAttribute("data-orig-tabindex", orig === null ? "" : orig);
        }
        el.setAttribute("tabindex", "-1");
      } else {
        const orig = el.getAttribute("data-orig-tabindex");
        if (orig !== null) {
          el.removeAttribute("data-orig-tabindex");
          if (orig === "") el.removeAttribute("tabindex");
          else el.setAttribute("tabindex", orig);
        } else {
          el.removeAttribute("tabindex");
        }
      }
    });
  };

  const focusFirstIn = (root) => {
    const el = root.querySelector('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])');
    el?.focus?.({ preventScroll: true });
  };

  // Initial states
  gsap.set(mainWrap, { xPercent: 0, autoAlpha: 1, pointerEvents: "auto" });
  setSubtreeEnabled(mainWrap, true);

  panelsByKey.forEach((panel) => {
    gsap.set(panel, { xPercent: 100, autoAlpha: 0, pointerEvents: "none" });
    setSubtreeEnabled(panel, false);
  });

  let activePanel = null;
  let activeKey = null;
  let animating = false;
  let lastTrigger = null;

  const openPanel = (key, triggerEl) => {
    if (animating || activePanel) return;

    const panel = panelsByKey.get(key);
    if (!panel) return;

    animating = true;
    activePanel = panel;
    activeKey = key;
    lastTrigger = triggerEl || null;

    // Disable main focus while submenu is open
    setSubtreeEnabled(mainWrap, false);

    // Enable submenu panel
    setSubtreeEnabled(panel, true);
    gsap.set(panel, { pointerEvents: "auto", autoAlpha: 1, xPercent: 100 });

    gsap.timeline({
      defaults: { ease: "power3.out", duration: dur },
      onComplete: () => {
        gsap.set(mainWrap, { pointerEvents: "none" });
        animating = false;
        focusFirstIn(panel);
      },
    })
      .to(mainWrap, { xPercent: -100, autoAlpha: 0 }, 0)
      .to(panel, { xPercent: 0, autoAlpha: 1 }, 0);
  };

  const back = (immediate = false, onDone) => {
    if (animating || !activePanel) return;

    animating = true;
    const panel = activePanel;

    // Enable main again
    setSubtreeEnabled(mainWrap, true);

    // Disable submenu focus as it closes
    setSubtreeEnabled(panel, false);

    gsap.timeline({
      defaults: { ease: "power3.out", duration: immediate ? 0 : dur },
      onComplete: () => {
        gsap.set(panel, { pointerEvents: "none", autoAlpha: 0, xPercent: 100 });
        gsap.set(mainWrap, { pointerEvents: "auto", autoAlpha: 1, xPercent: 0 });

        activePanel = null;
        activeKey = null;
        animating = false;

        if (typeof onDone === "function") onDone();
        else if (lastTrigger?.focus) lastTrigger.focus({ preventScroll: true });
      },
    })
      .to(panel, { xPercent: 100, autoAlpha: 0 }, 0)
      .to(mainWrap, { xPercent: 0, autoAlpha: 1 }, 0);
  };


  const reset = (immediate = true) => {
    // Close submenu instantly and restore main instantly
    if (activePanel) back(true);

    gsap.killTweensOf([mainWrap, ...panelsByKey.values()]);
    gsap.set(mainWrap, { xPercent: 0, autoAlpha: 1, pointerEvents: "auto" });
    setSubtreeEnabled(mainWrap, true);

    panelsByKey.forEach((panel) => {
      gsap.set(panel, { xPercent: 100, autoAlpha: 0, pointerEvents: "none" });
      setSubtreeEnabled(panel, false);
    });

    activePanel = null;
    activeKey = null;
    animating = false;
    lastTrigger = null;

    // immediate param is kept for API symmetry (we already reset instantly)
    void immediate;
  };

  // Events (delegation)
  stage.addEventListener("click", (e) => {
    const t = e.target;

    if (t.closest(backSelector)) {
      e.preventDefault();
      back(false);
      return;
    }

    // Only intercept top-level clicks (LI parent is the main UL)
    const link = t.closest("a");
    if (!link) return;

    const li = link.closest("li");
    if (!li || li.parentElement !== mainUl) return;

    const key = li.id || li.getAttribute("data-drilldown-key");
    if (!key || !panelsByKey.has(key)) return;

    // Parent opens submenu (you have the real link inside submenu)
    e.preventDefault();
    openPanel(key, link);
  });

  stage.addEventListener("keydown", (e) => {
    const isActivateKey = e.key === "Enter" || e.key === " ";
    if (!isActivateKey) return;

    const link = e.target.closest?.("a");
    if (!link) return;

    const li = link.closest("li");
    if (!li || li.parentElement !== mainUl) return;

    const key = li.id || li.getAttribute("data-drilldown-key");
    if (!key || !panelsByKey.has(key)) return;

    e.preventDefault();
    openPanel(key, link);
  });

  return {
    reset,
    back,
    isSubmenuOpen: () => Boolean(activePanel),
  };
}

function noopDrilldown() {
  return {
    reset: () => {},
    back: () => {},
    isSubmenuOpen: () => false,
  };
}

document.addEventListener("DOMContentLoaded", () => {
  initMegaMenu();
});
