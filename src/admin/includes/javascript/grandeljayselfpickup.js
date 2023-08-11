"use strict";

function DOMContentLoaded() {
    let checkoutTexts = document.querySelectorAll('[data-name="checkout-text"]');

    checkoutTexts.forEach(checkoutText => {
        checkoutText.addEventListener('change' , checkoutTextChange);
    });
}

document.addEventListener('DOMContentLoaded', DOMContentLoaded);

function checkoutTextChange(event) {
    let textsBase64 = document.querySelector('[name="configuration[MODULE_SHIPPING_GRANDELJAYSELFPICKUP_CHECKOUT_TEXT]"]');
    let textsObject = JSON.parse(textsBase64.value);

    let textLanguage = event.target.getAttribute('data-language');

    event.target.value        = event.target.value.replace(/(?:\r\n|\r|\n)/g, '<br>');
    textsObject[textLanguage] = event.target.value
    textsBase64.value         = JSON.stringify(textsObject);
}
