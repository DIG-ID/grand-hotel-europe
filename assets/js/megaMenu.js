import gsap from "gsap";


export function initMegaMenu({ lenis } = {}) {
  const openBtn = document.querySelector(".mega-menu-button-open");
  const closeBtn = document.querySelector(".mega-menu-button-close");
  const mega = document.querySelector(".mega-menu-wrapper");
  if (!openBtn || !closeBtn || !mega) return;

  const panelLeft = mega.querySelector(".mega-panel--left");
  const panelRight = mega.querySelector(".mega-panel--right");
  const items = mega.querySelectorAll(".js-mega-item");

  // IMPORTANT: Force the real initial (closed) state with GSAP to avoid CSS/JS race conditions
  gsap.set(mega, { autoAlpha: 0, pointerEvents: "none", xPercent: -100 });
  gsap.set(panelLeft, { x: -200 });
  gsap.set(panelRight, { xPercent: -120 });
  gsap.set(items, { x: -12, autoAlpha: 0 });

  const tl = gsap.timeline({
    paused: true,
    defaults: { ease: "power3.out", duration: 0.75 },
  });

  tl.to(mega, { autoAlpha: 1, pointerEvents: "auto", xPercent: 0, immediateRender: false }, 0)
    .to(panelLeft, { x: 0 }, 0)
    .to(panelRight, { xPercent: 0 }, 0.2)
    .to(items, { x: 0, autoAlpha: 1, stagger: 0.05, duration: 0.35 }, 0.45);

  // Start closed (now it's guaranteed)
  tl.pause(0);
  tl.reverse();

  const setOpenState = (isOpen) => {
    openBtn.setAttribute("aria-expanded", String(isOpen));
    //document.documentElement.classList.toggle("overflow-hidden", isOpen);
    if (lenis) isOpen ? lenis.stop() : lenis.start();
  };

  const open = () => {
    if (!tl.reversed()) return;
    setOpenState(true);
    tl.play();
  };

  const close = () => {
    if (tl.reversed()) return;
    setOpenState(false);
    tl.reverse();
  };

  openBtn.addEventListener("click", open);
  closeBtn.addEventListener("click", close);

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") close();
  });

  tl.eventCallback("onReverseComplete", () => {
    gsap.set(mega, { pointerEvents: "none" });
  });

  tl.eventCallback("onComplete", () => {
    gsap.set(mega, { pointerEvents: "auto" });
  });
}
document.addEventListener("DOMContentLoaded", () => {
  initMegaMenu();
});