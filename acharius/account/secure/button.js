// Render the PayPal button

paypal.Button.render({

    // Set your environment

    env: 'production', // sandbox | production

    // Specify the style of the button

    style: {
        layout: 'vertical',  // horizontal | vertical
        size:   'medium',    // medium | large | responsive
        shape:  'rect',      // pill | rect
        color:  'gold'       // gold | blue | silver | black
    },

    // Specify allowed and disallowed funding sources
    //
    // Options:
    // - paypal.FUNDING.CARD
    // - paypal.FUNDING.CREDIT
    // - paypal.FUNDING.ELV

    funding: {
        allowed: [ paypal.FUNDING.CARD, paypal.FUNDING.CREDIT ],
        disallowed: [ ]
    },

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create

    client: {
        sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
        production: 'ATSToQ5-6G9dNE0fL_HGlmAge2TotF3DQO4EH82q-RNXqfP5lndaqwplUTV7UvBHWYmzv6HfgX2_d34A'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: { total: '<?php echo $_POST['price'];?>', currency: 'EUR' }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            window.alert('Payment Complete!');
            window.location.href = "../purchase/addslot.php?user=" + <?php echo $_SESSION['id'];?> +
            "&parcel=" + <?php echo $_POST['id'];?> + "&slot=" + <?php echo $_POST['slot'];?> +
            "&price=" + <?php echo $_POST['price'];?>;
        });
    }

}, '#paypal-button-container');
