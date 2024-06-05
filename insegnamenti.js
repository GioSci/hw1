function getInsegnamenti() {
    fetch("insegnamenti_get.php").then(onResponse).then(onJson);
}
function onResponse(response){
    if (!response.ok) {return null};
    return response.json();
}
function onJson(json){
    for(let element of json){
        const id=element.id;
        const nome=element.nome;
        const prof=element.prof;
        const insegnamento=document.createElement('div');
        insegnamento.classList.add('insegnamento');
        const testo_insegnamento=document.createElement('div');
        testo_insegnamento.classList.add('testo_insegnamento');
        const nome_insegnamento=document.createElement('div');
        nome_insegnamento.classList.add('nome_insegnamento');
        const info_insegnamento=document.createElement('div');
        info_insegnamento.classList.add('info_insegnamento');
        nome_insegnamento.textContent=nome;
        info_insegnamento.textContent=id +' - '+ prof;
        testo_insegnamento.appendChild(nome_insegnamento);
        testo_insegnamento.appendChild(info_insegnamento);
        insegnamento.appendChild(testo_insegnamento);
        colonna_dx.appendChild(insegnamento);
    }
}







const colonna_dx=document.querySelector('#colonna_dx');
getInsegnamenti();