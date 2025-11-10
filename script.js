// Acessibilidade: contraste, ajuste de fonte e mensagens sonoras (pt-BR)
(function(){
  const body = document.body;

  function speak(text){
    try {
      const msg = new SpeechSynthesisUtterance(text);
      msg.lang = 'pt-BR';
      window.speechSynthesis.cancel();
      window.speechSynthesis.speak(msg);
    } catch(e){ console.log('Speech error', e); }
  }

  const contrastBtn = document.getElementById('a11y-contrast');
  if (contrastBtn){
    contrastBtn.addEventListener('click', function(){
      const enabled = body.classList.toggle('high-contrast');
      const msg = enabled ? 'Modo alto contraste ativado' : 'Modo alto contraste desativado';
      const liveEl = document.getElementById('a11y-live');
      if (liveEl) liveEl.textContent = msg;
      speak(msg);
      contrastBtn.setAttribute('aria-pressed', enabled ? 'true':'false');
      localStorage.setItem('salon_jo_contrast', body.classList.contains('high-contrast') ? '1' : '0');
    });
  }

  const increaseBtn = document.getElementById('a11y-increase');
  const decreaseBtn = document.getElementById('a11y-decrease');
  const sizes = ['font-size-1','font-size-2','font-size-3','font-size-4'];
  let current = 1;
  function applySize(idx){
    sizes.forEach(c => body.classList.remove(c));
    body.classList.add(sizes[idx]);
    const liveEl = document.getElementById('a11y-live');
    if (liveEl) liveEl.textContent = 'Tamanho da fonte ajustado';
  }
  if (increaseBtn){
    increaseBtn.addEventListener('click', function(){
      if (current < sizes.length - 1) current++;
      applySize(current);
      speak('Fonte aumentada');
      localStorage.setItem('salon_jo_font_idx', current);
    });
  }
  if (decreaseBtn){
    decreaseBtn.addEventListener('click', function(){
      if (current > 0) current--;
      applySize(current);
      speak('Fonte diminuída');
      localStorage.setItem('salon_jo_font_idx', current);
    });
  }

  const savedContrast = localStorage.getItem('salon_jo_contrast');
  const savedFont = localStorage.getItem('salon_jo_font_idx');
  if (savedContrast === '1') body.classList.add('high-contrast');
  if (savedFont) { current = parseInt(savedFont); applySize(current); }

})();