$(document).ready(function () {

    //format credit card form input fields
    $('#number').payment('formatCardNumber');
    $('#cvc').payment('formatCardCVC');
    $('#expiry').payment('formatCardExpiry');

    //set stripe api key
    Stripe.setPublishableKey('pk_test_iVwvovZG1yanPsPOmO8cRYO0');

    //handle stripe token post response
    var responseHandler = function(status, response) {
        var $form = $('#payment-form');
        if (response.error) {
            $('.messages').text(response.error.message);
            $form.find('button').prop('disabled', false);
        } else {
            var token = response.id;
            chargeToken(token);
        }
    };

    //process charge form submission
    $('#payment-form').submit(function(e) {
        e.preventDefault();
        var expiry = $('#expiry').payment('cardExpiryVal');
        var $form = $(this);

        $form.find('button').prop('disabled', true);
        $('.messages').text('Processing payment....');

        Stripe.card.createToken({
            number: $('#number').val(),
            exp_month: expiry.month,
            exp_year: expiry.year,
            cvc: $('#cvc').val()
        }, responseHandler);

        return false;
    });

    //call stripe charge end-point
    var chargeToken = function (token) {
        $.post('/charge', {'token': token}, function (data) {
            $('.messages').text(data).css('color', 'green');
            $('#pay').prop('disabled', false);
        });
    }
});

