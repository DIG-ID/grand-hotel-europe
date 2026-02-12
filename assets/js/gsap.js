import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Lenis from "lenis";

gsap.registerPlugin(ScrollTrigger);

const gheEaseExpoOut = (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));

let gheLenis;
let tickerCallback;

export function gheInitLenisCinematic() {
  if (gheLenis) return gheLenis;

  const reduceMotion =
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  gheLenis = new Lenis({
    duration: reduceMotion ? 0 : 1.35,
    easing: reduceMotion ? (t) => t : gheEaseExpoOut,
    smoothWheel: !reduceMotion,
    wheelMultiplier: 0.85,
    touchMultiplier: 1,
  });

  gheLenis.on("scroll", ScrollTrigger.update);

  tickerCallback = (time) => gheLenis.raf(time * 1000);
  gsap.ticker.add(tickerCallback);
  gsap.ticker.lagSmoothing(0);

  // keep Lenis size in sync
  ScrollTrigger.addEventListener("refresh", () => gheLenis.resize());

  return gheLenis;
}

export function initTravelBannerParallax() {
  const el = document.querySelector("#section-travel-banner");
  if (!el) return;

  // Ensure a known starting point
  gsap.set(el, { backgroundPosition: "center 0%" });

  gsap.to(el, {
    backgroundPositionY: "40%", // more reliable than full backgroundPosition string
    ease: "none",
    scrollTrigger: {
      trigger: el,
      start: "top bottom",
      end: "bottom top",
      scrub: true,
      invalidateOnRefresh: true,
    },
  });
}

if (typeof window !== "undefined") {
  gheInitLenisCinematic();
  ScrollTrigger.refresh();
  window.addEventListener("load", () => ScrollTrigger.refresh());
}

// Fixed Booking Button
document.addEventListener("DOMContentLoaded", () => {
  const fixedButton = document.querySelector(".fixed-booking-button");
  const footer = document.querySelector(".section-outro--cta-box"); // ajusta o seletor se precisares

  if (!fixedButton || !footer) return;

  const triggerPosition = 10;
  let isVisible = false;

  let pastThreshold = false;
  let footerBlocking = false;

  const lenis = gheInitLenisCinematic();

  const updateVisibility = () => {
    const shouldShow = pastThreshold && !footerBlocking;
    if (shouldShow === isVisible) return;
    isVisible = shouldShow;

    gsap.to(fixedButton, {
      autoAlpha: shouldShow ? 1 : 0,
      y: shouldShow ? 0 : 48,
      duration: 0.6,
      overwrite: "auto",
    });
  };

  // Regra 1: aparece depois de X px
  lenis.on("scroll", ({ scroll }) => {
    pastThreshold = scroll > triggerPosition;
    updateVisibility();
  });

  // Regra 2: desaparece quando chega ao footer
  ScrollTrigger.create({
    trigger: footer,

    // Opção A (mais comum): esconde quando o footer ENTRA no viewport
    start: "top bottom",

    // Se quiseres que só esconda quando o topo do footer chegar ao TOPO do viewport:
    // start: "top top",

    onEnter: () => {
      footerBlocking = true;
      updateVisibility();
    },
    onLeaveBack: () => {
      footerBlocking = false;
      updateVisibility();
    },
  });

  // garante medidas certas
  ScrollTrigger.refresh();
});


function gheBindLenisAnchorScroll() {
  const lenis = gheInitLenisCinematic();

  document.addEventListener("click", (e) => {
    const link = e.target.closest('a[data-lenis-scroll-to]');
    if (!link) return;

    const selector = link.getAttribute("data-lenis-scroll-to");
    const target = document.querySelector(selector);
    if (!target) return;

    e.preventDefault();

    // Lenis smooth scroll
    lenis.scrollTo(target, {
      offset: -80,          // adjust if you have a sticky header (e.g. -80)
      duration: 1.35,     // optional override
      easing: (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t)), // optional
    });
  });
}

gheBindLenisAnchorScroll();