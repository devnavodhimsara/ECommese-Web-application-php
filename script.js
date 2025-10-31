function forgotPassword() {

    var email = document.getElementById("email");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var text = request.responseText;

            if (text == "Success") {
                alert("Verification code has sent successfully. Please check your Email.");
                var modal = document.getElementById("fpmodal");
                forgotPasswordModal = new bootstrap.Modal(modal);
                forgotPasswordModal.show();
            } else {
                document.getElementById("msg1").innerHTML = text;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    request.send();

}
function forgotPassword1() {

    var email = document.getElementById("email");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var text = request.responseText;

            if (text == "Success") {
                alert("Verification code has sent successfully. Please check your Email.");
                var modal = document.getElementById("fpmodal");
                forgotPasswordModal = new bootstrap.Modal(modal);
                forgotPasswordModal.show();
            } else {
                document.getElementById("msg1").innerHTML = text;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("GET", "forgotPasswordProcesssel.php?e=" + email.value, true);
    request.send();

}

function forgotPassword2() {

    var email = document.getElementById("email");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var text = request.responseText;

            if (text == "Success") {
                alert("Verification code has sent successfully. Please check your Email.");
                var modal = document.getElementById("fpmodal");
                forgotPasswordModal = new bootstrap.Modal(modal);
                forgotPasswordModal.show();
            } else {
                document.getElementById("msg1").innerHTML = text;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("GET", "forgotPasswordProcess2.php?e=" + email.value, true);
    request.send();

}

function showPassword1() {

    var textfield = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide";
    } else {
        textfield.type = "password";
        button.innerHTML = "Show";
    }

}

function showPassword2() {

    var textfield = document.getElementById("rnp");
    var button = document.getElementById("rnpb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide";
    } else {
        textfield.type = "password";
        button.innerHTML = "Show";
    }

}

function resetPassword() {

    var email = document.getElementById("email");
    var newPassword = document.getElementById("np");
    var retypePassword = document.getElementById("rnp");
    var verification = document.getElementById("vcode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", newPassword.value);
    form.append("r", retypePassword.value);
    form.append("v", verification.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Password updated successfully.");
                forgotPasswordModal.hide();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);

}

function resetPassword1() {

    var email = document.getElementById("email");
    var newPassword = document.getElementById("np");
    var retypePassword = document.getElementById("rnp");
    var verification = document.getElementById("vcode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", newPassword.value);
    form.append("r", retypePassword.value);
    form.append("v", verification.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Password updated successfully.");
                forgotPasswordModal.hide();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "resetPassword1Process.php", true);
    request.send(form);

}

function resetPassword2() {

    var email = document.getElementById("email");
    var newPassword = document.getElementById("np");
    var retypePassword = document.getElementById("rnp");
    var verification = document.getElementById("vcode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", newPassword.value);
    form.append("r", retypePassword.value);
    form.append("v", verification.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Password updated successfully.");
                forgotPasswordModal.hide();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "resetPassword2Process.php", true);
    request.send(form);

}


  function blockProduct(id){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            alert (response);
            window.location.reload();
        }
    }

    request.open("GET","productBlockProcess.php?id="+id,true);
    request.send();
    
}


function changeProfileImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }



}
function selsingup(){
   var username = document.getElementById("uname");
   var email =document.getElementById("email");
var password= document.getElementById("password");

var form = new FormData();
form.append("u",username.value);
form.append("e",email.value);
form.append("p",password.value);
var request = new XMLHttpRequest();
request.onreadystatechange =function(){
    if(request.readyState == 4 && request.status == 200){
        var response = request.responseText;
        if(response=="success"){
            window.location="sellersingin.php";
        }else{
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";
        }
        
    }
    
}
request.open("POST", "selsingupprocess.php", true);
request.send(form);
                
}
function massegesent(){
    var username = document.getElementById("name");
    var email = document.getElementById("email");
    var pn = document.getElementById("phonenumber");
    var ms = document.getElementById("message");

    var form = new FormData();
    form.append("u",username.value);
    form.append("e",email.value);
    form.append("pn",pn.value);
    form.append("mg",ms.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange =function(){
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            if(response=="success"){
                // Success - show a sweet alert
                Swal.fire({
                    title: 'Success!',
                    text: 'Message sent successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload(); // Reload the page
                });
            } else {
                // Error - show a sweet alert
                Swal.fire({
                    title: 'Error!',
                    text: response, // Display the error message from the server
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    };

    request.open("POST", "contractprocess.php", true);
    request.send(form);
} 



function selloging(){
var email =document.getElementById("email");
var password = document.getElementById("password");

var form = new FormData();
form.append("e",email.value);
form.append("p",password.value);

var request = new XMLHttpRequest();

request.onreadystatechange  = function(){
    if(request.status == 200 && request.readyState == 4 ){
        var response = request.responseText;
        if(response=="success"){
            window.location ="dashboard.php";
        }else{
            document.getElementById("msg1").innerHTML = response;
            document.getElementById("msgdiv1").className = "d-block";
        }
    }
}
request.open("POST","selsinginprocess.php",true);
request.send(form);
}

function loadusers(){
    var request = new XMLHttpRequest();



    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
    
            if (response == "") {
                window.location= "customers.php";
               
            
                
            } else {
             
              
               
            }
    
        }
    }
    
    request.open("POST", "customerprocess.php", true);
    request.send(form);
    
    }

function singup(){
var firstname= document.getElementById("firstname");
var lastname= document.getElementById("lastname");
var email= document.getElementById("email");
var password= document.getElementById("password");
var mobile_number= document.getElementById("mobile_number");

var form = new FormData();
form.append("f",firstname.value);
form.append("l",lastname.value);
form.append("e",email.value);
form.append("p",password.value);
form.append("m",mobile_number.value);
var request = new XMLHttpRequest();

request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
        var response = request.responseText;

        if (response == "success") {
            window.location= "loging.php";
           
        
            
        } else {
         
            document.getElementById("msg1").innerHTML = response;
            document.getElementById("msgdiv1").className = "d-block";
           
        }

    }
}

request.open("POST", "signupProcess.php", true);
request.send(form);

}
function singin(){
    var email = document.getElementById("email");
    var password = document.getElementById("password");


    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
  

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "indexlk.php";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("POST", "signInProcess.php", true);
    request.send(form);

}

function adminsingin(){
    var email = document.getElementById("email");
    var password = document.getElementById("password");


    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
  

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "admindashboard.php";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("POST", "adminsignInProcess.php", true);
    request.send(form);

}



function updateProfile() {

    let image = document.getElementById("profileimage");
    let fname = document.getElementById("fname");
    let lname = document.getElementById("lname");
    let ad1 = document.getElementById("ad1");
    let ad2 = document.getElementById("ad2");

    let form = new FormData();

    form.append("i", image.files[0]);
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("ad1", ad1.value);
    form.append("ad2", ad2.value);

    let request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            let response = request.responseText;

            if (response == "Updated" || response == "Saved") {
                swal("Success", "Your profile has been updated.", "success");
                window.location = "sellersingin.php";
            } else if (response == "You have not selected any image.") {
                swal("Error", "You have not selected any image.", "error");
                window.location = "indexlk.php";
            } else {
                swal("Error", response, "error");
            }
        }
    };

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);

}
function buyNow(id) {
    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (response == 1) {
                alert("Please Login.");
                window.location = "index.php";
            } else if (response == 2) {
                alert("Please update your profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    alert("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);

                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/hedar%20and%20footer%20day%202/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/hedar%20and%20footer%20day%202/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                  
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }

    request.open("GET", "buynowProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

function checkuout() {
    var name = document.getElementById("name").innerHTML;
    var price = document.getElementById("price").innerHTML;

    var form = new FormData();
    form.append("name", name);
    form.append("price", price);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "checkoutProcess.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    if (data.success) {
                        // Payment completed. It can be a successful failure.
                        payhere.onCompleted = function onCompleted(orderId) {
                            console.log("Payment completed. OrderID:" + orderId);
                            alert("Payment completed. OrderID:" + orderId);
                            saveInvoicecart(orderId, price);
                        };

                        // Payment window closed
                        payhere.onDismissed = function onDismissed() {
                            console.log("Payment dismissed");
                        };

                        // Error occurred
                        payhere.onError = function onError(error) {
                            console.log("Error:" + error);
                        };

                        // Put the payment variables here
                        var payment = {
                            sandbox: true,
                            merchant_id: data.merchant_id, // Replace with your Merchant ID
                            return_url: "http://localhost/hedar%20and%20footer%20day%202/cart.php" ,  // Important 
                            cancel_url: "http://localhost/hedar%20and%20footer%20day%202/cart.php ",  // Important 
                            notify_url: "http://sample.com/notify",
                            order_id: data.order_id,
                            items: name,
                            amount: price,
                            currency: data.currency,
                            hash: data.hash, // Replace with generated hash retrieved from backend
                            first_name: "nopreview",
                            last_name: "nopreview",
                            email: "nopreview",
                            phone: "no preview",
                            address: "no preview",
                            city: "no preview",
                            country: "no preview"
                        };

                        // Show the payhere.js popup, when "PayHere Pay" is clicked
                        payhere.startPayment(payment);
                    } else {
                        alert("Error in processing checkout: " + data.message);
                    }
                } catch (e) {
                    console.error("Invalid JSON response:", xhr.responseText);
                    alert("Error in processing checkout: Invalid response from server.");
                }
            } else {
                alert("Error in processing checkout: " + xhr.statusText);
            }
        }
    };
    xhr.send(form);
}

function saveInvoicecart(orderId, price) {
    var form = new FormData();
    form.append("o", orderId);
    form.append("p", price);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response === "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert("Error saving invoice: " + response);
            }
        }
    };

    request.open("POST", "saveInvoiceProcesscart.php", true);
    request.send(form);
}


      function submit() {
        swal({
          title: "buyer dashboard",
          text: "You clicked the button!",
          icon: "success",
          button: "ok!",
        });
      
        // Set a timeout for 5000ms (5 seconds) before redirecting
        setTimeout(() => {
          window.location = "indexlk.php";
        }, 1200); 
      }
      
      function submits() {
        swal({
          title: "seller dashboard",
          text: "You clicked the button!",
          icon: "success",
          button: "ok!",
        });
      
        // Set a timeout for 5000ms (5 seconds) before redirecting
        setTimeout(() => {
          window.location = "dashboard.php";
        }, 1200); 
      }


      function saveInvoice(orderId, id, mail, amount, qty) {

        var form = new FormData();
        form.append("o", orderId);
        form.append("i", id);
        form.append("m", mail);
        form.append("a", amount);
        form.append("q", qty);
    
        var request = new XMLHttpRequest();
    
        request.onreadystatechange = function () {
            if (request.status == 200 & request.readyState == 4) {
                var response = request.responseText;
    
                if (response == "success") {
                    window.location = "invoice.php?id=" + orderId;
                } else {
                    alert(response);
                }
            }
        }
    
        request.open("POST", "saveInvoiceProcess.php", true);
        request.send(form);
    
    }
    function advancedSearch(x) {
        var txt = document.getElementById("t");
        var category = document.getElementById("c1");
        var brand = document.getElementById("b1");
        var model = document.getElementById("m");
      
        var from = document.getElementById("pf");
        var to = document.getElementById("pt");
        var sort = document.getElementById("s");
    
        var form = new FormData();
        form.append("t", txt.value);
        form.append("cat", category.value);
        form.append("b", brand.value);
        form.append("m", model.value);
    
        form.append("pf", from.value);
        form.append("pt", to.value);
        form.append("s", sort.value);
        form.append("page", x);
    
        var request = new XMLHttpRequest();
    
        request.onreadystatechange = function () {
            if (request.status == 200 && request.readyState == 4) {
                var response = request.responseText;
                document.getElementById("view_area").innerHTML = response;
            }
        }
    
        request.open("POST", "advancedSearchProcess.php", true);
        request.send(form);
    }

    function userupdateProfile() {
        var image = document.getElementById("profileimage");
        var fname = document.getElementById("fname");
        var lname = document.getElementById("lname");
        var ad1 = document.getElementById("ad1");
        var ad2 = document.getElementById("ad2");
    
        var form = new FormData();
    
        form.append("i", image.files[0]);
        form.append("fname",fname.value);
        form.append("lname",lname.value);
        form.append("ad1",ad1.value);
        form.append("ad2",ad2.value);
    
        var request = new XMLHttpRequest();
    
        request.onreadystatechange = function () {
            if (request.status == 200 & request.readyState == 4) {
                var response = request.responseText;
    
                if (response == "Updated" || response == "Saved") {
                    // Success - show SweetAlert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Profile updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location="loging.php"; // Redirect to the login page
                    });
                } else if (response == "You have not selected any image.") {
                    // Error - show SweetAlert
                    Swal.fire({
                        title: 'Error!',
                        text: 'You have not selected any image.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Generic error - show SweetAlert
                    Swal.fire({
                        title: 'Error!',
                        text: response,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
    
            }
        }
    
        request.open("POST", "userprofileprocess.php", true);
        request.send(form);
    }

function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue;
    } else {
        alert("Maximum quantity has achieved.");
        input.value = qty;
    }

}

function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue;
    } else {
        alert("Minimum quantity has achieved.");
        input.value = 1;
    }
}

function admingupdateProfile() {


    var image = document.getElementById("profileimage");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var ad1 = document.getElementById("ad1");
   var ad2 = document.getElementById("ad2");

    var form = new FormData();

    form.append("i", image.files[0]);
   form.append("fname",fname.value);
   form.append("lname",lname.value);
   form.append("ad1",ad1.value);
   form.append("ad2",ad2.value);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "Updated" || response == "Saved") {
                window.location="adminsingin.php";
            } else if (response == "You have not selected any image.") {
                alert("You have not selected any image.");
                window.location="indexlk.php";
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "admingprofileprocess.php", true);
    request.send(form);

}



function printreport(){
    var orginal = document.body.innerHTML;
    var printArea = document.getElementById("printaria");

    document.body.innerHTML = printArea.innerHTML;
    window.print();
    document.body.innerHTML = orginal;
}

function signout() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location.reload();
            }
        }
    }

    request.open("GET", "signOutsellerProcess.php", true);
    request.send();

}
function signoutuser() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location.reload();
            }
        }
    }

    request.open("GET", "signOutuserProcess.php", true);
    request.send();

}
function signoutadming(){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                window.location.reload();
            }
        }
    }

    request.open("GET", "signOutadmingProcess.php", true);
    request.send();

}


function sendid(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "Success") {
                window.location = "updateproductview.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "productdataIdProcess.php?id=" + id, true);
    request.send();

}


function changeStatus(id) {
    var product_id = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "deactivated" || response == "activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "changeStatusProcess.php?id=" + product_id, true);
    request.send();

}
function changeStatusad(id){
    var product_id = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "deactivated" || response == "activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "changeStatusProcessad.php?id=" + product_id, true);
    request.send();

}

function changeStatususer(id){
    var product_id = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "deactivated" || response == "activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "changeStatusProcessuser.php?id=" + product_id, true);
    request.send();

}

function changeStatususer(id){
    var product_id = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "deactivated" || response == "activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "changeStatusProcessuser.php?id=" + product_id, true);
    request.send();

}
function changeStatusseller(id){
    var product_id = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "deactivated" || response == "activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "changeStatusProcesseller.php?id=" + product_id, true);
    request.send();

}




function addToCart(id) {
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if (request.status === 200 && request.readyState === 4) {
        var response = request.responseText;
        // Check if the response is a success message or an error
        if (response === "success") {
          // Show a success SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'Item added to cart!',
            showConfirmButton: false,
            timer: 1500 // Auto-close after 1.5 seconds
          });
        } else {
          // Show an error SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'okey',
            text: response || 'Something went wrong!',
          });
        }
      }
    };
  
    request.open("GET", "addToCartProcess.php?id=" + id, true);
    request.send();
  }



function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
        }
    }

}

function updateProduct() {

    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var description = document.getElementById("d");
    var images = document.getElementById("imageuploader");
  
    var form = new FormData();
    form.append("t", title.value);
    form.append("q", qty.value);
    form.append("d", description.value);
  
    var file_count = images.files.length;
  
    for (var x = 0; x < file_count; x++) {
      form.append("i" + x, images.files[x]);
    }
  
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if (request.status == 200 && request.readyState == 4) {
        var response = request.responseText;
        if (response == "Product has been Updated.") {
          // Use SweetAlert for success message with a delay
          setTimeout(() => {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Product updated successfully!',
            }).then(() => {
              window.location = "myProducts.php";
            });
          }, 1200); // 1200 milliseconds (1.2 seconds) delay
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: response,
          });
        }
      }
    };
  
    request.open("POST", "updateProductProcess.php", true);
    request.send(form);
  }


function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var condition = 0;

  
 

    var cost = document.getElementById("cost");
  
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("ca", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
form.append("qty",qty.value);
 
    form.append("co", cost.value);

    form.append("de", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                swal({
                    title: "Product Saved Successfully.",
                    text: "You clicked the button!",
                    icon: "success",
                    button: "ok!",
                });

                // Set a timeout to redirect after 1.2 seconds
                setTimeout(() => {
                    window.location = "dashboard.php";
                }, 1200); // 1200 milliseconds = 1.2 seconds
            } else {
                // Use SweetAlert for error messages
                swal({
                    title: "Error!",
                    text: response,
                    icon: "error",
                    button: "OK",
                });
            }
        }
    } 

    request.open("POST", "addProductProcess.php", true);
    request.send(form);
}

function aplyadmins(){
    var fname = document.getElementById("firstname");
    var lname = document.getElementById("lastname");
    var mobilenumber = document.getElementById("mobilenumber");
    var email= document.getElementById("email");
    var pw= document.getElementById("pw");
    var reson = document.getElementById("reson");
    var provinse = document.getElementById("province");
 
 
    
    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("mn", mobilenumber.value);
    form.append("email", email.value);
    form.append("pw", pw.value);
    form.append("reson", reson.value);
    form.append("province", provinse.value);
 
 
    var request = new XMLHttpRequest();
 
    request.onreadystatechange = function () {
     if (request.status == 200 & request.readyState == 4) {
         var response = request.responseText;
 
         if (response == "We will review your request within 24 hours and contact you. Please be patient until then.."){
             Swal.fire({
                 icon: 'success',
                 title: 'Success',
                 text: 'Your application has been submitted successfully.',
               }).then((result) => {
                 if (result.isConfirmed) {
                   window.location.reload();
                 }
               });
         } else {
             document.getElementById("msg1").innerHTML = response;
             document.getElementById("msgdiv1").className = "d-block";
         }
         Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Your application has been submitted successfully.',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
 
     }
 }
 
    
    request.open("POST", "aplyadminsProcess.php", true);
    request.send(form);
 }

 function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");
  

    var form = new FormData();
    form.append("t", txt.value);
  
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("basicSearchResult").innerHTML = response;
        }
    }

    request.open("POST", "basicSearchProcess.php", true);
    request.send(form);

}


function adminsingin(){
    var email = document.getElementById("email");
    var password = document.getElementById("password");


    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
  

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "admindashboard.php";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("POST", "adminsignInProcess.php", true);
    request.send(form);

}
function deleteFromCart(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Removed") {
                alert("Product removed from Cart.");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    request.send();

}

function changeQTY(id) {
    var qty = document.getElementById("qty_num-"+ id).value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Updated") {
                window.location.reload();
            } else {
                alert(response);
                window.location.reload();
            }
        }
    }

    request.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
    request.send();

}
