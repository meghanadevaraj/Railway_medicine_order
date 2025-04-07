<!DOCTYPE html>
<html>
<head>
    <title>Train Tracking & Shopping</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <script>
        let cart = [];

        function fetchTrainStatus() {
            let pnr = document.getElementById("pnr_number").value;
            if (!pnr) {
                alert("Enter a valid PNR number!");
                return;
            }

            fetch("train_journey_status.php?pnr=" + pnr)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("present_station").innerHTML = data.present_station ? data.present_station.station_name : "Unknown";

                    let pastHtml = "<ul>";
                    data.past_stations.forEach(station => {
                        pastHtml += `<li>${station.station_name}</li>`;
                    });
                    pastHtml += "</ul>";
                    document.getElementById("past_stations").innerHTML = pastHtml;

                    let upcomingHtml = "";
                    data.upcoming_stations.forEach(station => {
                        upcomingHtml += `<div class="station" onclick="toggleShops(${station.station_id})">${station.station_name}</div>`;
                        upcomingHtml += `<div id="shops-${station.station_id}" class="shop-section" style="display: none;"></div>`;
                    });
                    document.getElementById("upcoming_stations").innerHTML = upcomingHtml;

                    updateShops(data.shop_details);
                })
                .catch(error => console.error("Error fetching train status:", error));
        }

        function updateShops(shopDetails) {
            Object.keys(shopDetails).forEach(station_id => {
                let shopHtml = "<h3>Shops Available:</h3>";

                shopDetails[station_id].forEach(shop => {
                    shopHtml += `<div class="shop"><strong>${shop.shop_name}</strong><ul>`;

                    shop.products.forEach(product => {
                        shopHtml += `
                            <li>${product.name} - ₹${product.price} 
                            <img src="${product.image_url}" alt="${product.name}" style="width: 100px; height: auto; margin: 5px 0;"><br>
                                <button onclick="addToCart(${product.id}, ${product.price}, '${product.name}', '${shop.shop_name}', '${station_id}')">
                                    Add to Cart
                                </button>
                            </li>
                        `;
                    });

                    shopHtml += "</ul></div>";
                });

                document.getElementById("shops-" + station_id).innerHTML = shopHtml;
            });
        }

        function toggleShops(stationId) {
            document.querySelectorAll('.shop-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById('shops-' + stationId).style.display = 'block';
        }

        function addToCart(product_id, price, name, shopName, stationId) {
            let quantity = prompt(`Enter quantity for ${name}:`);
            if (!quantity || quantity <= 0) return;

            let existingProduct = cart.find(item => item.id === product_id);
            if (existingProduct) {
                existingProduct.quantity += parseInt(quantity);
            } else {
                cart.push({ id: product_id, name, price, quantity: parseInt(quantity), shopName, stationId });
            }

            updateCart();
        }

        function updateCart() {
            let cartHtml = "<h3>Your Cart:</h3><ul>";
            let totalPrice = 0;

            cart.forEach(item => {
                cartHtml += `<li>${item.name} (Shop: ${item.shopName}, Station: ${item.stationId}) - ₹${item.price} x ${item.quantity} = ₹${item.price * item.quantity}</li>`;
                totalPrice += item.price * item.quantity;
            });

            cartHtml += `</ul><strong>Total: ₹${totalPrice}</strong>`;
            cartHtml += `<br><button onclick="checkout()">Proceed to Checkout</button>`;
            document.getElementById("cart").innerHTML = cartHtml;
        }

        function checkout() {
            if (cart.length === 0) {
                alert("Your cart is empty!");
                return;
            }

            let checkoutHtml = "<h2>Checkout Summary</h2><ul>";
            let total = 0;

            let groupedCart = {};
            cart.forEach(item => {
                if (!groupedCart[item.shopName]) {
                    groupedCart[item.shopName] = [];
                }
                groupedCart[item.shopName].push(item);
                total += item.price * item.quantity;
            });

            Object.keys(groupedCart).forEach(shop => {
                checkoutHtml += `<h3>${shop} (Station: ${groupedCart[shop][0].stationId})</h3><ul>`;
                groupedCart[shop].forEach(item => {
                    checkoutHtml += `<li>${item.name} - ₹${item.price} x ${item.quantity} = ₹${item.price * item.quantity}</li>`;
                });
                checkoutHtml += `</ul>`;
            });

            checkoutHtml += `<h3>Total Amount: ₹${total}</h3>`;
            checkoutHtml += `
                <label>Select Payment Method:</label><br>
                <input type="radio" name="payment" value="UPI" checked> UPI<br>
                <input type="radio" name="payment" value="Cash on Delivery"> Cash on Delivery<br>
                <button onclick="generateInvoice()">Confirm Order</button>
            `;

            document.getElementById("checkout").innerHTML = checkoutHtml;
            document.getElementById("checkout").style.display = "block";
        }

        function generateInvoice() {
            let paymentMethod = document.querySelector('input[name="payment"]:checked').value;
            let invoiceHtml = `<h2>Invoice</h2><p>Payment Method: ${paymentMethod}</p><ul>`;
            let total = 0;

            let groupedCart = {};
            cart.forEach(item => {
                if (!groupedCart[item.shopName]) {
                    groupedCart[item.shopName] = [];
                }
                groupedCart[item.shopName].push(item);
                total += item.price * item.quantity;
            });

            Object.keys(groupedCart).forEach(shop => {
                invoiceHtml += `<h3>${shop} (Station: ${groupedCart[shop][0].stationId})</h3><ul>`;
                groupedCart[shop].forEach(item => {
                    invoiceHtml += `<li>${item.name} - ₹${item.price} x ${item.quantity} = ₹${item.price * item.quantity}</li>`;
                });
                invoiceHtml += `</ul>`;
            });

            invoiceHtml += `<h3>Total Amount: ₹${total}</h3>`;
            invoiceHtml += `<button onclick="generatePDF()">Finish & Download Invoice</button>`;


            document.getElementById("invoice").innerHTML = invoiceHtml;
            document.getElementById("invoice").style.display = "block";
        }

        function clearCart() {
            cart = [];
            updateCart();
            document.getElementById("checkout").style.display = "none";
            document.getElementById("invoice").style.display = "none";
            alert("Thank you for your purchase!");
        }
    </script>
    <script>
        async function getArrivalTime(stationId) {
            try {
                let response = await fetch(`getArrivalTime.php?stationId=${stationId}`);
                let data = await response.json();
                return data.arrival_time || "N/A";
            } catch (error) {
                console.error("Error fetching arrival time:", error);
                return "N/A";
            }
        }

        async function generatePDF() {
            const { jsPDF } = window.jspdf;
            let doc = new jsPDF();

            // Add Title
            doc.setFontSize(20);
            doc.text("Invoice", 105, 15, { align: "center" });

            // Invoice Details (Bordered Section)
            let pnr = document.getElementById("pnr_number")?.value || "N/A";
            let date = new Date().toLocaleDateString();

            doc.setFontSize(12);
            doc.rect(10, 20, 190, 15);
            doc.text(`PNR: ${pnr}`, 15, 28);
            doc.text(`Date: ${date}`, 150, 28);

            let tableData = [];
            let totalAmount = 0;

            let groupedCart = {};
            cart.forEach(item => {
                if (!groupedCart[item.shopName]) {
                    groupedCart[item.shopName] = [];
                }
                groupedCart[item.shopName].push(item);
                totalAmount += item.price * item.quantity;
            });

            for (let shop in groupedCart) {
                let stationId = groupedCart[shop][0].stationId;
                let arrivalTime = await getArrivalTime(stationId); // Fetch from DB

                tableData.push([{ content: `Shop: ${shop} (Station: ${stationId})`, colSpan: 5, styles: { halign: "center", fontStyle: "bold", fillColor: [220, 220, 220] } }]);

                groupedCart[shop].forEach(item => {
                    tableData.push([item.name, `₹${item.price}`, item.quantity, `₹${item.price * item.quantity}`, arrivalTime]);
                });
            }

            doc.autoTable({
                startY: 40,
                head: [["Product Name", "Price", "Quantity", "Total", "Delivery Time"]],
                body: tableData,
                theme: "grid",
                styles: { fontSize: 10 },
                headStyles: { fillColor: [100, 100, 255] },
                margin: { top: 30 },
            });

            let finalY = doc.lastAutoTable.finalY + 10;
            doc.setFontSize(12);
            doc.text(`Total Amount: ₹${totalAmount}`, 15, finalY);

            let paymentMethod = document.querySelector('input[name="payment"]:checked')?.value || "Not Selected";
            doc.text(`Payment Method: ${paymentMethod}`, 15, finalY + 10);

            doc.save(`Invoice_${pnr}.pdf`);
            clearCart();
        }
    </script>
     <style>
        body {
            background: url('uploads/img9.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            text-align: center;
        }

        .container {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input, button {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .station {
            background-color: #28a745;
            color: white;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .shop-section {
            display: none;
            background: #e9ecef;
            padding: 10px;
            border-radius: 5px;
        }

        .cart-container, .checkout-container, .invoice-container {
            background: #ffc107;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Track Your Train & Shop at Stations</h1>
        <input type="text" id="pnr_number" placeholder="Enter PNR Number">
        <button onclick="fetchTrainStatus()">Check Train Status</button>

        <h2>Present Station: <span id="present_station">N/A</span></h2>
        <h3>Past Stations</h3>
        <div id="past_stations"></div>
        <h3>Upcoming Stations</h3>
        <div id="upcoming_stations"></div>
    </div>
<br>
    <div class="container">
        <h2>🛒 Your Cart</h2>
        <div id="cart" class="cart-container">Cart is empty</div>
    </div>
<br>
    <div class="container">
        <div id="checkout" class="checkout-container" style="display:none;"></div>
        <div id="invoice" class="invoice-container" style="display:none;"></div>
    </div>
</body>
</html>
