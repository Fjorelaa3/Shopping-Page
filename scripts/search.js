console.log('running search');
//Funksioni per Search
const search = () => {
    const searchBox = document.getElementById("search-item").value.toUpperCase();
    const storeItems = document.getElementById("pro-container");
    const product = document.querySelectorAll(".pro");
    const pname = document.getElementsByTagName("h5");

    for (var i = 0; i < pname.length; i++) {
        let match = product[i].getElementsByTagName("h5")[0];
        if (match) {
            let textValue = match.textContent || match.innerHTML;
            if (textValue.toUpperCase().indexOf(searchBox) > -1) {
                product[i].style.display = "";
            } else {
                product[i].style.display = "none";
            }
        }
    }
}

//Validimet dhe logjika e butonit Buy NOw
let buyNow = document.getElementById("buyNow");
buyNow.addEventListener('click', () => {
    console.log('dua te blej');
    let cartCost = localStorage.getItem('totalCost');
    cartCost = parseInt(cartCost);
    
      if (cartCost == 0 || isNaN(cartCost)) {
        //alert('Ju nuk keni gje ne shport');
       
        // Get the modal
        var modal = document.getElementById("myModal2");
        /*
        // Get the button that opens the modal
        var btn1 = document.getElementById("buyNow");
        */
        // Get the <span> element that closes the modal
        var span1 = document.getElementsByClassName("close1")[0];

        // When the user clicks on the button, open the modal
        //btn.onclick = function() {}
        modal.style.display = "block";


        // When the user clicks on <span> (x), close the modal
        span1.onclick = function () {
            //console.log("shtype x");
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                //console.log("shtype jasht kutis");
                modal.style.display = "none";
            }
        }



    }
    else {
        //console.log('Fillojm me validimet e Formes');
        let details = formValidation();
        //ruajme piket e reja ne cookie ,Nuk do perdor kete menyre
        document.cookie="points="+cartCost; 

        if (details) {
            //Dergojm datat ne email
            sendData(details);

            //Dergojme piket ne DB
             setNewPoints(cartCost);
        }
        
    }



});

/*function setNewPoints (cartCost){
 
    var points={newPoints: cartCost};
    $.ajax({
        type:"POST",
        url:"update_points.php", //?action=next
        data:points,
        //dataType: 'json',
        //cache: false,
        success: function(html){
            console.log("Derguam piket ne db");
            console.log(html);//nese ka ndonje error ne php del ketu
        }

    });
  
}*/


function formValidation() {
    var name = document.forms.RegForm.Name.value;
    var email = document.forms.RegForm.EMail.value;
    var phone = document.forms.RegForm.Telephone.value;
    var address = document.forms.RegForm.Address.value;
    var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;  //Javascript reGex for Email Validation.
    var regPhone = /^\d{10}$/;                                        // Javascript reGex for Phone Number validation.
    var regName = /\d+$/g;                                    // Javascript reGex for Name validation

    if (name == "" || regName.test(name)) {
        var error = document.getElementById("nameError");
        error.textContent = "Please enter your name properly.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.Name.focus();
        return false;
    } else {
        var error = document.getElementById("nameError");
        error.textContent = "";
    }

    if (email == "" || !regEmail.test(email)) {
        var error = document.getElementById("emailError");
        error.textContent = "Please enter a valid e-mail address.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.EMail.focus();
        return false;
    } else {
        var error = document.getElementById("emailError");
        error.textContent = "";
    }

    if (phone == "" || !regPhone.test(phone)) {
        var error = document.getElementById("phoneError");
        error.textContent = "Please enter valid phone number.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.Telephone.focus();
        return false;
    } else {
        var error = document.getElementById("phoneError");
        error.textContent = "";
    }

    if (address == "") {
        var error = document.getElementById("addressError");
        error.textContent = "Please enter your address.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.Address.focus();
        return false;
    } else {
        var error = document.getElementById("addressError");
        error.textContent = "";
    }


    return {
        Name: name,
        Email: email,
        Phone: phone,
        Address: address
    };


}