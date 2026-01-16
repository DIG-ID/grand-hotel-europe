/**
 * Drilldown submenu animation (no parent UL translate!)
 * Why: WP submenus are nested inside the main UL, so moving the UL would also move the submenu.
 * Strategy:
 * - Keep main UL fixed in place
 * - Animate ONLY top-level triggers (direct children) out to the left + fade
 * - Animate submenu panel from right (xPercent: 100) to center (xPercent: 0)
 * - Accessibility: disable tabbing on top-level triggers while submenu is open; enable submenu focusables
 */
function initMegaMenuDrilldown({
  mega,
  panelSelector = ".mega-panel--left",
  mainMenuSelector = "ul.mega-menu",
  submenuSelector = "ul.sub-menu",
  backSelector = ".submenu-back",
} = {}) {
  const panel = mega.querySelector(panelSelector);
  if (!panel) return { reset: () => {}, canGoBack: () => false, goBack: () => {} };

  const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const dur = prefersReduced ? 0 : 0.55;

  // Stage (recommended container). Falls back to panel if missing.
  const stage = panel.querySelector(".menu-mega-menu-container") || panel;

  const main = stage.querySelector(mainMenuSelector);
  if (!main) return { reset: () => {}, canGoBack: () => false, goBack: () => {} };

  // Important: only submenus inside THIS menu
  const submenus = Array.from(main.querySelectorAll(submenuSelector));

  let activeSubmenu = null;
  let animating = false;
  let lastTrigger = null;

  // ---------------------------
  // Helpers
  // ---------------------------
  const getDirectChild = (parent, tagNames = ["A", "BUTTON"]) => {
    return Array.from(parent.children).find((el) => tagNames.includes(el.tagName)) || null;
  };

  const getTopLevelLis = () =>
    Array.from(main.children).filter((el) => el.tagName === "LI");

  const getTopLevelTriggers = () =>
    getTopLevelLis()
      .map((li) => getDirectChild(li))
      .filter(Boolean);

  const getDirectChildSubmenu = (li) => {
    return Array.from(li.children).find(
      (el) => el.classList && el.classList.contains("sub-menu")
    );
  };

  const getFocusable = (root) =>
    Array.from(
      root.querySelectorAll(
        'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
      )
    ).filter((el) => !el.hasAttribute("disabled") && !el.getAttribute("aria-hidden"));

  const setFocusableEnabled = (elements, enabled) => {
    elements.forEach((el) => {
      if (!enabled) {
        if (!el.hasAttribute("data-orig-tabindex")) {
          const orig = el.getAttribute("tabindex");
          el.setAttribute("data-orig-tabindex", orig === null ? "" : orig);
        }
        el.setAttribute("tabindex", "-1");
        el.setAttribute("aria-hidden", "true");
      } else {
        const orig = el.getAttribute("data-orig-tabindex");
        el.removeAttribute("aria-hidden");

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

  const setSubmenuFocusable = (submenu, enabled) => {
    // Use inert when available (best)
    if ("inert" in submenu) {
      submenu.inert = !enabled;
      submenu.setAttribute("aria-hidden", String(!enabled));
      return;
    }

    submenu.setAttribute("aria-hidden", String(!enabled));
    const focusables = getFocusable(submenu);
    setFocusableEnabled(focusables, enabled);
  };

  const setSubmenuState = (submenu, { xPercent, visible, clickable }) => {
    gsap.set(submenu, {
      xPercent,
      autoAlpha: visible ? 1 : 0,
      pointerEvents: clickable ? "auto" : "none",
    });
  };

  const focusFirstInSubmenu = (submenu) => {
    const focusables = getFocusable(submenu);
    (focusables[0] || submenu).focus?.({ preventScroll: true });
  };

  // ---------------------------
  // Initial state
  // ---------------------------
  const topTriggers = getTopLevelTriggers();

  // Main triggers are visible (we never translate the main UL)
  gsap.set(topTriggers, { x: 0, autoAlpha: 1, pointerEvents: "auto" });
  setFocusableEnabled(topTriggers, true);

  // Submenus start hidden to the right
  submenus.forEach((sm) => {
    setSubmenuState(sm, { xPercent: 100, visible: false, clickable: false });
    setSubmenuFocusable(sm, false);
  });

  // ---------------------------
  // Open submenu
  // ---------------------------
  const openSubmenu = (submenu, triggerEl) => {
    if (!submenu || animating || activeSubmenu) return;
    animating = true;

    activeSubmenu = submenu;
    lastTrigger = triggerEl || null;

    // Disable top-level triggers while in submenu
    setFocusableEnabled(topTriggers, false);
    gsap.set(topTriggers, { pointerEvents: "none" });

    // Prepare submenu
    setSubmenuState(submenu, { xPercent: 100, visible: true, clickable: true });
    setSubmenuFocusable(submenu, true);

    const submenuLis = Array.from(submenu.children).filter((el) => el.tagName === "LI");
    gsap.set(submenuLis, { autoAlpha: 0 });

    // Disable CSS transitions during GSAP for smoothness (Tailwind often adds transition-all)
    gsap.set(topTriggers, { willChange: "transform,opacity", transition: "none" });
    gsap.set(submenu, { willChange: "transform,opacity" });

    gsap.timeline({
      defaults: { ease: "power3.out", duration: dur },
      onComplete: () => {
        // Keep main visually hidden (triggers only), submenu visible
        gsap.set(topTriggers, { willChange: "auto", clearProps: "transition" });
        gsap.set(submenu, { willChange: "auto" });

        animating = false;
        focusFirstInSubmenu(submenu);
      },
    })
      // Main "slides" left by animating only the top-level triggers (not the UL)
      .to(topTriggers, { x: -28, autoAlpha: 0, stagger: 0.02, duration: dur * 0.75 }, 0)
      // Submenu panel comes in from the right
      .to(submenu, { xPercent: 0, autoAlpha: 1 }, 0)
      // Smooth: fade submenu items in
      .to(submenuLis, { autoAlpha: 1, stagger: 0.02, duration: dur * 0.75 }, dur * 0.15);
  };

  // ---------------------------
  // Back to main
  // ---------------------------
  const goBack = (immediate = false) => {
    if (!activeSubmenu || animating) return;
    animating = true;

    const submenu = activeSubmenu;
    const submenuLis = Array.from(submenu.children).filter((el) => el.tagName === "LI");

    // Disable submenu focus as it leaves
    setSubmenuFocusable(submenu, false);

    // Prepare main triggers to come back
    gsap.set(topTriggers, { x: -28, autoAlpha: 0, pointerEvents: "auto", willChange: "transform,opacity", transition: "none" });

    gsap.timeline({
      defaults: { ease: "power3.out", duration: immediate ? 0 : dur },
      onComplete: () => {
        // Hide submenu off to the right again
        setSubmenuState(submenu, { xPercent: 100, visible: false, clickable: false });

        // Enable main triggers again
        setFocusableEnabled(topTriggers, true);
        gsap.set(topTriggers, { pointerEvents: "auto", willChange: "auto", clearProps: "transition" });

        activeSubmenu = null;
        animating = false;

        // Restore focus to the trigger that opened the submenu (best UX)
        if (lastTrigger?.focus) lastTrigger.focus({ preventScroll: true });
      },
    })
      .to(submenuLis, { autoAlpha: 0, stagger: 0.015, duration: (immediate ? 0 : dur) * 0.6 }, 0)
      .to(submenu, { xPercent: 100, autoAlpha: 0 }, 0)
      .to(topTriggers, { x: 0, autoAlpha: 1, stagger: 0.02, duration: (immediate ? 0 : dur) * 0.75 }, (immediate ? 0 : dur) * 0.1);
  };

  // ---------------------------
  // Reset (called on mega open/close)
  // ---------------------------
  const reset = () => {
    gsap.killTweensOf([topTriggers, ...submenus]);

    gsap.set(topTriggers, { x: 0, autoAlpha: 1, pointerEvents: "auto", clearProps: "transition,willChange" });
    setFocusableEnabled(topTriggers, true);

    submenus.forEach((sm) => {
      setSubmenuState(sm, { xPercent: 100, visible: false, clickable: false });
      setSubmenuFocusable(sm, false);
      gsap.set(Array.from(sm.children).filter((el) => el.tagName === "LI"), { autoAlpha: 1 });
    });

    activeSubmenu = null;
    animating = false;
    lastTrigger = null;
  };

  // ---------------------------
  // Events
  // ---------------------------
  stage.addEventListener("click", (e) => {
    const t = e.target;

    // Back item
    if (t.closest(backSelector)) {
      e.preventDefault();
      goBack(false);
      return;
    }

    // Only handle clicks on top-level links that have a submenu
    const link = t.closest("a");
    if (!link) return;

    const li = link.closest(".menu-item-has-children");
    if (!li || !main.contains(li)) return;

    const submenu = getDirectChildSubmenu(li);
    if (!submenu) return;

    // Parent link opens submenu (you have the real link duplicated inside the submenu)
    e.preventDefault();
    openSubmenu(submenu, link);
  });

  // Keyboard support: Enter/Space on parent link opens submenu
  stage.addEventListener("keydown", (e) => {
    const isActivateKey = e.key === "Enter" || e.key === " ";
    if (!isActivateKey) return;

    const link = e.target.closest?.("a");
    if (!link) return;

    const li = link.closest(".menu-item-has-children");
    if (!li || !main.contains(li)) return;

    const submenu = getDirectChildSubmenu(li);
    if (!submenu) return;

    e.preventDefault();
    openSubmenu(submenu, link);
  });

  return {
    reset: () => reset(),
    canGoBack: () => Boolean(activeSubmenu),
    goBack: (immediate = false) => goBack(immediate),
  };
}
