// Logout event handler
function logout(event) {
  event.preventDefault();
  fadeOutAndRedirect("core/logout.php");
}

// Attach logout event listener
document.addEventListener("DOMContentLoaded", function () {
  const logoutBtn = document.querySelector(".logout-btn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", logout);
  }
});

const positionsList = document.getElementById('elected-positions');
const lastPostion = positionsList.lastElementChild;
lastPostion.style.borderBottom = 'none';
lastPostion.style.margin = '-1% auto -2%';

function showCloseBtn(positionId) {
  const listVoteModal = document.getElementById('list-vote-modal');
  const labelPosition = document.querySelector(`.label-elected-position[data-id="${positionId}"]`);
  listVoteModal.classList.remove('active');
  labelPosition.scrollIntoView({behavior: 'smooth'} + 100);
}

function showCandidateList(positionId, lang, voterId) {
  const listVoteModal = document.getElementById('list-vote-modal');
  const listVote = document.getElementById('list-vote');
  const btnVote = document.getElementById('vote-btn');

  const langs = {
        ar: {
            voteBtn: 'تصويت',
            closeBtn: "إغلاق"
        },
        en: {
            voteBtn: 'Vote',
            closeBtn: 'Close'
        },
        fr: {
            voteBtn: 'Voter',
            closeBtn: "Fermer"
        }
    };

  listVote.innerHTML = '';

  fetch(`core/api.php?action=getCandidatesByPosition&id_position=${positionId}`)
  .then(res =>res.json())
  .then(candidates => {
    if(candidates.length === 0) {
      btnVote.textContent = langs[lang].closeBtn;
    } else {
      btnVote.textContent = langs[lang].voteBtn;
      candidates.forEach(candidate => {
        const li = document.createElement('li');
        li.className = 'candidate-item';
        li.innerHTML = `
          <div class="candidate-info">
          <img src="${candidate.photo_path}" class="photo-candidate">
          <span class="name">${(lang === 'ar')? candidate.ar_name : candidate.name}</span>
          </div>
          <span class="union snem">${candidate.Supporting_party}</span>
          <img src="${candidate.path_supporting_party_logo}" class="union-logo">
          <div class="checkbox-input">
            <input type="checkbox" name="candidate" class="vote-checkbox" value="${candidate.id}">
          </div>
        `;
        listVote.appendChild(li);
      });
      const checkboxes = listVote.querySelectorAll('li .checkbox-input input[type="checkbox"]');
      checkboxes.forEach(ch => {
        ch.addEventListener("change", function() {
          if (this.checked) {
            checkboxes.forEach(other => {
              if (other !== this) other.checked = false;
            });
          }
        });
      });
    }
  });
  listVoteModal.classList.add('active');
  listVoteModal.scrollIntoView({behavior: 'smooth'});

  btnVote.addEventListener('click', function() {
    const selectedCandidate = listVote.querySelector('li .checkbox-input input[type="checkbox"]:checked') || '';
    if (selectedCandidate !== '') {
      SendVote(selectedCandidate.value, voterId, positionId, lang);
      showCloseBtn(positionId);
    } else {
      showCloseBtn(positionId);
    }
  });
}


function SendVote(candidateId, voterId, positionId, lang) {
  const voteData = new FormData();
  voteData.append('action', 'sendVote');
  voteData.append('id_candidate', candidateId);
  voteData.append('id_voter', voterId);
  voteData.append('id_position', positionId);

  fetch('core/hedera-bridge.php', {
    method: "POST",
    headers: { 'Content_type': 'application/json' },
    body: voteData
  })
  .then(res => res.json())
  .then(response => {
    if(response.status === 'success') { notify( message = '', response.status, lang) }
    else { notify( response.message, response.status, lang)}
  })
  .catch(err => console.error('Error:', err));
}

// Local toast implementation (scoped to this page)
const showToastLocal = (function() {
    const activeToasts = new Map();

    function getContainer() {
        let el = document.getElementById('toastContainer');
        if (!el) {
            el = document.createElement('div');
            el.id = 'toastContainer';
            el.className = 'toast-container';
            document.body.appendChild(el);
        }
        return el;
    }

    function removeToast(toast, key, skipAnimation = false) {
        if (skipAnimation) {
            toast.classList.add('removing');
            setTimeout(() => {
                toast.remove();
                activeToasts.delete(key);
            }, 50);
            return;
        }
        toast.style.transform = '';
        toast.style.opacity = '';
        toast.style.transition = '';
        toast.classList.remove('show');
        toast.classList.add('removing');
        setTimeout(() => {
            toast.remove();
            activeToasts.delete(key);
        }, 300);
    }

    return function showToastLocal(message, type = 'error') {
        const container = getContainer();

        if (activeToasts.has(message)) {
            const item = activeToasts.get(message);
            item.counter.count++;
            item.counter.element.textContent = item.counter.count;
            item.counter.element.style.display = 'flex';
            clearTimeout(item.timeout);
            item.timeout = setTimeout(() => removeToast(item.element, message), 5000);
            return;
        }

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <div class="toast-icon ${type}"></div>
            <div class="toast-message">${message}</div>
            <div class="toast-counter">1</div>
            <button class="toast-close">×</button>
        `;

        container.appendChild(toast);

        const counterEl = toast.querySelector('.toast-counter');
        counterEl.style.display = 'none';

        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => removeToast(toast, message));

        const timeout = setTimeout(() => removeToast(toast, message), 5000);
        activeToasts.set(message, {
            element: toast,
            counter: { element: counterEl, count: 1 },
            timeout
        });

        // Trigger show animation with double rAF for consistency
        void toast.offsetHeight;
        const triggerShow = () => toast.classList.add('show');
        if (window.requestAnimationFrame) {
            requestAnimationFrame(() => requestAnimationFrame(triggerShow));
        } else {
            setTimeout(triggerShow, 16);
        }
    };
})();

function notify(message, type, lang) {
  let messages = {
    error : {
      en: 'Make sure the internet connection and try again, if the problem is repeated, please contact the support',
      fr: 'Assurez-vous de la connexion Internet et réessayez, si le problème se répète, veuillez contacter l\'assistance',
      ar: 'تأكد من إتصال الإنترنت و عاود المحاولة ، إذا تكررت المشكة يرجى التواصل مع الدعم'
    },
    retry: {
      en: 'Make sure the internet connection and try again',
      fr: 'Assurez-vous de la connexion Internet et réessayez',
      ar: 'تأكد من إتصال الإنترنت و عاود المحاولة'
    },
    success: {
      en: 'Your voice has been successfully saved',
      fr: 'Votre voix a été enregistrée avec succès',
      ar: 'لقد تم حفظ صوتكم بنجاح'
    }, 
    alreadyVoted: {
      en: 'You have voted for this position before',
      fr: 'Vous avez déjà voté pour ce poste',
      ar: 'لقد صوتم لهذا المنصب من قبل'
    }
  };
  try {
    if(type === 'alreadyVoted') {
      showToastLocal(messages[type][lang], type = 'error');
    } else {
      showToastLocal(messages[type][lang], type);
    }
  } catch (e) {
      if (type === 'error') {
          console.error(message);
      } else {
          console.log(message);
      }
  }
}