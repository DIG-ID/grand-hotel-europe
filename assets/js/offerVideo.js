/**
 * Offer section video (template-parts/pages/home/offer.php).
 *
 * Starts paused on the poster; the visitor's click starts it with sound
 * (browsers block sound on videos that start by themselves). After the first
 * play, custom Vimeo-like controls take over: play/pause, seek, time,
 * mute + volume fader and fullscreen.
 */

const formatTime = (seconds) => {
  if (!Number.isFinite(seconds)) return '0:00';
  const m = Math.floor(seconds / 60);
  const s = Math.floor(seconds % 60);
  return `${m}:${String(s).padStart(2, '0')}`;
};

// Fill the left part of a range input (styled in _home.sass via --fill).
const setFill = (input) => {
  const min = Number(input.min) || 0;
  const max = Number(input.max) || 1;
  input.style.setProperty('--fill', `${((input.value - min) / (max - min)) * 100}%`);
};

const initOfferVideo = (wrapper) => {
  const video = wrapper.querySelector('video');
  const start = wrapper.querySelector('[data-offer-start]');
  const controls = wrapper.querySelector('[data-offer-controls]');
  const toggle = wrapper.querySelector('[data-offer-toggle]');
  const progress = wrapper.querySelector('[data-offer-progress]');
  const time = wrapper.querySelector('[data-offer-time]');
  const mute = wrapper.querySelector('[data-offer-mute]');
  const volume = wrapper.querySelector('[data-offer-volume]');
  const fullscreen = wrapper.querySelector('[data-offer-fullscreen]');
  if (!video || !start || !controls) return;

  let seeking = false;

  // iOS ignores video.volume (hardware buttons only): hide the fader there.
  video.volume = 0.5;
  if (video.volume !== 0.5) wrapper.classList.add('no-volume');
  video.volume = 1;

  const syncPlayState = () => {
    const playing = !video.paused && !video.ended;
    wrapper.classList.toggle('is-paused', !playing);
    toggle.setAttribute('aria-label', playing ? toggle.dataset.labelPause : toggle.dataset.labelPlay);
  };

  const syncVolume = () => {
    const silent = video.muted || video.volume === 0;
    wrapper.classList.toggle('is-muted', silent);
    mute.setAttribute('aria-label', silent ? mute.dataset.labelUnmute : mute.dataset.labelMute);
    volume.value = video.muted ? 0 : video.volume;
    setFill(volume);
  };

  const syncTime = () => {
    if (!seeking && video.duration) {
      progress.value = (video.currentTime / video.duration) * 1000;
      setFill(progress);
    }
    time.textContent = formatTime(video.duration ? video.duration - video.currentTime : 0);
  };

  start.addEventListener('click', () => {
    wrapper.classList.add('is-started');
    start.remove();
    controls.hidden = false;
    video.play();
    toggle.focus();
  });

  toggle.addEventListener('click', () => (video.paused ? video.play() : video.pause()));
  // A click on the picture itself also plays/pauses, as on Vimeo.
  video.addEventListener('click', () => {
    if (wrapper.classList.contains('is-started')) toggle.click();
  });

  progress.addEventListener('input', () => {
    seeking = true;
    setFill(progress);
    if (video.duration) {
      video.currentTime = (progress.value / 1000) * video.duration;
    }
  });
  progress.addEventListener('change', () => {
    seeking = false;
  });

  mute.addEventListener('click', () => {
    if (video.muted || video.volume === 0) {
      video.muted = false;
      if (video.volume === 0) video.volume = 1;
    } else {
      video.muted = true;
    }
  });

  volume.addEventListener('input', () => {
    video.volume = Number(volume.value);
    video.muted = video.volume === 0;
  });

  fullscreen.addEventListener('click', () => {
    if (document.fullscreenElement) {
      document.exitFullscreen();
    } else if (wrapper.requestFullscreen) {
      wrapper.requestFullscreen();
    } else if (video.webkitEnterFullscreen) {
      // iOS Safari: only the video element can go fullscreen (native player).
      video.webkitEnterFullscreen();
    }
  });
  document.addEventListener('fullscreenchange', () => {
    wrapper.classList.toggle('is-fullscreen', document.fullscreenElement === wrapper);
  });

  video.addEventListener('play', syncPlayState);
  video.addEventListener('pause', syncPlayState);
  video.addEventListener('ended', syncPlayState);
  video.addEventListener('timeupdate', syncTime);
  video.addEventListener('loadedmetadata', syncTime);
  video.addEventListener('volumechange', syncVolume);

  syncPlayState();
  syncVolume();
  syncTime();
};

// WP Rocket's "Delay JavaScript execution" can run this after DOMContentLoaded.
const boot = () => document.querySelectorAll('[data-offer-video]').forEach(initOfferVideo);
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', boot);
} else {
  boot();
}
