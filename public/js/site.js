// header scroll
const header = document.getElementById('header');
if (header) addEventListener('scroll', () => header.classList.toggle('scrolled', scrollY > 30));

// mobile menu
const burger = document.getElementById('burger'), panel = document.getElementById('mobilePanel');
if (burger && panel) {
  burger.addEventListener('click', () => panel.classList.toggle('open'));
  panel.querySelectorAll('a').forEach(a => a.addEventListener('click', () => panel.classList.remove('open')));
}

// reveal on scroll
const io = new IntersectionObserver((es) => es.forEach(e => {
  if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
}), { threshold: .14 });
document.querySelectorAll('.reveal').forEach((el, i) => { el.style.transitionDelay = (i % 4 * 70) + 'ms'; io.observe(el); });

// graphene hex lattice (hero visual)
(function () {
  const svg = document.getElementById('lattice');
  if (!svg) return;
  const NS = 'http://www.w3.org/2000/svg', R = 30, W = 460, H = 460;
  const dx = 1.5 * R, dy = Math.sqrt(3) * R;
  const hexPts = (cx, cy) => {
    let p = '';
    for (let i = 0; i < 6; i++) { const a = Math.PI / 180 * (60 * i); p += (cx + R * Math.cos(a)).toFixed(1) + ',' + (cy + R * Math.sin(a)).toFixed(1) + ' '; }
    return p.trim();
  };
  const nodes = [];
  for (let c = 0; c < 6; c++) {
    const cx = 40 + c * dx, off = (c % 2) * dy / 2;
    for (let r = 0; r < 6; r++) {
      const cy = 30 + off + r * dy;
      if (cx > W - 20 || cy > H - 20) continue;
      const poly = document.createElementNS(NS, 'polygon');
      poly.setAttribute('points', hexPts(cx, cy));
      poly.setAttribute('fill', 'none');
      poly.setAttribute('stroke', 'rgba(34,224,138,' + (0.10 + Math.random() * 0.16).toFixed(2) + ')');
      poly.setAttribute('stroke-width', '1');
      svg.appendChild(poly);
      if (Math.random() < 0.4) nodes.push([cx, cy]);
    }
  }
  nodes.forEach((n, i) => {
    const cir = document.createElementNS(NS, 'circle');
    cir.setAttribute('cx', n[0]); cir.setAttribute('cy', n[1]); cir.setAttribute('r', '3');
    cir.setAttribute('fill', i % 2 ? '#19C5E0' : '#22E08A');
    cir.style.filter = 'drop-shadow(0 0 5px ' + (i % 2 ? '#19C5E0' : '#22E08A') + ')';
    cir.style.animation = 'pulseNode ' + (2.4 + Math.random() * 2).toFixed(1) + 's ease-in-out infinite';
    cir.style.animationDelay = (Math.random() * 2).toFixed(1) + 's';
    svg.appendChild(cir);
  });
})();
