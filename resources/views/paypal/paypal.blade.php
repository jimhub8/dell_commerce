<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox:'AdqfQ_xn0HyksbTB2lY_BZSTfgIxnsVZ2O6ZhItIt_S3el1B23iWyOagUFS4Ikrd4Maj-GYDGJvKYRju',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
          redirect_urls: {
            return_url: 'http://chemist.dev/execute-payment'
          },
        transactions: [{
          amount: {
            total: '20.00',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
        return actions.redirect();
      // return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
       // window.alert('Thank you for your purchase!');
      //});
    }
  }, '#paypal-button');

</script>