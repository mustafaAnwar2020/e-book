document.addEventListener("DOMContentLoaded", ready);

function ready() {
    let shopButtonEl = document.getElementsByClassName("shop-item-button");
    for (i = 0; i < shopButtonEl.length; i++) {
        var button = shopButtonEl[i];
        button.addEventListener("click", addToCardClicked);
    }

    let removeCartItemButtons = document.getElementsByClassName("btn-danger");
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i];
        button.addEventListener("click", removeCartItem);
    }

    let quantityInputs = document.getElementsByClassName("cart-quantity-input");
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i];
        button.addEventListener("change", quantityChange);
    }

    // document
    //     .getElementsByClassName("btn-purchase")[0]
    //     .addEventListener("click", purchaseClicked);
}

function addToCardClicked(event) {
    var button = event.target;
    var shopItem = button.parentElement.parentElement;
    var title = shopItem.getElementsByClassName("shop-item-title")[0].innerText
    var price = shopItem.getElementsByClassName("shop-item-price")[0].innerText
    var id = shopItem.getElementsByClassName("book-id")[0].value
    console.log(id)
    addItemToCart(title, price,id);
    updateCartTotal();
}

function quantityChange(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }

    updateCartTotal();
}

// function purchaseClicked() {
//     alert("Thank you for purchase");
//     var cartItems = document.getElementsByClassName("cart-items")[0];
//     while (cartItems.hasChildNodes()) {
//         cartItems.removeChild(cartItems.firstChild);
//     }

//     updateCartTotal();
// }

function addItemToCart(title, price,id) {
    var cartRow = document.createElement("div");
    cartRow.classList.add("cart-row");
    var cartItems = document.getElementsByClassName("item")[0];
    var cartItemNames = cartItems.getElementsByClassName("cart-item-title");


    for (i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert("this item is already added");
            return;
        }
    }

    cartRowHtml = `
    <span class="item-left">
        <span class="item-info">
            <span class="cart-item-title">${title}</span>
            <span class="cart-price cart-column">${price}</span>
            <input class="item-right cart-quantity-input" name="books[${id}][quantity]" type="number" value="1">
        </span>
    </span>
    <span class="item-right">
        <button class="btn btn-danger  fa fa-close"></button>
    </span>`;

    cartRow.innerHTML = cartRowHtml;
    cartItems.append(cartRow);

    cartRow
        .getElementsByClassName("btn-danger")[0]
        .addEventListener("click", removeCartItem);
    cartRow
        .getElementsByClassName("cart-quantity-input")[0]
        .addEventListener("change", quantityChange);
}

function removeCartItem(event) {
    buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();
    updateCartTotal();
}


function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName("item")[0];
    var cartRows = cartItemContainer.getElementsByClassName("cart-row");
    var total = 0;
    for (i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i];
        var priceEl = cartRow.getElementsByClassName("cart-price")[0];
        var qtyEl = cartRow.getElementsByClassName("cart-quantity-input")[0];
        var price = parseFloat(priceEl.innerText.replace("$", ""));
        var qty = qtyEl.value;

        total = total + qty * price;
    }
    document.getElementsByClassName("cart-total-price")[0].textContent =
        "$" + total;
}

