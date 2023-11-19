
let carts= document.querySelectorAll('.fa-shopping-cart');

//nje array qe mban objekte
let products =[
    {
        name: 'T-Shirt',
        tag: 'f1',
        price: 70,
        inCart:0
    },
    {
        name: 'Shirt',
        tag: 'f2',
        price:30,
        inCart:0
    },
    {
        name: 'Shoes',
        tag: 'f3',
        price: 50,
        inCart:0
    },
    {
        name: 'White hoodie',
        tag: 'f4',
        price: 90,
        inCart:0
    },
    {
        name: 'Full-Zip Jacket',
        tag: 'f5',
        price: 100,
        inCart:0
    },
    {
        name: 'Casual Shirt',
        tag: 'f6',
        price: 10,
        inCart:0
    },
    {
        name: 'Puffer Jacket',
        tag: 'f7',
        price: 70,
        inCart:0
    },
    {
        name: 'Formal Shirt',
        tag: 'f8',
        price: 70,
        inCart:0
    },
    {
        name: 'Hoodie',
        tag: 'f9',
        price: 100,
        inCart:0
    },
    {
        name: 'Zip-hoodie',
        tag: 'f10',
        price: 120,
        inCart:0
    }
];
//carts[1] kap  produktin e dyte tek screeni
for(let i=0; i<carts.length;i++){
    carts[i].addEventListener('click',()=>{
        console.log(' u shtua ne shporte');
        cartNumbers(products[i]);
        totalCost(products[i]);
    })
}



//Ky funksion updateon labelin tek cart icon pasi i kemi ber refresh page
function onLoadCartNumbers(){
    let productNumbers = localStorage.getItem('cartNumbers');
    if(productNumbers){
        document.querySelector('.fa-shopping-bag span').textContent =productNumbers;
    }
}


function cartNumbers(product){
    //console.log('The product clicked is ',product); //e kalojme ne local storage me setItems()
    let productNumbers = localStorage.getItem('cartNumbers');
   //console.log(productNumbers);
   //console.log(typeof productNumbers); //Shikojme se product number vjen si string
    // duhet ta konvertojm, problem tipik i js
    productNumbers=parseInt(productNumbers);
    
    if(productNumbers){
        //Ne kemi zgjedhur produkte me para
        localStorage.setItem('cartNumbers',productNumbers +1);
        document.querySelector('.fa-shopping-bag span').textContent =productNumbers+ 1;
    } else{
        localStorage.setItem('cartNumbers',1);
        //kapim labelin tek shporta qe duhet ndryshuar
        document.querySelector('.fa-shopping-bag span').textContent =1;
    }
    setItems(product);
}


function setItems(product){
    //Check first if is any product in local storage:
    let cartItems= localStorage.getItem('productsInCart');
    cartItems=JSON.parse(cartItems); //E kalojme nga JSON ne nje object js

    if(cartItems !=null){
        //Ne local storage ka dicka
        if(cartItems[product.tag] == undefined){
            //Ky prdukt nuk eshte i pari ne shporte por eshte shtuar ne shport per here te pare
            cartItems={
                ...cartItems,
                [product.tag]:product
            }
        }
        cartItems[product.tag].inCart +=1;
    }else{
        //po shton per here te pare
        product.inCart=1;

        cartItems={
            [product.tag]:product
        }
    }
    localStorage.setItem("productsInCart",JSON.stringify(cartItems));

}

function totalCost(product){
    //console.log('The product: '+product.name+' costs: ',product.price);
    let cartCost= localStorage.getItem('totalCost');
     //First you have to chheck if there is a total cost in the localStorage
    if(cartCost != null){
          //Always when you get somthin from the local storage it comes as a string so you have to parse
        cartCost=parseInt(cartCost);
        localStorage.setItem('totalCost',cartCost + product.price);
    }else{
        localStorage.setItem('totalCost',product.price);
    }
}
