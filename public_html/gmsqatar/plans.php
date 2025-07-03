<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Razorpay Payment</title>
  <!--  Razorpay SDK -->
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <!--  Bootstrap CSS and JS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      list-style: none;
      font-family: "Open Sans", sans-serif;
    }

    body {
      display: grid;
      place-items: center;
      min-height: 100vh;
      background: rgb(224, 37, 44);
      background: linear-gradient(45deg, rgba(224, 37, 44, 1) 0%, rgba(80, 34, 206, 1) 34%, rgba(30, 22, 173, 1) 66%, rgba(244, 2, 12, 1) 96%, rgba(255, 0, 0, 1) 100%, rgba(0, 18, 255, 1) 100%);
    }

    .pricing-plans {
      gap: 32px;
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      justify-content: center;
      width: 100%;
      padding: 64px;
    }

    .pricing-card {
      --col: #e4e4e7;
      position: relative;
      min-width: 360px;
      padding: 32px;
      padding-bottom: 96px;
      border-radius: 4px;
      border: 1px solid #262626;
      background-color: #26262620;
      box-shadow: 0 0 32px transparent;
      text-align: center;
    }

    .pricing-card.basic {
      --col: #0891b2;
    }

    .pricing-card.standard {
      --col: #059669;
    }

    .pricing-card.premium {
      --col: #c026d3;
    }

    .pricing-card:hover {
      border-color: var(--col);
      background-color: #26262680;
      box-shadow: 0 0 32px #171717;
      transform: translateY(-16px) scale(1.02);
      transition: all 0.5s ease;
    }

    .pricing-card>*:not(:last-child) {
      margin-bottom: 32px;
    }

    .pricing-card .heading h4 {
      padding-bottom: 12px;
      color: var(--col);
      font-size: 24px;
      font-weight: normal;
    }

    .pricing-card .heading p {
      color: #a3a3a3;
      font-size: 14px;
      font-weight: lighter;
    }

    .pricing-card .price {
      position: relative;
      color: var(--col);
      font-size: 60px;
      font-weight: bold;
    }

    .pricing-card .price sub {
      position: absolute;
      bottom: 14px;
      color: #a3a3a3;
      font-size: 14px;
      font-weight: lighter;
    }

    .pricing-card .features li {
      padding-bottom: 16px;
      color: #a3a3a3;
      font-size: 16px;
      font-weight: lighter;
      text-align: center;
    }

    .pricing-card .features li i,
    .pricing-card .features li strong {
      color: #e4e4e7;
      font-size: 16px;
      text-align: left;
    }

    .pricing-card .features li strong {
      padding-left: 24px;
    }

    .pricing-card .cta-btn {
      position: absolute;
      bottom: 32px;
      left: 50%;
      transform: translateX(-50%);
      width: 200px;
      padding: 12px;
      border-radius: 4px;
      border: 1px solid var(--col);
      background-color: var(--col);
      color: #e4e4e7;
      font-size: 20px;
      font-weight: bold;
    }

    .pricing-card .cta-btn:active {
      background-color: transparent;
      color: var(--col);
      transition: all 0.3s ease;
    }
  </style>
</head>

<body>
  <div class="mt-5">
    <a href="login.php">
    <button type="button" class="btn btn-success btn-lg">
    YOUR TRIAL VERSION IS EXPIRED. <br>
    Call: 9958300122 <br>or <br>
    Go Back to Try Again LOGIN<br>
    </button>
    </a>
    
  </div>

  <section class="pricing-plans">
    <div class="pricing-card basic">
      <div class="heading">
        <h4>3 Months</h4>
        <p>Get it in</p>
      </div>
      <p class="price">
        ₹1499
        <sub>/ Only</sub>
      </p>
      <ul class="features font-weight-bold">
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Quick Job Card</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>E-Invoicing.</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Customers Information</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Service Reminder</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Multi User Support</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>24/7 support</strong>
        </li>
      </ul>
       <button class="cta-btn"><a href="#">Buy Now</a></button> 
      <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#customerDetailsModal" data-amount="149900">-->
      <!--  Buy Now-->
      <!--</button>-->
    </div>
    <div class="pricing-card standard">
      <div class="heading">
        <h4>6 Months</h4>
        <p>Get it in</p>
      </div>
      <p class="price">
        ₹2699
        <sub>/ Only</sub>
      </p>
      <ul class="features font-weight-bold">
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Quick Job Card</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>E-Invoicing.</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Customers Information</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Service Reminder</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Multi User Support</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>24/7 support</strong>
        </li>
      </ul>
       <button class="cta-btn"><a href="#">Buy Now</a></button> 
      <!--<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#customerDetailsModal" data-amount="269900">-->
      <!--  Buy Now-->
      <!--</button>-->
    </div>
    <div class="pricing-card premium">
      <div class="heading">
        <h4>1 Year</h4>
        <p>Get it in</p>
      </div>
      <p class="price">
        ₹4999
        <sub>/ Only</sub>
      </p>
      <ul class="features font-weight-bold">
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Quick Job Card</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>E-Invoicing.</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Customers Information</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Service Reminder</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>Multi User Support</strong>
        </li>
        <li>
          <i class="fa-solid fa-check"></i>
          <strong>24/7 support</strong>
        </li>
      </ul>
       <button class="cta-btn"><a href="#">Buy Now</a></button> 
      <!--<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#customerDetailsModal" data-amount="479900">-->
      <!--  Buy Now-->
      <!--</button>-->
    </div>
  </section>


  <!-- Customer details modal -->
  <div class="modal fade" id="customerDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter Your Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form to collect customer details -->
          <form id="customerDetailsForm">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="mobile">Mobile Number:</label>
              <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="initiatePayment()">Proceed to Payment</button>
        </div>
      </div>
    </div>
  </div>


</body>

</html>