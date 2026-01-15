(function simpleStickyHeader() {
  // 1. Configurações básicas
  const header = document.querySelector('.header-main');
  const body = document.body;
  
  if (!header) return;

  let lastScrollY = window.scrollY;
  let ticking = false;

  // Medimos a altura do header para saber quando ele deve "mudar"
  const headerHeight = header.offsetHeight;

  function updateHeader() {
    const currentScrollY = window.scrollY;

    // A) Estamos no topo? (Menos de 10px para ser mais responsivo)
    if (currentScrollY < 10) {
      body.classList.add('at-top');
      body.classList.remove('is-scrolled', 'scroll-dir-up', 'scroll-dir-down');
    } else {
      body.classList.remove('at-top');
      body.classList.add('is-scrolled');

      // B) Direção do Scroll (Para baixo ou para cima)
      if (currentScrollY > lastScrollY) {
        // A descer
        body.classList.add('scroll-dir-down');
        body.classList.remove('scroll-dir-up');
      } else {
        // A subir
        body.classList.add('scroll-dir-up');
        body.classList.remove('scroll-dir-down');
      }
    }

    lastScrollY = currentScrollY;
    ticking = false;
  }

  // 2. Otimização leve: só corre quando o browser vai desenhar a página
  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(updateHeader);
      ticking = true;
    }
  }, { passive: true });

  // 3. Reset se a janela mudar de tamanho
  window.addEventListener('resize', () => {
    updateHeader();
  }, { passive: true });

  // Executa uma vez ao carregar para definir o estado inicial
  updateHeader();
})();