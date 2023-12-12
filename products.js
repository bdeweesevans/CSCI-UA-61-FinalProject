function total() {
    var grandTotal = 0;
    var prices = [12, 20, 10]; 

    for (var i = 1; i <= 3; i++) {
        var quantity = parseInt(document.getElementById('quantity' + i).value);
        if (isNaN(quantity) || quantity < 0) {
            alert('Please enter a valid quantity for all products.');
            return;
        }
        var subtotal = quantity * prices[i - 1];
        document.getElementById('subtotal' + i).innerText = subtotal.toFixed(2);
        grandTotal += subtotal;
    }

    document.getElementById('grandTotal').innerText = grandTotal.toFixed(2);
}

// Event listeners for products
document.getElementById('quantity1').addEventListener('change', total);
document.getElementById('quantity2').addEventListener('change', total);
document.getElementById('quantity3').addEventListener('change', total);

// Event listener for reset
const f = document.forms[0];
f.addEventListener("reset", (event) => {
    event.preventDefault();
    document.getElementById("quantity1").value = 0;
    document.getElementById("quantity2").value = 0;
    document.getElementById("quantity3").value = 0;
    total(); // Recalculate total
});

// Event listener for submit
f.addEventListener("submit", (event) => {
    event.preventDefault();

    total();    // Update totals

    let totalQuantity = 0;
    let isValid = true;

    // Check products quantity
    for (let i = 1; i <= 3; i++) {
        let quantity = parseInt(document.getElementById('quantity' + i).value);
        console.log(`Quantity for product ${i}:`, quantity);  // Log each product's quantity
        if (isNaN(quantity) || quantity < 0) {
            alert('Please enter a valid quantity for all products.');
            isValid = false;
            break;
        }
        totalQuantity += quantity;
    }

    if (!isValid || totalQuantity === 0) {
        alert("Please add at least one product to your order.");
        return;
    }

    const requiredFields = ['name', 'phone', 'email', 'address-street', 'address-city', 'address-state', 'address-areacode', 'cc-name', 'cc-number', 'cc-expiration', 'cc-cvv'];
    // Check required fields
    requiredFields.forEach(function(fieldId) {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            field.style.backgroundColor = 'red';
            isValid = false;
        } else {
            field.style.backgroundColor = ''; // Resets
        }
    });

    if (!isValid) return;

    var formData = new FormData(f);

    // Create data objects to pass to receipt
    var productsData = {
        quantity1: document.getElementById("quantity1").value,
        quantity2: document.getElementById("quantity2").value,
        quantity3: document.getElementById("quantity3").value,
        grandTotal: document.getElementById("grandTotal").innerText
    };

    var customerData = {
        name: document.getElementById("name").value,
        phone: document.getElementById("phone").value,
        email: document.getElementById("email").value,
        addressStreet: document.getElementById("address-street").value,
        addressCity: document.getElementById("address-city").value,
        addressState: document.getElementById("address-state").value,
        addressAreaCode: document.getElementById("address-areacode").value,
        ccNumber: document.getElementById('cc-number').value
    };

    // AJAX call
    fetch('products.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('AJAX Response:', data);
        if (data.success) {
            receipt(productsData, customerData);
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function receipt(productsData, customerData) {
    console.log('Generating receipt');
    var newWindow = window.open("", "_blank");

    var receiptContent = "<!DOCTYPE html><html><head><title>Receipt</title><link rel='stylesheet' href='styles.css' type='text/css'></head><body>";
    receiptContent += "<h1 class='header'>Receipt</h1>";

    receiptContent += "<div class='left-column'>";

    // Products
    let productsNames = ["1 Hour PS5 Time", "1 Hour PC Time", "5 Game Tokens"];
    for (let i = 0; i < productsNames.length; i++) {
        let quantity = productsData[`quantity${i+1}`];
        let subtotal = quantity * [12, 20, 10][i];
        receiptContent += "<p>" + productsNames[i] + ": Quantity - " + quantity + ", Subtotal - $" + subtotal.toFixed(2) + "</p>";
    }

    let grandTotal = productsData['grandTotal'];
    receiptContent += "<p>Grand Total: $" + grandTotal + "</p>";

    // Customer Data
    receiptContent += "<p>Name: " + customerData['name'] + "</p>";
    receiptContent += "<p>Phone: " + customerData['phone'] + "</p>";
    receiptContent += "<p>Email: " + customerData['email'] + "</p>";
    receiptContent += "<p>Address: " + customerData['addressStreet'] + ", " + customerData['addressCity'] + ", " + customerData['addressState'] + " " + customerData['addressAreaCode'] + "</p>";

    // CC
    let maskedNumber = customerData['ccNumber'].slice(0, -4).replace(/\d/g, 'x') + customerData['ccNumber'].slice(-4);
    receiptContent += "<p>Credit Card Number: " + maskedNumber + "</p>";

    receiptContent += "</div>";
    receiptContent += "<footer><p>Contributors: BD, JC, HZ</p><a href='https://github.com/bdeweesevans/webdev-final' target='_blank' rel='noopener noreferrer'>Github</a></footer></body></html>";

    // Write
    newWindow.document.write(receiptContent);
}


