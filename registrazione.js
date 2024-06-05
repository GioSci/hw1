function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus.nome = input.value.length > 0) {
        input.parentNode.classList.remove('campoErr');
    } else {
        input.parentNode.classList.add('campoErr');
        console.log("nome");
    }
}
function checkCognome(event) {
    const input = event.currentTarget;
    
    if (formStatus.cognome = input.value.length > 0) {
        input.parentNode.classList.remove('campoErr');
    } else {
        input.parentNode.classList.add('campoErr');
        console.log("cognome");
    }
}
function checkCF(event) {
    const input = event.currentTarget;

    if(!/^[a-zA-Z0-9]{16}$/.test(input.value)) {
        input.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri (16 caretteri)";
        input.parentNode.classList.add('campoErr');
        formStatus.cf = false;

    } else {
        fetch("check_cf.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckCF);
    }    
}
function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckCF(json) {

    if (formStatus.cf = !json.exists) {
        document.querySelector('#cf').classList.remove('campoErr');
    } else {
        document.querySelector('#cf span').textContent = "Utenste già registrato";
        document.querySelector('#cf').classList.add('campoErr');
        console.log("cf");
    }
}
function checkEmail(event) {
    const emailInput = event.currentTarget;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('#email span').textContent = "Email non valida";
        document.querySelector('#email').classList.add('campoErr');
        formStatus.email = false;

    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}
function jsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('#email').classList.remove('campoErr');
    } else {
        document.querySelector('#email span').textContent = "Email già utilizzata";
        document.querySelector('#email').classList.add('campoErr');
        console.log("nilme");
    }
}
function checkPassword(event) {
    const passwordInput = event.currentTarget;
    if (!(passwordInput.value.length >= 8 && /[A-Z]+/.test(passwordInput.value) && /[A-Za-z]+/.test(passwordInput.value) && /[0-9]+/.test(passwordInput.value) && /[^a-z0-9]+/i.test(passwordInput.value) )) {
        passwordInput.parentNode.querySelector('span').textContent = "Password troppo corta o troppo semplice";
        document.querySelector('#password').classList.add('campoErr');
        formStatus.cf = false;
        console.log("pas");
    } else {
        document.querySelector('#password').classList.remove('campoErr');
    }
}
function checkCPassword(event) {
    const confirmPasswordInput = event.currentTarget;
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('#password input').value && confirmPasswordInput.value.length>0) {
        document.querySelector('#cPassword').classList.remove('campoErr');
    } else {
        document.querySelector('#cPassword').classList.add('campoErr');
        console.log("passs");
    }
}
function onClick(event){
    event.currentTarget.removeEventListener('click', onClick);
    const cod=event.currentTarget.dataset.codi;
    const label=document.querySelector(`[data-codP="${cod}"]`);
    label.type="text";
    event.currentTarget.addEventListener('click', onRiClick);
}
function onRiClick(event){
    event.currentTarget.removeEventListener('click', onRiClick);
    const cod=event.currentTarget.dataset.codi;
    const label=document.querySelector(`[data-codP="${cod}"]`);
    label.type="password";
    event.currentTarget.addEventListener('click', onClick);
}
function checkSignup(event) {
    console.log(Object.keys(formStatus).length );
    console.log(Object.values(formStatus).includes(false));
    console.log(formStatus);
    
    if (Object.keys(formStatus).length !== 6 || Object.values(formStatus).includes(false)) {
        console.log("privato");
        event.preventDefault();
    }
}

const formStatus = {'upload': true};
document.querySelector('#nome input').addEventListener('blur', checkName);
document.querySelector('#cognome input').addEventListener('blur', checkCognome);
document.querySelector('#cf input').addEventListener('blur', checkCF);
document.querySelector('#email input').addEventListener('blur', checkEmail);
document.querySelector('#password input').addEventListener('blur', checkPassword);
document.querySelector('#cPassword input').addEventListener('blur', checkCPassword);
document.querySelector('form').addEventListener('submit', checkSignup);
const eyes=document.querySelectorAll('label img');
for(let element of eyes){
    element.addEventListener('click',onClick)
}