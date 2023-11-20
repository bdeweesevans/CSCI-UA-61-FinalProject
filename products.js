function total() {
  var grandTotal = 0;
  var prices = [200, 14, 125]; 

  // Update subtotal + add subs to total
  for (var i = 1; i <= 3; i++) {
    var quantity = parseInt(document.getElementById('quantity' + i).value);
    var subtotal = quantity * prices[i - 1];
    document.getElementById('subtotal' + i).innerText = subtotal.toFixed(2);
    grandTotal += subtotal;
  }

  // Add delivery to total
  var deliveryCost = parseFloat(document.querySelector('input[name="deliverySelection"]:checked').value);
  grandTotal += deliveryCost;

  // Update total total
  document.getElementById('grandTotal').innerText = grandTotal.toFixed(2);
}

// Event listeners for product changes
document.getElementById('quantity1').addEventListener('change', total);
document.getElementById('quantity2').addEventListener('change', total);
document.getElementById('quantity3').addEventListener('change', total);

// Event listeners for delivery changes
document.getElementById('willCall').addEventListener('change', total);
document.getElementById('shipping').addEventListener('change', total);

// Event listener for reset event
const f = document.forms[0];
f.addEventListener("reset", (event) => {
    event.preventDefault();
    document.getElementById("quantity1").value = 0;
    document.getElementById("quantity2").value = 0;
    document.getElementById("quantity3").value = 0;
    document.getElementById("willCall").checked = true; // Reset delivery method
    total(); // Recalculate total
});

// Event listener for submit event
f.addEventListener("submit", (event) => {
  event.preventDefault();

  let totalQuantity = 0;
  let isValid = true;

  // Check each product quantity
  for (let i = 1; i <= 3; i++) {
    let quantity = parseInt(document.getElementById('quantity' + i).value);
    totalQuantity += quantity;
  }

  // Check if at least one product is in cart
  if (totalQuantity === 0) {
    alert("Please add at least one product to your order.");
    isValid = false;
  }

  /*It is impossible for the form to be submitted
    with an empty element due to the inline verification,
    so it will never even turn red. But I left the code here.*/
  const requiredFields = ['name', 'phone', 'email', 'address-street', 'address-city', 'address-state', 'address-areacode', 'cc-name', 'cc-number', 'cc-expiration', 'cc-cvv'];
  // Check each required field
  requiredFields.forEach(function(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field.value.trim()) {
      field.style.backgroundColor = 'red';
      isValid = false;
    } else {
      field.style.backgroundColor = ''; // Resets
    }
  });

  // Generates receipt
  if (isValid) {
    receipt();
  }
});

function receipt() {
  var newWindow = window.open("", "_blank");

  var receiptContent = "<!DOCTYPE html><html><head><title>Receipt</title><link rel='stylesheet' href='styles.css' type='text/css'></head><body>";
  receiptContent += "<h1 class='header'>Receipt</h1>";

  receiptContent += "<div class='left-column'>";

  // Products
  let productsNames = ["Plane with Big Nose", "Pool Cleaning Service", "Breaking Bad's Los Pollos Hermanos"];
  let j = 0;
  for (let i = 1; i <= 3; i++) {
    let quantity = document.getElementById("quantity" + i).value;
    let subtotal = document.getElementById("subtotal" + i).innerText;
    receiptContent += "<p>" + productsNames[j] + ": Quantity - " + quantity + ", Subtotal - $" + subtotal + "</p>";
    j ++;
  }

  // Chosen Delivery Method
  if (document.getElementById("shipping").checked) {
    receiptContent += "<p>Delivery Method: Shipping for $5.00.</p>";
  } else {
    receiptContent += "<p>Delivery Method: In-store Pickup for Free.</p>";
  }

  let grandTotal = document.getElementById("grandTotal").innerText;
  receiptContent += "<p>Grand Total: $" + grandTotal + "</p>";

  let name = document.getElementById("name").value;
  let phone = document.getElementById("phone").value;
  let email = document.getElementById("email").value;
  let addressStreet = document.getElementById("address-street").value;
  let addressCity = document.getElementById("address-city").value;
  let addressState = document.getElementById("address-state").value;
  let addressAreaCode = document.getElementById("address-areacode").value;

  receiptContent += "<p>Name: " + name + "</p>";
  receiptContent += "<p>Phone: " + phone + "</p>";
  receiptContent += "<p>Email: " + email + "</p>";
  receiptContent += "<p>Address: " + addressStreet + ", " + addressCity + ", " + addressState + " " + addressAreaCode + "</p>";

  // CC # code
  let ccNumber = document.getElementById('cc-number').value;
  let maskedNumber = ccNumber.slice(0, -4).replace(/\d/g, 'x') + ccNumber.slice(-4);
  receiptContent += "<p>Credit Card Number: " + maskedNumber + "</p>";

  receiptContent += "</div>";

  receiptContent += "<footer>© 2023 Benjamin DeWeese van Schooneveld</footer></body></html>";

  // Write to new document
  newWindow.document.write(receiptContent);
}

