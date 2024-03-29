console.log('╭─────────────────────────────────────────────────────╮');
console.log('│                                                     │');
console.log('│                 Welcome to QuickTable!              │');
console.log('│                                                     │');
console.log('╰─────────────────────────────────────────────────────╯');

if (document.querySelector("#login-animation")) {
    document.addEventListener('DOMContentLoaded',function(event){
        // array with texts to type in typewriter
        var dataText = [
            "Discover Exciting Events Near You.",
            "Seamless Event Reservation Experience.",
            "Find, Book, and Attend Events Effortlessly.",
            "Elevate Your Event Experience with Evento"
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
}
if (window.location.href.split('?')[1]) {
    let loginType = window.location.href.split('?')[1];
  if (loginType == 'login') {
      //switchLogin();
  } else if (loginType === 'register') {
      switchLogin();
  }
}

// This is the start of script :
function reserveAjax(id, element) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `/reserve/${id}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (this.responseText === 'login') {
                window.location.href = '/login';
            } else if (this.responseText === 'Reserved') {
                element.innerHTML = this.responseText + '<i class="bi bi-check"></i>';
                element.disabled = true;
            } else {
                element.innerHTML = 'Reserved <i class="bi bi-check"></i>';
                element.disabled = true;
                document.getElementById('alert').style.display = 'flex';
                document.getElementById('alert-message').innerHTML = this.responseText;
            }
        } else {
            element.innerHTML = 'Failed to reserve' + '<i class="bi bi-x"></i>';
        }
    };
    xhr.send();
}

// This is the start of script :
function cancelAjax(id, element) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `/cancel/${id}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (this.responseText == 'Canceled') {
                element.innerHTML =  'Canceled <i class="bi bi-check"></i>';
                element.disabled = true;
                window.location.reload();
            } else {
                element.innerHTML = 'Cannot cancel <i class="bi bi-x"></i>';
                element.disabled = true;
            }
        } else {
            element.innerHTML = 'Failed to cancel reservation' + '<i class="bi bi-x"></i>';
        }
    };
    xhr.send();
}

function searchAjax(element) {
    if (element.value === '') {
        document.getElementById('search-results').style.display = 'none';
    } else {
        document.getElementById('search-results').style.display = 'flex';
        document.getElementById('search-results').innerHTML = `<div class="search-loading">
        <div class="loader"></div>
    </div>`;
    }
    let xhr = new XMLHttpRequest();
    let search = element.value;
    xhr.open('GET', `/search/${search}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('search-results').innerHTML = this.responseText;
        } else {
            console.log('Failed to search');
        }
    };
    xhr.send();
}

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
if (shrinkSide) {
    shrinkSide(document.querySelector('.menu-btn'));
}
let more = false;

function showMore(element) {
    if (more) {
        element.style.animationName = 'showLess';
        more = false;
    } else {
        element.style.animationName = 'showMore';
    }
}
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

if (document.getElementById('slider')) {
    let iterations = 0;
    let intervalId = setInterval(() => {
        changeImage();
        iterations++;
        if (iterations === maxIterations) {
            clearInterval(intervalId);
        }
    }, interval);
}


var login = true;

function switchLogin() {
    if (login) {
        document.querySelector('.flip-card-inner').style.transform = 'rotateY(0deg)';
        login = false;
    } else {
        document.querySelector('.flip-card-inner').style.transform = 'rotateY(180deg)';
        login = true;
    }
}

function validation(type) {
    if (type == 'login') {
        let email = document.querySelector('#email1');
        if (email.value == '') {
            email.setCustomValidity('Please fill this field');
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.setCustomValidity('Please enter a valid email address');
            } else {
                email.setCustomValidity('');
                if (document.querySelector('#password').value == '') {
                    document.querySelector('#password').setCustomValidity('Please fill this field');
                } else {
                    if (document.querySelector('#password').value.length <= 7) {
                        document.querySelector('#password').setCustomValidity('Password must be at least 8 characters long');
                    } else {
                        document.querySelector('#password').setCustomValidity('');
                        document.querySelector('#login-form').submit();
                    }
                }
            }
        }
    } else if (type == "register") {
        let email = document.querySelector('#email2');
        if (email.value == '') {
            email.setCustomValidity('Please fill this field');
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.setCustomValidity('Please enter a valid email address');
            } else {
                email.setCustomValidity('');
                if (document.querySelector('#pass1').value == '') {
                    document.querySelector('#pass1').setCustomValidity('Please fill this field');
                } else {
                    if (document.querySelector('#pass1').value.length <= 7) {
                        document.querySelector('#pass1').setCustomValidity('Password must be at least 8 characters long');
                    } else {
                        document.querySelector('#pass1').setCustomValidity('');
                        if (document.querySelector('#pass2').value == '') {
                            document.querySelector('#pass2').setCustomValidity('Please fill this field');
                        } else {
                            if (document.querySelector('#pass2').value.length <= 7) {
                                document.querySelector('#pass2').setCustomValidity('Password must be at least 8 characters long');
                            } else {
                                document.querySelector('#pass2').setCustomValidity('');
                                if (document.querySelector('#pass1').value != document.querySelector('#pass2').value) {
                                    document.querySelector('#pass2').setCustomValidity("Passwords Don't Match");
                                } else {
                                    document.querySelector('#pass2').setCustomValidity('');
                                    document.querySelector('#register-form').submit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function sendMail(email) {

    var xhr = new XMLHttpRequest();

    xhr.open('POST', '/sendMail', true);

    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
        if (xhr.status === 200) {
            
            console.log('Email sent successfully');
        } else {
            
            console.log('Failed to send email');
        }
    };

    var requestBody = JSON.stringify({ email: email });

    xhr.send(requestBody);
}
function showAdd(element,that) {
    if (element.style.display === 'none') {
        element.style.display = 'flex';
        that.lastElementChild.classList.remove('bi-plus-circle');
        that.lastElementChild.classList.add('bi-caret-up');
    } else {
        element.style.display = 'none';
        that.lastElementChild.classList.remove('bi-caret-up');
        that.lastElementChild.classList.add('bi-plus-circle');
    }
}
function transferDel(id,name) {
    if (document.getElementById('deleteModal').style.display == 'none') {
        document.querySelector('#deleteModal').style.display = 'flex';
        document.querySelector('#deleteModal').querySelector('form').action = `/deleteCat/${id}`;
        document.querySelector('#deleteModal').querySelector('#category-name').innerText = name;
    } else {
        document.getElementById('deleteModal').style.display = 'none';
    }
    
}
function transferEdit(id,name) {
    if (document.getElementById('editModal').style.display == 'none') {
        document.getElementById('editModal').style.display = 'flex';
        document.querySelector('#editModal').querySelector('#cat-id').value = id;
        document.querySelector('#editModal').querySelector('#category-name').value = name;
    } else {
        document.getElementById('editModal').style.display = 'none';
    }
}
function addCat() {
    if (document.getElementById('addModal').style.display == 'none') {
        document.querySelector('#addModal').style.display = 'flex';
    } else {
        document.querySelector('#addModal').style.display = 'none';
    }
}
function showTicket(ele,title,category,date,time,price,token,location) {
    document.querySelector('#ticketModal').style.display = 'flex';
    document.getElementById('ticketModal').querySelector('#event_title').innerText = title;
    document.getElementById('ticketModal').querySelector('#event_category').innerText = category;
    const eventDate = new Date(date);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = eventDate.toLocaleDateString(undefined, options);
    document.getElementById('ticketModal').querySelector('#event_date').innerText = formattedDate;
    const formattedTime = time.slice(0, 5);
    const formatted12h = formattedTime.replace(/^(\d{2}):(\d{2})$/, function(_, hours, minutes) {
        const suffix = hours >= 12 ? 'PM' : 'AM';
        const twelveHour = hours % 12 || 12;
        return twelveHour + ':' + minutes + ' ' + suffix;
    });
    document.getElementById('ticketModal').querySelector('#event_time').innerText = formattedTime + ' / ' + formatted12h;
    document.getElementById('ticketModal').querySelector('#event_time2').innerText = formattedTime + ' / ' + formatted12h;
    document.getElementById('ticketModal').querySelector('#event_price').innerText = price + ' $';
    document.getElementById('ticketModal').querySelector('#event_location').innerText = location;
    document.getElementById('ticketModal').querySelector('#event_token').innerHTML = '#' + token;
    document.getElementById('ticketModal').querySelector('#event_token2').innerHTML = '#' + token;
    let qrcode = document.getElementById('qrcode');
    const formattedTitle = title.replace(/\s/g, '_');
    document.getElementById('downloadBTN').onclick = function() {
        
        downloadTicket(formattedTitle);
    };
    setQR(token);
}
function validateEvent() {
    const fields = [
        { element: document.getElementById('title'), maxLength: 30, errorMessage: 'Please fill this field' },
        { element: document.getElementById('category'), errorMessage: 'Please fill this field' },
        { element: document.getElementById('date'), errorMessage: 'Please fill this field' },
        { element: document.getElementById('time'), errorMessage: 'Please fill this field' },
        { element: document.getElementById('price'), min: 0, errorMessage: 'Please fill this field' },
        { element: document.getElementById('location'), maxLength: 50, errorMessage: 'Please fill this field' },
        { element: document.getElementById('spots'), min: 1, errorMessage: 'Please fill this field' },
        { element: document.getElementById('image'), maxFileSize: 2000000, errorMessage: 'Please fill this field' }
    ];

    let form = document.getElementById('add-event');
    let isValid = true;

    fields.forEach(field => {
        const { element, maxLength, min, maxFileSize, errorMessage } = field;
        const value = element.value.trim();

        if (value === '') {
            element.setCustomValidity(errorMessage);
            isValid = false;
        } else {
            element.setCustomValidity('');

            if (maxLength && value.length > maxLength) {
                element.setCustomValidity('Title is too long');
                isValid = false;
            }

            if (min && value < min) {
                element.setCustomValidity(`Value must be at least ${min}`);
                isValid = false;
            }

            if (maxFileSize && element.files[0].size > maxFileSize) {
                element.setCustomValidity('Image size is too large');
                isValid = false;
            }
        }
    });

    const dateElement = document.getElementById('date');
    const timeElement = document.getElementById('time');
    const currentDate = new Date();
    const selectedDate = new Date(dateElement.value);
    const currentTime = timeElement.value;

    if (selectedDate < currentDate) {
        dateElement.setCustomValidity('Date must be in the future');
        isValid = false;
    } else {
        dateElement.setCustomValidity('');

        if (selectedDate.getTime() === currentDate.getTime() && currentTime < currentDate.toLocaleTimeString()) {
            timeElement.setCustomValidity('Time must be in the future');
            isValid = false;
        } else {
            timeElement.setCustomValidity('');
        }
    }

    if (isValid) {
        form.submit();
    }
}
document.querySelectorAll('[role="navigation"]').forEach(element => {
    element.querySelectorAll('a').forEach(element2 => {
        if (element2.getAttribute('rel') == 'prev') {
            element2.innerHTML = '<i class="bi bi-chevron-left carret"></i> &nbsp;Previous &nbsp;';
        } else if (element2.getAttribute('rel') == 'next') {
            element2.innerHTML = '&nbsp; &nbsp;Next <i class="bi bi-chevron-right carret"></i>';
        }
    });
    element.querySelectorAll('span').forEach(element2 => {
        element2.innerHTML = element2.innerHTML.replace('»', '<i class="bi bi-chevron-right carret"></i>');
        element2.innerHTML = element2.innerHTML.replace('«', '<i class="bi bi-chevron-left carret"></i>');
    });
});
function lengthCheck(element, message, length) {
    document.getElementById('title-counter').innerText = element.value.length + ' / ' + length;
    if (element.value.length >= length) {
        element.value = element.value.slice(0, length-1);
        document.getElementById('title-counter').style.color = 'red';
    } else {
        element.setCustomValidity('');
        document.getElementById('title-counter').style.color = 'black';
    }
}
var trigger = false;
function checkEmailAjax(input) {
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let emailStat = emailRegex.test(input.value);
    let errorInput = document.getElementById('email-error');
    let submit = document.getElementById('login-submit');
    if (emailStat) {
        trigger = true;
    }
    if (trigger == true) {
        if (emailStat) {
            let email = input;
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `/checkEmail/${email.value}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    if (this.responseText === 'exists') {
                        errorInput.style.color = 'red';
                        errorInput.innerText = 'Email already exists';
                        submit.disabled = true;
                    } else {
                        errorInput.style.color = 'green';
                        errorInput.innerText = 'Valid email address';
                        submit.disabled = false;
                    }
                } else {
                    console.log('Failed to check email');
                }
            };
            xhr.send();
        } else {
            errorInput.style.color = 'red';
            errorInput.innerText = 'Invalid Email Address';
            submit.disabled = false;
        }
    } 
}