function total() {
    var grandTotal = 0;
    var prices = [12, 20, 10]; 

    // Update subtotal + add subs to total
    for (var i = 1; i <= 3; i++) {
        var quantity = parseInt(document.getElementById('quantity' + i).value);
        var subtotal = quantity * prices[i - 1];
        document.getElementById('subtotal' + i).innerText = subtotal.toFixed(2);
        grandTotal += subtotal;
    }

    // Update total total
    document.getElementById('grandTotal').innerText = grandTotal.toFixed(2);
}

// Event listeners for product changes
document.getElementById('quantity1').addEventListener('change', total);
document.getElementById('quantity2').addEventListener('change', total);
document.getElementById('quantity3').addEventListener('change', total);

// Event listener for reset event
const f = document.forms[0];
f.addEventListener("reset", (event) => {
    event.preventDefault();
    document.getElementById("quantity1").value = 0;
    document.getElementById("quantity2").value = 0;
    document.getElementById("quantity3").value = 0;
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

    const requiredFields = ['name', 'phone', 'email', 'address-street', 'address-city', 'address-state', 'address-areacode', 'cc-name', 'cc-number', 'cc-expiration', 'cc-cvv'];
    // Check each required field
    requiredFields.forEach(function(fieldId) {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            field.style.backgroundColor = 'red';
            isValid = false;
        } 
        else {
            field.style.backgroundColor = ''; // Resets
        }
    });

    // Generates receipt
    if (isValid) {
        // Submit form data using AJAX
        var formData = new FormData(f);
        fetch('products.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                // If the server responds with success, generate the receipt
                receipt();
            } 
            else {
                // Handle failure (e.g., show an error message)
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    });

function receipt() {
    console.log('Generating receipt');
    var newWindow = window.open("", "_blank");

    var receiptContent = "<!DOCTYPE html><html><head><title>Receipt</title><link rel='stylesheet' href='styles.css' type='text/css'></head><body>";
    receiptContent += "<h1 class='header'>Receipt</h1>";

    receiptContent += "<div class='left-column'>";

    // Products
    let productsNames = ["1 Hour PS5 Time", "1 Hour PC Time", "5 Game Tokens"];
    let j = 0;
    for (let i = 1; i <= 3; i++) {
        let quantity = document.getElementById("quantity" + i).value;
        let subtotal = document.getElementById("subtotal" + i).innerText;
        receiptContent += "<p>" + productsNames[j] + ": Quantity - " + quantity + ", Subtotal - $" + subtotal + "</p>";
        j ++;
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

    receiptContent += "<footer><p>Contributors: BD, JC, HZ</p><a href='https://github.com/bdeweesevans/webdev-final' target='_blank' rel='noopener noreferrer'>Github</a></footer></body></html>";

    // Write to new document
    newWindow.document.write(receiptContent);
}

