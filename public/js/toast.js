
const toastBtn = document.querySelector('.toast-btn');
console.log(toastBtn);

toastBtn.addEventListener('click', () => {
  toast(
    {
      title: null,
      message: null,
      time: null
    },
    {
      textColor: null,
      background: null
    }
  );
});


function toast(content, style) {
  const root = document.getElementById('toast-root');
  renderToasts(root, content, style);
}


function renderToasts(root, content, style) {
  const toast = document.createElement('div');
  toast.classList.add('toast');
  let timer = 5;
  let isPaused = false;

  // Inicializáljuk a percent változót a timer alapján
  const percent = timer * 20 + '%';

  toast.innerHTML = `
    <div class="toast-header d-flex justify-content-between bg-${style.background ? style.background : 'light'} text-${style.textColor ? style.textColor : 'dark'}">
      <strong class="mr-auto">${content.title ? content.title : 'MVC message!'}</strong>
      <small>${content.time ? content.time : 'now'}</small>
    </div>
    <div class="toast-body">
      ${content.message ? content.message : 'Please give message!'}
    </div>
    <div class="timer-line  bg-${style.background ? style.background : 'dark'}" style="height: 2px; width: ${percent}"></div>
  `;

  root.appendChild(toast);

  // Bootstrap toast megjelenítése
  toast.classList.add('show');




  // Automatikus eltávolítás a Bootstrap toast megszámláló lejártakor
  const autoRemoveId = setInterval(function () {
    if (!isPaused) {
      timer -= 0.05;
      const percent = timer * 20 + '%'; // Frissítjük a percent értékét a timer alapján
      toast.querySelector('.timer-line').style.width = percent; // Frissítjük a timer-line stílusát
    }

    if (timer <= .0) {
      toast.animate([
        // key frames
        { transform: 'translateX(200%)' }
      ], {
        // sync options
        duration: 1000,
      })
    }

    if (timer <= -.5) {
      root.removeChild(toast);
      clearInterval(autoRemoveId);
    }
  }, 50);

  toast.addEventListener('mouseover', () => {
    isPaused = true;
    console.log(isPaused);
  });

  toast.addEventListener('mouseleave', () => {
    isPaused = false;
    console.log(isPaused);
  });

  toast.addEventListener('click', () => {

    toast.animate([
      // key frames
      { transform: 'translateX(200%)' }
    ], {
      // sync options
      duration: 300,
    })
    setTimeout(() => {
      root.removeChild(toast);
      clearInterval(autoRemoveId)
    }, 300)
  })
}



function countDown() {
  let sec = 5;
  const percent = 100 + '%';

  const interval = setInterval(() => {
    sec -= 0.05;

    return
    if (sec <= 0) {
      clearInterval(interval)
    }
  }, 50)

}

countDown();







