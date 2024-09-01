
const cartContent = document.querySelector(".cart-list");
const cartQuantity = document.querySelector(".quantity");
const cartPrice= document.querySelector(".cart-price");
const totCart = document.querySelector(".tot-article");
const articleToAdd = document.querySelector(".add-to-cart");
const selezionaTutto = document.querySelector(".right-cart-seleziona");
const seleziona = document.querySelector(".chec");
let listCard;


function initCart(){

    if (!localStorage.getItem("listCardLocStor")) {
        listCard = [];
      } else {
        listCard = JSON.parse(localStorage.getItem("listCardLocStor"));
    }
}

initCart();
reloadCart();

function reloadCart(){

    let sumQuant = 0;
    let sumPrice = 0;

    while (cartContent.lastElementChild) {
        cartContent.removeChild(cartContent.lastElementChild);
    }


    for(let prod of listCard){

   

        let newDiv =document.createElement("div");
        newDiv.classList.add("item");
        newDiv.innerHTML = `
        
        <label class="checkbox">
            
            
            <input type = "checkbox" class = "check " id = "selected-${prod.ide}" onchange = "selectToCart('${prod.ide}')"/>
            
            <span class="checkmark"></span>
            <i class="fa-solid fa-square-check" id = "checkk"></i>
            
        </label>
        <img src = "http://localhost:8080/img/FOTO/${prod.img}" class ="product-image">
       
        <div class="caption">
            
            <h2 id = "title">${prod.name}</h2>
            
            <button id = "${prod.ide}" class = "remove-cart" onclick = "remove('${prod.ide}')"><i class="fa-solid fa-trash"></i></button>
            <div id="wrapper"></div>
            <span id = "product-price">$${prod.price*prod.qt}</span>


   
            <select class = "numb-select-${prod.ide}" id = "${prod.ide}" onchange = "changeQt('${prod.ide}')"></select>

        </div>

        `
        cartContent.appendChild(newDiv);

        let isSelectedToCart = document.querySelector(`#selected-${prod.ide}`);

        if(prod.isSelected){
            isSelectedToCart.checked = true;
        }
        
        
        let selectNumb = document.querySelector(`.numb-select-${prod.ide}`);

        for(let i=1; i<100;i++){
            
            let label = i;
            let value = i;

            if(i == prod.qt){
  
                selectNumb.insertAdjacentHTML('beforeend', `
                <option selected ="selected" value="${value}">${label}</option>
                `)
            }
            else{
                selectNumb.insertAdjacentHTML('beforeend', `
                <option value="${value}">${label}</option>
                `)
            }
        }
        
        if(prod.isSelected){
            sumQuant += Number(prod.qt);
            sumPrice += Number(prod.price*prod.qt);
        }
    }

    cartPrice.innerText =  sumPrice + '$';
    cartQuantity.innerText= sumQuant;
    totCart.innerText = `Totale (${sumQuant} articoli)`;

    let rightDisp = document.querySelector(".right-cart");

    if(listCard.length === 0){

        let newDi = document.createElement("div");
        newDi.classList.add("empty");
        newDi.innerText = "Carrello vuoto";
        cartContent.appendChild(newDi);
        rightDisp.style.display = 'none';
        
        
    }
    else{
        selezionaTutto.innerHTML = `Seleziona tutto (${sumQuant} articoli)`;
        rightDisp.style.display = 'flex';
    }

    


    
    localStorage.removeItem("listCardLocStor");
    localStorage.setItem("listCardLocStor", JSON.stringify(listCard));
    


}

function remove(idd){

    let i = listCard.findIndex(e => e.ide === idd);
    listCard.splice(listCard[i],1);
    reloadCart();
}

function changeQt(idd){
    let i = listCard.findIndex(e => e.ide === idd);
    listCard[i].qt = document.querySelector(`.numb-select-${idd}`).value;
    console.log(document.querySelector(`.numb-select-${idd}`).value);
    reloadCart();

}

listProd = JSON.parse(localStorage.getItem("listProd"));
console.log(listProd);
function initListToAdd(){

    for(let prod of listProd){

        let newDiv = document.createElement("div");
        newDiv.classList.add("item");
        newDiv.innerHTML = `
        <img src = "http://localhost:8080/img/FOTO/${prod.img}" class ="product-image">
       
        <div class="caption">
            <h2 id = "title">${prod.name}</h2>
            <span id = "product-price">$${prod.price}</span>
            <span class = "${prod.voto}">voto</span>
            <button id = "${prod.ide}" class = "addcart" onclick =  "addCart('${prod.name}','${prod.ide}','${prod.img}', '${prod.price}','${prod.voto}')">
            <i class="fa-solid fa-cart-plus"></i></button>
            
            
        </div>

        `

        articleToAdd.appendChild(newDiv);

    }
    
    
}
initListToAdd();

function addCart(nam, idd, im, pric, vot) {

    let i = listCard.findIndex(e => e.ide === idd);

    
    if (i === -1) {
   

        let obj = {
            name: nam,
            img: im,
            price: pric,
            ide: idd,
            voto: vot,
            qt: 1,
            isSelected: 'true'

        }
        listCard.push(obj);
    
    }
    else{

        listCard[i].qt++;
        
    }
    reloadCart();
}

function removeAll(){
    listCard = [];
    reloadCart();

}

function selectAll(){
    

    if(seleziona.id == "unselected"){
        listCard.forEach(prod => {
            prod.isSelected = true;
        })
        seleziona.id = "selected";
    }   
    else{
        listCard.forEach(prod => {
            prod.isSelected = false;
        })
        seleziona.id = "unselected";
    }
    reloadCart();


}
function selectToCart(idd){

    let i = listCard.findIndex(e => e.ide === idd);
    (listCard[i].isSelected === true) ? listCard[i].isSelected = false : listCard[i].isSelected = true;

    

    reloadCart();
}