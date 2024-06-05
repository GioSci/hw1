function onMouseOver_img3()
{
img3.src='img/3.1.png';
}
function onMouseOut_img3()
{
    img3.src='img/3.png';
}

function onMouseOver_li(event)
{
    infoBox.classList.remove('hidden');
    infoBox.style.top= (event.pageY - document.getElementById('colonna_dx').offsetTop-50) + 'px';
    infoBox.style.left= (event.pageX - document.getElementById('colonna_dx').offsetLeft+10) + 'px';
    const telefono= document.createElement('text');
    const indirizzo= document.createElement('text');
    const li= event.currentTarget;
    telefono.textContent= 'telefono:' + li.dataset.telefono;
    indirizzo.textContent= 'indirizzo:' + li.dataset.indirizzo;
    infoBox.innerHTML='';
    infoBox.appendChild(telefono);
    infoBox.appendChild(indirizzo);

}
function onMouseOut_li()
{
    infoBox.classList.add('hidden');
}

function onClickInfo(){
    buttonInfo.classList.remove('b_blu');
    buttonInfo.classList.add('b_bianco');
    buttonInfo.textContent='SENZA INFO';
    for(let element of facoltà_list)
    {
        element.addEventListener('mouseover',onMouseOver_li);
        element.addEventListener('mouseout',onMouseOut_li);
    }
    buttonInfo.removeEventListener('click',onClickInfo);
    buttonInfo.addEventListener('click',onRiClickInfo);
}
function onRiClickInfo(){
    buttonInfo.classList.remove('b_bianco');
    buttonInfo.classList.add('b_blu');
    buttonInfo.textContent="PIU' INFO";
    for(let element of facoltà_list)
    {
        element.removeEventListener('mouseover',onMouseOver_li);
        element.removeEventListener('mouseover',onMouseOut_li);
    }
    buttonInfo.removeEventListener('click',onRiClickInfo);
    buttonInfo.addEventListener('click',onClickInfo);
}

function onClickCercaLibri(){
    modal_view.classList.remove('hidden');
    back.addEventListener('click',onClickBack)

}
function onClickBack(){
    modal_view.classList.add('hidden');
}
function search(event){
    event.preventDefault();
    const keyWord=encodeURIComponent(keyWordIn.value)
    const formData=new FormData();
    formData.append('q', keyWord);
    fetch("api_google.php", {method: 'post', body: formData}).then(onResponse).then(onJsonGL);
}

function onResponse(response)
{
    if(!response.ok){
        console.log('ERRORE RESPONSE');
        return null;
    }
    return response.json();
}

function onJsonGL(json){
    console.log('json ricevuto');
    libreria.innerHTML='';
    let numLibri=json.totalItems;
    console.log(numLibri);
    if(numLibri>8)
        numLibri=8;
    for(let i=0; i<numLibri;i++){
        const doc=json.items[i];
        const titolo=doc.volumeInfo.title;
        console.log(i);
        const book=document.createElement('div');
        book.classList.add('libro');
        book.setAttribute("data-titolo",titolo);
        book.addEventListener("click", onClickBook); 
        const autore=( typeof doc.volumeInfo.authors === "undefined" ? "" : `${doc.volumeInfo.authors[0]}`);
        book.setAttribute("data-autore",autore);
        const coverURL = ( typeof doc.volumeInfo.imageLinks === "undefined" ? "img/14.png" : `${doc.volumeInfo.imageLinks.thumbnail}`);
        const img = document.createElement('img');
        img.src = coverURL;
        book.appendChild(img);
        caption=document.createElement('span');
        caption.textContent=titolo;
        book.appendChild(caption);
        libreria.appendChild(book);
    }
}

function onClickBook(event){
    const book=event.currentTarget;
    const q= encodeURIComponent(book.dataset.titolo+' '+book.dataset.autore);
    console.log(q);
    const formData=new FormData();
    formData.append('q', q);
    fetch("api_ebay.php", {method: 'post', body: formData}).then(onResponse).then(onJsonE);
}

function onJsonE(json)
{
    if(json===null || json.total===0)
        {
            const nonPresente=document.createElement('text');
            nonPresente.textContent="     NON PRESENTE";
            form1.appendChild(nonPresente);
            console.log("fatto");
            setTimeout(() => { form1.removeChild(nonPresente); }, 1200);
            return;
    }
         
    window.open(json.itemSummaries[0].itemWebUrl);
}

function onClickRegistrati(){
    modal_view_I.classList.remove('hidden');
    back.addEventListener('click',onClickBack)

}

const img3=document.querySelector("#img3");
img3.addEventListener('mouseover',onMouseOver_img3);
img3.addEventListener('mouseout',onMouseOut_img3);

const infoBox=document.querySelector('#infoBox');
const facoltà_list=document.querySelectorAll('#colonna_dx li');

const buttonInfo=document.querySelector('#più_info');
buttonInfo.addEventListener('click',onClickInfo);

const buttonLibri=document.querySelector('#cerca_libri');
buttonLibri.addEventListener('click',onClickCercaLibri);

const modal_view=document.querySelector('#modal_view');

const back=document.querySelector(".back");

const form1=document.querySelector('#form1');
form1.addEventListener('submit',search);

const keyWordIn=document.querySelector('#keyWordIn');
const libreria=document.querySelector('#libreria');
