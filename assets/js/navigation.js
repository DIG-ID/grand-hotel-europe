import gsap from "gsap";


export function initMegaMenu({ lenis } = {}) {
  const openBtn = document.querySelector(".mega-menu-button-open");
  const closeBtn = document.querySelector(".mega-menu-button-close");
  const mega = document.querySelector(".mega-menu-wrapper");
  if (!openBtn || !closeBtn || !mega) return;

  const overlay = mega.querySelector(".js-mega-overlay");
  const panel = mega.querySelector(".js-mega-panel");
  const items = mega.querySelectorAll(".js-mega-item");

  // Initial state
  gsap.set(mega, { autoAlpha: 0, pointerEvents: "none" });
  gsap.set(panel, { y: -16 });
  gsap.set(items, { y: 12, autoAlpha: 0 });

  const tl = gsap.timeline({
    paused: true,
    defaults: { ease: "power3.out", duration: 0.45 },
  });

  tl
    .to(mega, { autoAlpha: 1, pointerEvents: "auto", duration: 0.2 }, 0)
    .fromTo(overlay, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.2 }, 0)
    .to(panel, { y: 0, duration: 0.45 }, 0)
    .to(items, { y: 0, autoAlpha: 1, stagger: 0.05, duration: 0.35 }, 0.1);

  // Start closed
  tl.reverse(0);

  const setOpenState = (isOpen) => {
    openBtn.setAttribute("aria-expanded", String(isOpen));
    document.documentElement.classList.toggle("overflow-hidden", isOpen);

    if (lenis) isOpen ? lenis.stop() : lenis.start();
  };

  const open = () => {
    console.log("open mega menu");
    if (!tl.reversed()) return; // already open
    setOpenState(true);
    tl.play();
  };

  const close = () => {
    console.log("close mega menu");
    if (tl.reversed()) return; // already closed
    setOpenState(false);
    tl.reverse();
  };

  openBtn.addEventListener("click", open);
  closeBtn.addEventListener("click", close);

  // Opcional: clicar no overlay fecha
  overlay?.addEventListener("click", close);

  // Opcional: ESC fecha
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") close();
  });

  // Importante: quando a animação acaba de fechar, garantir "fechado" no DOM
  tl.eventCallback("onReverseComplete", () => {
    gsap.set(mega, { pointerEvents: "none" });
  });

  // Importante: quando abre, garantir pointer events ativos
  tl.eventCallback("onComplete", () => {
    gsap.set(mega, { pointerEvents: "auto" });
  });
}
