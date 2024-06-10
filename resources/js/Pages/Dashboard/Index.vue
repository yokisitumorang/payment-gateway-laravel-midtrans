<template>
    <head>
    <title>Payment Page</title>
    </head>
    <div>
        <button @click="pay" id="pay-button">Pay!</button>
    </div>
    <!-- <div id="snap-container"></div> -->
    <h1>Homepages</h1>
</template>

<script >

import Axios from 'axios'

export default {
  data() {
    return {
      message: "Hello, Vue.js!",
      snapLoaded: false,

    };
  },

  mounted(){
   

    // Load Snap script
    const script = document.createElement('script');
    // sandbox
    // script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';

    // production
    script.src = 'https://app.midtrans.com/snap/snap.js';
    script.setAttribute('data-client-key', '{client key}'); // Replace with your actual Client Key

    script.onload = () => {
      this.snapLoaded = true;
    };

    document.head.appendChild(script);

  },

  methods: {
    handleClick() {
      this.message = "Button clicked!";
    },

    pay() {
      // Your code here
    //   console.log('test');

    const headers = {
        'Content-Type': 'application/json'
      };

      Axios.post('/payment',{ headers })
        .then(response => {
            const transactionToken = response.data.snap_token;
            // Open Snap payment popup
            window.snap.pay(transactionToken, {
          onSuccess: (result) => {
            console.log('Success:', result);
            // Handle success response here
          },
          onPending: (result) => {
            console.log('Pending:', result);
            // Handle pending response here
          },
          onError: (result) => {
            console.log('Error:', result);
            // Handle error response here
          },
          onClose: () => {
            console.log('Customer closed the popup without finishing the payment');
            // Handle popup close action here
          }
        });
       
        })
        .catch(error => console.error(error));
    
    },
  }
};
</script>


