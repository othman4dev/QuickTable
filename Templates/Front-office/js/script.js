console.log('╭─────────────────────────────────────────────────────╮');
console.log('│                                                     │');
console.log('│                 Welcome to QuickTable!              │');
console.log('│                                                     │');
console.log('╰─────────────────────────────────────────────────────╯');

document.addEventListener('DOMContentLoaded',function(event){
    // array with texts to type in typewriter
    var dataText = [
        "Secure your seat anytime, anywhere.",
        "From restaurants to coffee shops to barber shops.",
        "Discover your favorite venues for upcoming events.",
        "Reach out to your preferred places with any inquiries."
    ];
    
    // type one text in the typwriter
    // keeps calling itself until the text is finished
    function typeWriter(text, i, fnCallback) {
      // chekc if text isn't finished yet
      if (i < (text.length)) {
        // add next character to h1
       document.querySelector("#login-animation").innerHTML = text.substring(0, i+1) +'<span class="test-animation" aria-hidden="true"></span>';
  
        // wait for a while and call this function again for next character
        setTimeout(function() {
          typeWriter(text, i + 1, fnCallback)
        }, 100);
      }
      // text finished, call callback if there is a callback function
      else if (typeof fnCallback == 'function') {
        // call callback after timeout
        setTimeout(fnCallback, 700);
      }
    }
    // start a typewriter animation for a text in the dataText array
     function StartTextAnimation(i) {
       if (typeof dataText[i] == 'undefined'){
          setTimeout(function() {
            StartTextAnimation(0);
          }, 20000);
       }
       // check if dataText[i] exists
      if (i < dataText[i].length) {
        // text exists! start typewriter animation
       typeWriter(dataText[i], 0, function(){
         // after callback (and whole text has been animated), start next text
         StartTextAnimation(i + 1);
       });
      }
    }
    // start the text animation
    StartTextAnimation(0);
  });

// This is the start of script :
let side = true;
let drop = false;
function shrinkSide(btn) {
    let mainPart = document.getElementById('main-side');
    let allSide = document.getElementById('all-side');
    if (side) {
        btn.style.width='50px';
        allSide.style.width = '50px';
        mainPart.querySelectorAll('span').forEach(element => {
            element.style.display = 'none';
        });
        setTimeout(() => {
            mainPart.querySelectorAll('.side-option').forEach(element => {
                element.style.justifyContent = 'center';
            });
        }, 300);
        side = false;
    } else {
        btn.style.width='125px';
        allSide.style.width = '250px';
        mainPart.querySelectorAll('span').forEach(element => {
            element.style.display = 'inline';
        });
        mainPart.querySelectorAll('.side-option').forEach(element => {
            element.style.justifyContent = 'unset';
        });
        side = true;
    }
}
shrinkSide(document.querySelector('.menu-btn'));
function dropdown(it) {
    if (drop) {
        document.getElementById('accountDrop').style.display = 'none';
        let person = document.querySelector('#arrow');
        person.classList.remove('bi-person-up');
        person.classList.add('bi-person-down');
        drop = false;
    } else {
        document.getElementById('accountDrop').style.display = 'flex';
        let person = document.querySelector('#arrow');
        person.classList.remove('bi-person-down');
        person.classList.add('bi-person-up');
        drop = true;
    }
}
function readMore(btn) {
    btn.parentElement.style.display = 'none';
    btn.parentElement.parentElement.style.paddingRight = '15px';
    let side = btn.parentElement.parentElement;
    side.style.overflowY = 'scroll';
}
function showNote(btn) {
    let comment = btn.parentElement.parentElement.querySelector('.post-comment');
    let note = btn.parentElement.parentElement.querySelector('.post-note');
    if (note.offsetWidth === 0) {
        note.style.width = '300px';
        comment.style.width = '0px';
    } else {
        note.style.width = '0px';
    }
}
function showComment(btn) {
    let comment = btn.parentElement.parentElement.querySelector('.post-comment');
    let note = btn.parentElement.parentElement.querySelector('.post-note');
    if (comment.offsetWidth === 0) {
        note.style.width = '0px';
        comment.style.width = '300px';
    } else {
        comment.style.width = '0px';
    }
}
function showMore(more) {
    if (more.offsetHeight <= 50) {
        more.style.opacity = '1';
        more.style.height = '115px';
    } else {
        more.style.opacity = '0';
        more.style.height = '0px';
    }
}
let pictures = ['../assets/s1.jfif', '../assets/s2.jpg' , '../assets/s2.webp', '../assets/s3.jpg', '../assets/s2.webp', '../assets/s4.jpg'];
let currentIndex = 0;
let maxIterations = 1000; // Set the maximum number of iterations
let interval = 3000; // Set the interval time in milliseconds

function changeImage() {
    document.getElementById('slider').style.backgroundImage = `url(${pictures[currentIndex]})`;
    currentIndex = (currentIndex + 1) % pictures.length;
}

let iterations = 0;
let intervalId = setInterval(() => {
    changeImage();
    iterations++;
    if (iterations === maxIterations) {
        clearInterval(intervalId);
    }
}, interval);

var login = false;

function switchLogin() {
    if (login) {
        document.querySelector('.flip-card-inner').style.transform = 'rotateY(180deg)';
        login = false;
    } else {
        document.querySelector('.flip-card-inner').style.transform = 'rotateY(0deg)';
        login = true;
    }
    
}