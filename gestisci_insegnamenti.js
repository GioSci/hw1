function getInsegnamenti() {
    fetch("insegnamenti_get.php").then(onResponse).then(onJsonG);
}
function onResponse(response){
    if (!response.ok) {return null};
    return response.json();
}
function onJsonG(json){
    lista.innerHTML='';
    for(let element of json){
        const id=element.id;
        const nome=element.nome;
        const prof=element.prof;
        const insegnamento=document.createElement('div');
        insegnamento.classList.add('gInsegnamento');
        const testo_insegnamento=document.createElement('div');
        testo_insegnamento.classList.add('testo_insegnamento');
        const nome_insegnamento=document.createElement('div');
        nome_insegnamento.classList.add('nome_insegnamento');
        const info_insegnamento=document.createElement('div');
        info_insegnamento.classList.add('info_insegnamento');
        const elimina=document.createElement('img');
        elimina.src='img/8.png';
        elimina.addEventListener('click',removeInsegnamento);
        elimina.setAttribute("data-idInsegnamento", id);
        nome_insegnamento.textContent=nome;
        info_insegnamento.textContent=id +' - '+ prof;
        testo_insegnamento.appendChild(nome_insegnamento);
        testo_insegnamento.appendChild(info_insegnamento);
        insegnamento.appendChild(testo_insegnamento);
        insegnamento.appendChild(elimina);
        lista.appendChild(insegnamento);
    }
}

function removeInsegnamento(event){
    const id=event.currentTarget.dataset.idinsegnamento;
    const formData=new FormData();
    formData.append('id', id);
    fetch("insegnamenti_remove.php", {method: 'post', body: formData}).then(onResponse).then(onJsonR);
}

function onJsonR(json){
if(json.ok){
    getInsegnamenti();
}
else console.log('ERRORE');
}

const lista=document.querySelector('#lista_insegnamenti');
getInsegnamenti();