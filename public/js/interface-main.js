/* 
   MOBILE NAV MENU
 */
const burger = document.getElementById('burger');
const navLinks = document.getElementById('navLinks');

if (burger && navLinks) {
  burger.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
}

/* 
   CATEGORY TABS FILTER
*/
const tabs = document.getElementById('tabs');
const cards = document.querySelectorAll('.card');

if (tabs && cards.length) {
  tabs.addEventListener('click', (e) => {
    const btn = e.target.closest('.tab');
    if (!btn) return;

    const selectedType = btn.dataset.cat;

    tabs.querySelectorAll('.tab').forEach(t =>
      t.classList.remove('active')
    );
    btn.classList.add('active');

    cards.forEach(card => {
      card.style.display =
        card.dataset.type === selectedType ? 'block' : 'none';
    });

    // reset slider when switching tabs
    currentIndex = 0;
    updateSlider();
  });
}

/*
   SLIDER (ARROWS + DOTS)
*/
const track = document.getElementById('track');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const dots = document.querySelectorAll('.dots span');

const cardsPerView = 3; // desktop
let currentIndex = 0;

function getVisibleCards() {
  return Array.from(cards).filter(c => c.style.display !== 'none');
}

function getMaxIndex() {
  const visibleCards = getVisibleCards();
  return Math.max(0, visibleCards.length - cardsPerView);
}

function updateSlider() {
  const visibleCards = getVisibleCards();
  if (!visibleCards.length) return;

  const gap = 26;
  const cardWidth = visibleCards[0].offsetWidth;
  const offset = currentIndex * (cardWidth + gap);

  track.style.transform = `translateX(-${offset}px)`;

  // dots
  dots.forEach(d => d.classList.remove('active'));
  if (dots[currentIndex]) dots[currentIndex].classList.add('active');

  // arrows state
  if (prevBtn) prevBtn.classList.toggle('is-disabled', currentIndex === 0);
  if (nextBtn) nextBtn.classList.toggle('is-disabled', currentIndex === getMaxIndex());
}

/*
   ARROWS
 */
if (nextBtn) {
  nextBtn.addEventListener('click', () => {
    if (currentIndex < getMaxIndex()) {
      currentIndex++;
      updateSlider();
    }
  });
}

if (prevBtn) {
  prevBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }
  });
}

/* 
   DOTS
*/
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    if (index <= getMaxIndex()) {
      currentIndex = index;
      updateSlider();
    }
  });
});

/* 
   INIT (IMPORTANT FIX)
 */
window.addEventListener('DOMContentLoaded', () => {
  // SHOW ALL cards by default
  cards.forEach(card => {
    card.style.display = 'block';
  });

  updateSlider();
});

/* 
   FOOTER → TABS SYNC
 */
document.querySelectorAll('.footer-column a[data-cat]').forEach(link => {
  link.addEventListener('click', () => {
    const type = link.dataset.cat;

    const tabsContainer = document.getElementById('tabs');
    if (!tabsContainer) return;

    const tab = tabsContainer.querySelector(`.tab[data-cat="${type}"]`);
    if (!tab) return;

    tab.click();

    currentIndex = 0;
    updateSlider();
  });
});
