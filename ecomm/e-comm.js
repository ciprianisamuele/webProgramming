const sideBar = document.querySelector(".sidebar")
const cartButt = document.querySelector("#cart")
const header = document.querySelector("header")
const shopContent = document.querySelector(".shop-content")

const cartContent = document.querySelector(".cart-content")
const cartPrice= document.querySelector(".cart-price")
const cartQuantity = document.querySelector(".quantity")
const sideBarIn = document.querySelector(".sidebar-in")
const removeAllButt = document.querySelector(".remove-all");
const subAccountButt = document.querySelector(".sub-account");
const accountButt = document.querySelector("#accedi")





let boolBlack = 0;
let w = $(window).width();
let h = $(window).height();


var $overlay = $('<div/>', {
    'id': 'overlay',
    css: {
     position   : 'absolute',
     height     : h + 'px',
     width      : w + 'px',
     left       : 0,
     top        : 100,
     background : '#000',
     opacity    : 0.5,
     zIndex: 90,
     TransitionEvent: 0.5
    }
}).appendTo('body');

$('#overlay').hide();



$('#overlay').click(function(){
    $(this).hide();
    $(".box-log").empty();
})


$('#accedi').mouseenter(function(){
    subAccountButt.classList.add("active");
    $('#overlay').show();
    
})

$('#accedi').mouseleave(function(){
    subAccountButt.classList.remove("active");
    if(!boolBlack){
        $('#overlay').hide();
    }
    boolBlack = 0;
    
})

$('.sub-account').mouseenter(function(){
    subAccountButt.classList.add("active");
    $('#overlay').show();
    
})

$('.sub-account').mouseleave(function(){
    subAccountButt.classList.remove("active");
    if(!boolBlack){
        $('#overlay').hide();
    }
    boolBlack = 0;
    
})

cartButt.onmouseover= () =>{
    sideBar.classList.add("active");
}

cartButt.onmouseout = () =>{
    sideBar.classList.remove("active");
}
sideBar.onmouseover = ()=>{
    sideBar.classList.add("active");
}
sideBar.onmouseout = () =>{
    sideBar.classList.remove("active");
}



listProd = [
    {
        ide: 1,
        name: "Scarpa1", 
        img: "scarpa1.png",
        price: 2000,
        voto:4


    },
    {
        ide: 2,
        name: "Scarpa2", 
        img: "scarpa2.png",
        price: 3000,
        voto:3

    },
    {
        ide: 3,
        name: "Scarpa3", 
        img: "scarpa3.png",
        price: 1000,
        voto:4.5
    },
    {
        ide: 4,
        name: "Scarpa4", 
        img: "scarpa4.png",
        price: 5000,
        voto:2
    },
    {       
        ide: 5,
        name: "Scarpa5", 
        img: "scarpa5.png",
        price: 2500,
        voto:3
    },
    {
        ide: 6,
        name: "Scarpa6", 
        img: "scarpa6.png",
        price: 300,
        voto:5
    }
];


let listCard;

if (!localStorage.getItem("listCardLocStor")) {
    listCard = [];
  } else {
    listCard = JSON.parse(localStorage.getItem("listCardLocStor"));
}
function popola(list){
    for(let prod of list){
        let newDiv =document.createElement("div");
        newDiv.classList.add("item");
        newDiv.innerHTML = `
        
        
        <img src = "http://localhost:80/img/FOTO/${prod.img}" class ="product-image">
       
        <div class="caption">
            <h2 id = "title">${prod.name}</h2>
            <span id = "product-price">$${prod.price}</span>
            <button id = "${prod.ide}" class = "addcart" onclick = "addCart('${prod.name}','${prod.ide}','${prod.img}', '${prod.price}','${prod.voto}')"><i class="fa-solid fa-cart-plus"></i></button>
            <div id = "recensione" class = ${prod.voto}></div>

        `
        shopContent.appendChild(newDiv);


    }

}

popola(listProd);
localStorage.setItem("listProd", JSON.stringify(listProd));



reloadCart();




function reloadCart(){

    let sumQuant = 0;
    let sumPrice = 0;


    while (cartContent.lastElementChild) {
        cartContent.removeChild(cartContent.lastElementChild);
    }

    if(listCard.length === 0){


        let newDi =document.createElement("div");
        newDi.classList.add("empty");
        newDi.innerText = "Carrello vuoto";
        cartContent.appendChild(newDi);
        removeAllButt.style.display = 'none';

    }
    else{
        removeAllButt.style.display = 'flex';
    }

    for(let prod of listCard){

        let newDiv =document.createElement("div");
        newDiv.classList.add("item");
        newDiv.innerHTML = `
        <img src = "http://localhost:80/img/FOTO/${prod.img}" class ="product-image">
       
        <div class="caption">
            <div id="wrapper">
            <h2 id = "title">${prod.name}</h2>
            <span id = "product-price">$${prod.price*prod.qt}</span>
            </div>


            <div class="wrapper-right">
            <button id = "${prod.ide}" class = "addcart" onclick = "addQuant('${prod.qt}','${prod.ide}')">+</button>
            <span id = "quantity">${prod.qt}</span>
            <button id = "${prod.ide}" class = "addcart" onclick = "remQuant('${prod.qt}','${prod.ide}')">-</button>
            </div>

        `

        sumQuant += Number(prod.qt);
        sumPrice += Number(prod.price*prod.qt);
        cartContent.appendChild(newDiv);
    }

    cartPrice.innerText = '$' + sumPrice;
    cartQuantity.innerText= sumQuant;

    

    localStorage.removeItem("listCardLocStor");
    localStorage.setItem("listCardLocStor", JSON.stringify(listCard));




    
    

}

function addQuant(quant, idd){

    if(cartQuantity.innerText < 99){
        let i = listCard.findIndex(e => e.ide === idd);

        listCard[i].qt++;
        reloadCart();
    }
    else{

    }

}
function remQuant(quant, idd){

    let i = listCard.findIndex(e => e.ide === idd);
    quant--;

    if(quant === 0){
        
        listCard.splice(listCard[i],1);
    }
    else{

        listCard[i].qt--;
    }
    reloadCart();
}

const addCart = (nam, idd, im, pric, vot) => {

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

function showLog(stadio){

    logSess = document.querySelector("#log-session");
    regSess = document.querySelector("#reg-session");

    if(stadio == "log"){

        regSess.style.display="flex";
        regSess.style.display="none";
    }

    if(stadio == "reg"){

        regSess.style.display="none";
        regSess.style.display="flex";

    }
}
function changeLog(stadio){
    $(".box-log").empty();

    if(stadio == "log" ){

        $(".box-log").load("http://localhost:80/logg.php .box" );
        


    }
    else if(stadio == "reg"){
        $(".box-log").load("http://localhost:80/register.php .box" );

    }
    

}

function accediFunction(stadio){

    if(stadio == "log"){
        $(".box-log").load("http://localhost:80/logg.php .box" );
        $('#overlay').show();
        subAccountButt.classList.remove("active");
        

    }
    else if(stadio == "acc"){

        window.location = "account.php";
    }
    else{
        console.log("Error");
    }

    boolBlack = 1;
}

   // Add overlay and make clickable





   // Click overlay to remove


