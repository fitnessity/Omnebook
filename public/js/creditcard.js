$(function() {

    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");

    // Use the payform library to format and validate
    // the payment fields.

    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');


    cardNumber.keyup(function() {

        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) == false) {
            cardNumberField.addClass('has-error');
        } else {
            cardNumberField.removeClass('has-error');
            cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
            mastercard.addClass('transparent');
            amex.addClass('transparent');
            $("#card_type").val('visa');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
            mastercard.addClass('transparent');
            visa.addClass('transparent');
            $("#card_type").val('amex');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
            amex.addClass('transparent');
            visa.addClass('transparent');
            $("#card_type").val('mastercard');
        }
    });

    confirmButton.click(function(e) {

        e.preventDefault();
        $("#card-error").html('');
        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.validateCardCVC(CVV.val());
        var card_month = $("#card_month");
        var card_year = $("#card_year");
    
        if(owner.val().length < 5){
            $("#card-error").html("Owner name should be 5 characters");
            owner.focus();
        } else if (!isCardValid) {
            $("#card-error").html("Wrong card number");
            cardNumber.focus();
        } else if (!isCvvValid) {
            $("#card-error").html("Wrong CVV");
            CVV.focus();
        } else if (card_month.val()=="") {
            $("#card-error").html("Card expiry month can't leave blank");
            card_month.focus();
        } else if (card_year.val()=="") {
            $("#card-error").html("Card expiry year can't leave blank");
            card_year.focus();
        } else {
            // Everything is correct. Add your form submission code here.
            $("#card-error").html("Everything is correct");
            $("#frmpayment").submit();
        }
    });
});
