function getFacolta() {
    fetch("facolta_get.php").then(onResponse).then(onJsonF);
}

function onResponse(response){
    if (!response.ok) {
        return null;
        };
    return response.json();
}

function onJsonF(json){
    for(let element of json){
        const id=element.id;
        const nome=element.nome;
        const box=document.createElement('div');
        const lista_corsi=document.createElement('div');
        const facolta=document.createElement('a');
        facolta.classList.add('facolta');
        facolta.textContent=nome;
        lista_corsi.setAttribute('data-idFacolta',id);
        facolta.setAttribute('data-id',id);
        facolta.addEventListener('click', onClick);
        box.appendChild(facolta);
        box.appendChild(lista_corsi);
        lista.appendChild(box);
    }
}

function onRiClick(event){
    event.currentTarget.removeEventListener('click',onRiClick);
    const lista_corsi=document.querySelector(`[data-idFacolta="${event.currentTarget.dataset.id}"]`);
    lista_corsi.innerHTML='';
    event.currentTarget.addEventListener('click',onClick);
}

function onClick(event){
    event.currentTarget.removeEventListener('click',onClick);
    const facolta=event.currentTarget.dataset.id;
    const formData=new FormData();
    formData.append('facolta', facolta);
    fetch("facolta_insegnamenti_get.php", {method: 'post', body: formData}).then(onResponse).then(onJsonI);
    event.currentTarget.addEventListener('click', onRiClick);
}
function onJsonI(json){
    if(json.length==0){
        const testo =document.createElement('div');
        testo.classList.add('label_errore')
        testo.textContent="NON CI SONO INSEGNAMENTI A CUI POTERSI ISCRIVERE";
        body.appendChild(testo);
        setTimeout(() => { body.removeChild(testo); }, 2000);
        return;
    }
    const lista_corsi=document.querySelector(`[data-idFacolta="${json[0].facolta}"]`);
    for (let element of json) {
        const id = element.id;
        const nome = element.nome;
        const prof = element.prof;
        const insegnamento = document.createElement('div');
        insegnamento.classList.add('fInsegnamento');
        const testo_insegnamento = document.createElement('div');
        testo_insegnamento.classList.add('testo_insegnamento');
        const nome_insegnamento = document.createElement('div');
        nome_insegnamento.classList.add('nome_insegnamento');
        const info_insegnamento = document.createElement('div');
        info_insegnamento.classList.add('info_insegnamento');
        const aggiungi=document.createElement('img');
        aggiungi.src='img/12.png';
        aggiungi.addEventListener('click',addInsegnamento);
        aggiungi.setAttribute("data-idInsegnamento", id);
        nome_insegnamento.textContent = nome;
        info_insegnamento.textContent = id + ' - ' + prof;
        testo_insegnamento.appendChild(nome_insegnamento);
        testo_insegnamento.appendChild(info_insegnamento);
        insegnamento.appendChild(testo_insegnamento);
        insegnamento.appendChild(aggiungi);
        lista_corsi.appendChild(insegnamento);
    }
}

function addInsegnamento(event){
    const id=event.currentTarget.dataset.idinsegnamento;
    const formData=new FormData();
    formData.append('id', id);
    fetch("insegnamenti_add.php", {method: 'post', body: formData}).then(onResponse).then(onJsonA);
}
function onJsonA(json){
    if(json.ok){
        window.location.href = ('gestisci_insegnamenti.php');
    }
    else console.log('ERRORE');
    }

const lista=document.querySelector('#lista_facolta');

getFacolta();
const body=document.querySelector("body");
