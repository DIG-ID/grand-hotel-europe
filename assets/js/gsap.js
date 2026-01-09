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

// ---- init order matters ----
gheInitLenisCinematic();
initTravelBannerParallax();

// refresh AFTER everything is created
ScrollTrigger.refresh();

// optional: once images/fonts are loaded, refresh again for perfect measurements
window.addEventListener("load", () => ScrollTrigger.refresh());
