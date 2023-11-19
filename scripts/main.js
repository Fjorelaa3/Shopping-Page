let carts = document.querySelectorAll(".fa-shopping-cart");

//nje array qe mban objekte
let products = [
  {
    name: "T-Shirt",
    tag: "f1",
    price: 70,
    inCart: 0,
  },
  {
    name: "Shirt",
    tag: "f2",
    price: 30,
    inCart: 0,
  },
  {
    name: "Shoes",
    tag: "f3",
    price: 50,
    inCart: 0,
  },
  {
    name: "White hoodie",
    tag: "f4",
    price: 90,
    inCart: 0,
  },
  {
    name: "Full-Zip Jacket",
    tag: "f5",
    price: 100,
    inCart: 0,
  },
  {
    name: "Casual Shirt",
    tag: "f6",
    price: 10,
    inCart: 0,
  },
  {
    name: "Puffer Jacket",
    tag: "f7",
    price: 70,
    inCart: 0,
  },
  {
    name: "Formal Shirt",
    tag: "f8",
    price: 70,
    inCart: 0,
  },
  {
    name: "Hoodie",
    tag: "f9",
    price: 100,
    inCart: 0,
  },
  {
    name: "Zip-hoodie",
    tag: "f10",
    price: 120,
    inCart: 0,
  },
];
//carts[1] kap  produktin e dyte tek screeni
for (let i = 0; i < carts.length; i++) {
  carts[i].addEventListener("click", () => {
    console.log(" u shtua ne shporte");
    cartNumbers(products[i]);
    totalCost(products[i]);
  });
}

//Ky funksion updateon labelin tek cart icon pasi i kemi ber refresh page
function onLoadCartNumbers() {
  let productNumbers = localStorage.getItem("cartNumbers");
  if (productNumbers) {
    document.querySelector(".fa-shopping-bag span").textContent =
      productNumbers;
  }
}

function cartNumbers(product) {
  //console.log('The product clicked is ',product); //e kalojme ne local storage me setItems()
  let productNumbers = localStorage.getItem("cartNumbers");
  //console.log(productNumbers);
  //console.log(typeof productNumbers); //Shikojme se product number vjen si string
  // duhet ta konvertojm, problem tipik i js
  productNumbers = parseInt(productNumbers);

  if (productNumbers) {
    //Ne kemi zgjedhur produkte me para
    localStorage.setItem("cartNumbers", productNumbers + 1);
    document.querySelector(".fa-shopping-bag span").textContent =
      productNumbers + 1;
  } else {
    localStorage.setItem("cartNumbers", 1);
    //kapim labelin tek shporta qe duhet ndryshuar
    document.querySelector(".fa-shopping-bag span").textContent = 1;
  }
  setItems(product);
}

function setItems(product) {
  //Check first if is any product in local storage:
  let cartItems = localStorage.getItem("productsInCart");
  cartItems = JSON.parse(cartItems); //E kalojme nga JSON ne nje object js

  if (cartItems != null) {
    //Ne local storage ka dicka
    if (cartItems[product.tag] == undefined) {
      //Ky prdukt nuk eshte i pari ne shporte por eshte shtuar ne shport per here te pare
      cartItems = {
        ...cartItems,
        [product.tag]: product,
      };
    }
    cartItems[product.tag].inCart += 1;
  } else {
    //po shton per here te pare
    product.inCart = 1;

    cartItems = {
      [product.tag]: product,
    };
  }
  localStorage.setItem("productsInCart", JSON.stringify(cartItems));
}

function totalCost(product) {
  //console.log('The product: '+product.name+' costs: ',product.price);
  let cartCost = localStorage.getItem("totalCost");
  //First you have to chheck if there is a total cost in the localStorage
  if (cartCost != null) {
    //Always when you get somthin from the local storage it comes as a string so you have to parse
    cartCost = parseInt(cartCost);
    localStorage.setItem("totalCost", cartCost + product.price);
  } else {
    localStorage.setItem("totalCost", product.price);
  }
}
function displayCart() {
  let cartItems = localStorage.getItem("productsInCart");
  cartItems = JSON.parse(cartItems);
  console.log(cartItems);
  let cartCost = localStorage.getItem("totalCost");
  let productContainer = document.querySelector(".products");
  //kontrollojm nese kemi produkte ne localStorage dhe vendosim nje specifik qe ky if do te
  //aksesohet vetem nese jemi ne cart Page sepse po i referohemi nje elmenti html te kesaj faqeje
  if (cartItems && productContainer) {
    //console.log('Jemi ne cartPage dhe ne local Storage ka dicka');
    productContainer.innerHTML = "";
    Object.values(cartItems).map((item) => {
      productContainer.innerHTML += `
            <tr>
					<td><a href="#"><i class="far fa-times-circle cart-removes" ></i></a></td>
					<td><img src="img/products/${item.tag}.jpg"></td>
					<td>${item.name}</td>
					<td>$${item.price},00</td>
					<td><input type="number" class="cart-quantity" value="${item.inCart}"></td>
					<td>$${item.inCart * item.price},00</td>
			</tr>
            `;
    });
    //Nese duam t i bejm remove nje produkti
    let removeCartButtons = document.querySelectorAll(".fa-times-circle");
    for (let i = 0; i < removeCartButtons.length; i++) {
      //var button = removeCartButtons[i];removeCartItem
      removeCartButtons[i].addEventListener("click", () => {
        console.log("dua t fshi ", i);
        removeCartItem(i);
      });
    }
    //Nese duam te nryshojme sasine
    let quantityInputs = document.querySelectorAll(".cart-quantity");

    for (let i = 0; i < quantityInputs.length; i++) {
      quantityInputs[i].addEventListener("change", () => {
        //console.log('produkti me index: ',i);

        quantityChanged(event, i);
      });
    }
  }

  let productTotal1 = document.querySelector(".cart-total1");
  if (cartItems && productTotal1) {
    productTotal1.innerHTML = "";
    productTotal1.innerHTML += `
         <tr>
            <td>Cart Subtotal</td>
            <td> $${cartCost},00</td>
        </tr>
        <tr>
            <td>Shipping</td>
            <td>Free</td>
        </tr>
        <tr>
            <td><strong>Total:</strong></td>
            <td><strong> $${cartCost},00</strong></td>
         </tr>
        
         `;
  }
}

function removeCartItem(i) {
  let cartItems = localStorage.getItem("productsInCart");
  cartItems = JSON.parse(cartItems);
  //E kemi objekt duhet ta kalojme ne array qe te heqim elementin me index i
  console.log(cartItems);
  let entries = Object.entries(cartItems);
  entries.splice(i, 1);
  console.log(entries);
  updateLocalStorage(entries);
}

function quantityChanged(event, i) {
  var input = event.target;
  if (isNaN(input.value) || input.value <= 0) {
    input.value = 1;
  }
  //console.log('produkti me index: ',i);
  //console.log('sasiaa e re :',input.value);

  //Ndryshojm sasin
  let cartItems = localStorage.getItem("productsInCart");
  cartItems = JSON.parse(cartItems);
  //E kemi objekt duhet ta kalojme ne array qe te heqim elementin me index i

  let entries = Object.entries(cartItems);
  entries[i][1].inCart = parseInt(entries[i][1].inCart);
  entries[i][1].inCart = parseInt(input.value);

  updateLocalStorage(entries);
}
function updateLocalStorage(entries) {
  localStorage.clear();
  let totalCost = 0;
  let TotalCartNumbers = 0;
  TotalCartNumbers = parseInt(TotalCartNumbers);
  //for(let i=0;i<)
  console.log(entries);
  for (let i = 0; i < entries.length; i++) {
    console.log(entries[i][1].price);
    console.log(entries[i][1].inCart);
    totalCost += entries[i][1].price * parseInt(entries[i][1].inCart);
    TotalCartNumbers += parseInt(entries[i][1].inCart);
  }

  //Me pas e kalojm prap ne object qe ta hedhim ne localStorage
  const cartItems = entries.reduce((result, [key, value]) => {
    result[key] = value;

    return result;
  }, {});

  //totalCost= Math.round(totalCost* 100)/100;
  localStorage.setItem("productsInCart", JSON.stringify(cartItems));
  localStorage.setItem("totalCost", totalCost);
  localStorage.setItem("cartNumbers", TotalCartNumbers);
  document.querySelector(".fa-shopping-bag span").textContent =
    TotalCartNumbers;

  displayCart();
}

onLoadCartNumbers();
displayCart();
