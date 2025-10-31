<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimsara Computers - Product Watchlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href="fevicone/favicon.ico">
</head>

<body>

    <header>

        <?php
      include 'navbars.php';
      ?>
    </header>

    <div class="container mt-5 watchlist-container" style="background-color: #D1D7DB;">
        <h2 class="text-center mb-4">My Watchlist</h2>

        <div id="watchlist" class="row">
            <!-- Product items will be added here -->
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button class="main-button me-3">View Cart</button>
            <button class="main-button">Checkout</button>
        </div>
    </div>
    <?php
      include 'main footer.php';
      ?>

    <script>
    // Sample Watchlist Data (Replace with your actual data)
    const watchlist = [{
            name: "Product A",
            image: "AUTOMATED FUTURE.png",
            price: "19.99"
        },
        {
            name: "Product B",
            image: "AUTOMATED FUTURE.png",
            price: "29.99"
        },
        {
            name: "Product C",
            image: "AUTOMATED FUTURE.png",
            price: "14.99"
        },
        {
            name: "Product D",
            image: "AUTOMATED FUTURE.png",
            price: "39.99"
        },
        {
            name: "Product E",
            image: "AUTOMATED FUTURE.png",
            price: "19.99"
        },
        {
            name: "Product F",
            image: "AUTOMATED FUTURE.png",
            price: "24.99"
        },
        {
            name: "Product G",
            image: "AUTOMATED FUTURE.png",
            price: "49.99"
        },
        {
            name: "Product H",
            image: "AUTOMATED FUTURE.png",
            price: "12.99"
        },
        {
            name: "Product I",
            image: "AUTOMATED FUTURE.png",
            price: "29.99"
        },
        {
            name: "Product J",
            image: "AUTOMATED FUTURE.png",
            price: "19.99"
        }
    ];

    const watchlistContainer = document.getElementById("watchlist");

    // Function to render watchlist items
    function renderWatchlist() {
        watchlistContainer.innerHTML = "";
        watchlist.forEach((product, index) => {
            const productItem = document.createElement("div");
            productItem.classList.add("col-md-4", "mb-4");
            productItem.style.animation = "fadeIn 1s ease-in-out"; // Add fade-in animation

            const card = document.createElement("div");
            card.classList.add("card", "h-100"); // Add h-100 for consistent card height

            const img = document.createElement("img");
            img.src = product.image;
            img.alt = product.name;
            img.classList.add("card-img-top");

            const cardBody = document.createElement("div");
            cardBody.classList.add("card-body");

            const productName = document.createElement("h5");
            productName.textContent = product.name;
            productName.classList.add("card-title");
            productName.style.textAlign = "center"; // Center the product name

            const productPrice = document.createElement("p");
            productPrice.textContent = "$" + product.price;
            productPrice.classList.add("card-text");
            productPrice.style.textAlign = "center"; // Center the price

            // Create a div to hold buttons and center them
            const buttonContainer = document.createElement("div");
            buttonContainer.classList.add("d-flex", "justify-content-center");

            const seeDetailsButton = document.createElement("button");
            seeDetailsButton.textContent = "See Details";
            seeDetailsButton.classList.add("btn", "btn-primary", "me-2");

            const removeButton = document.createElement("button");
            removeButton.textContent = "Remove";
            removeButton.classList.add("btn", "btn-danger");
            removeButton.style.animation = "wobble 0.5s"; // Add wobble animation on hover

            removeButton.addEventListener("click", () => {
                watchlist.splice(index, 1);
                renderWatchlist();
            });

            buttonContainer.appendChild(seeDetailsButton);
            buttonContainer.appendChild(removeButton);

            cardBody.appendChild(productName);
            cardBody.appendChild(productPrice);
            cardBody.appendChild(buttonContainer); // Add button container to the card body
            card.appendChild(img);
            card.appendChild(cardBody);
            productItem.appendChild(card);
            watchlistContainer.appendChild(productItem);
        });
    }

    renderWatchlist();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Add CSS for animations (styles.css) -->
    <style>
    /* Fade-in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Wobble animation (for Remove button) */
    @keyframes wobble {
        0% {
            transform: translateX(0);
        }

        15% {
            transform: translateX(-10px);
        }

        30% {
            transform: translateX(10px);
        }

        45% {
            transform: translateX(-5px);
        }

        60% {
            transform: translateX(5px);
        }

        75% {
            transform: translateX(-2px);
        }
        
        

        90% {
            transform: translateX(2px);
        }

        100% {
            transform: translateX(0);
        }
    }

    /* Main button styling */
    .main-button {
        background-color: #D1D7DB;
        /* Blue color */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        /* Smooth transition for hover effect */
    }

    .main-button:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }
    </style>

</body>

</html>