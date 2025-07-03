<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>1 YEAR SUBSCRIPTION</title>
  <style>

    body, html {
      height: 100%;
      margin: 0;
      font-family: lato;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      background: linear-gradient(#c9e5e9, #ccddf9);
    }

    .window {
      width: 800px;
      background: #fff;
      box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
      border-radius: 30px;
      display: flex;
    }

    .order-info {
      width: 50%;
      padding: 25px;
      box-sizing: border-box;
      text-align: center;
    }

    .credit-info {
      width: 50%;
      background: #4488dd;
      color: #eee;
      padding: 25px;
      box-sizing: border-box;
      border-top-right-radius: 30px;
      border-bottom-right-radius: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

h2 {
  margin-bottom:0px;
  margin-top:25px;
  text-align:center;
  /* font-weight:100; */
  /* font-size:50px; */
  font-size:1.6rem;
  
}

h3 {
  margin-bottom:0px;
  margin-top:25px;
  text-align:center;
  /* font-weight:100; */
  /* font-size:50px; */
  font-size:1.4rem;
  
}

ul {
  margin:0;
  padding:0;
}
ul li {
  list-style:none;
  padding-left:10px;
  cursor:pointer;
  text-align: center;
  font-size:18px;
  /* font-size:.9rem; */
}

.window {
  height:540px;
  width:800px;
  background:#fff;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
  border-radius:30px;
  z-index:10;
}


.input-field {
  background:rgba(255,255,255,0.1);
  margin-bottom:10px;
  margin-top:3px;
  line-height:1.5em;
  font-size:20px;
  font-size:1.3rem;
  border:none;
  padding:5px 10px 5px 10px;
  color:#fff;
  box-sizing:border-box;
  width:100%;
  margin-left:auto;
  margin-right:auto;
}
.credit-info {
  background:#4488dd;
  height:100%;
  width:50%;
  color:#eee;
  -webkit-box-pack:center;
  -webkit-justify-content:center;
  -ms-flex-pack:center;
  justify-content:center;
  font-size:14px;
  font-size:.9rem;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  box-sizing:border-box;
  padding-left:25px;
  padding-right:25px;
  border-top-right-radius:30px;
  border-bottom-right-radius:30px;
  position:relative;
}

@media (max-width: 600px) {
  .window {
    width: 100%;
    height: 100%;
    display:block;
    border-radius:0px;
  }
  .order-info {
    width:100%;
    height:auto;
    padding-bottom:100px;
    border-radius:0px;
  }
  .credit-info {
    width:100%;
    height:auto;
    padding-bottom:100px;
    border-radius:0px;
  }
  .pay-btn {
    border-radius:0px;
  }
}
.form-field {
    text-align: center;
  }

  .form-field input {
    width: 70%;
    padding: 15px;
    font-size: 20px;
    box-sizing: border-box;
    margin-bottom: 20px; /* Add margin at the bottom of the input for spacing */
  }

  button {
    width: 70%;
    padding: 15px;
    font-size: 20px;
    cursor: pointer;
    border: none;
    background: #22b877;
    line-height: 2em;
    border-radius: 10px;
    color: #fff;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
  }


  </style>


</head>
<body>
  <div class='container'>
    <div class='window'>
      <div class='order-info'>
      <div class="info">
        <img src="img/logo-11.png" alt="" style="width: 60px;"><br>
            <h2>1 YEAR SUBSCRIPTION</h2>
            <p>Thanks!! Your payment is successful!</p>
            <form action="adminFunction.php" method="post">
                <div class="form-field">
                    <h2 class="blinking-text">Please enter your mobile number and Verify:<span class="mandatory">*</span></h2><br><br>
                    <input type="number" id="mobileNumber" name="g_mob" placeholder="Mobile Number*" required>
                </div><br>
                <button type="submit" name="btn-verify12">Verify</button>
            </form>
        </div>
      </div>
      <div class='credit-info'>
      <h2><a href="https://chat.whatsapp.com/ESh5Jfv94XP0Afn1DJD6GS">🤚 JOIN OUR WHATSAPP COMMUNITY</a></h2>
      <h3>Congratulations! You are now part of Digital Garage. <br><br> You have downloaded "MeriGarage.com Software" - Simple. Easy. Desktop and Mobile App.</h3><br>
            <ul>
                <li>Keep Your Vehicle Records</li>
                <li>Make Your Job Card</li>
                <li>Send Service Reminder</li>
                <li>Make Your Digital-Invoice</li>
            </ul><br>
      </div>
    </div>
  </div>


<script>
var cardDrop = document.getElementById('card-dropdown');
var activeDropdown;
cardDrop.addEventListener('click',function(){
  var node;
  for (var i = 0; i < this.childNodes.length-1; i++)
    node = this.childNodes[i];
    if (node.className === 'dropdown-select') {
      node.classList.add('visible');
       activeDropdown = node; 
    };
})

window.onclick = function(e) {
  console.log(e.target.tagName)
  console.log('dropdown');
  console.log(activeDropdown)
  if (e.target.tagName === 'LI' && activeDropdown){
    if (e.target.innerHTML === 'Master Card') {
      document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/2vbqk5lcpi7hjoc/MasterCard_Logo.svg.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Master Card';
    }
    else if (e.target.innerHTML === 'American Express') {
         document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/f5hyn6u05ktql8d/amex-icon-6902.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'American Express';      
    }
    else if (e.target.innerHTML === 'Visa') {
         document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Visa';
    }
  }
  else if (e.target.className !== 'dropdown-btn' && activeDropdown) {
    activeDropdown.classList.remove('visible');
    activeDropdown = null;
  }
}

</script>
</body>
</html>
