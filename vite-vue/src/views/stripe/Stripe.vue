<template>
    <StripeElements
      v-if="stripeLoaded"
      v-slot="{ elements }"
      ref="elms"
      :stripe-key="stripeKey"
      :instance-options="instanceOptions"
      :elements-options="elementsOptions"
    >
      <StripeElement ref="card" :elements="elements" :options="cardOptions" />
    </StripeElements>
    <button @click="handleSubmit">Pay</button>
</template>

<script lang="ts">
import { defineComponent, ref, onBeforeMount } from 'vue'
import { loadStripe } from '@stripe/stripe-js'
import { StripeElements, StripeElement } from 'vue-stripe-js'

const paymentData = {
        // payment data
        "amount": 1000,
        "currency": "eur"
    };

export default defineComponent({
  name: 'CardOnly',

  components: {
    StripeElements,
    StripeElement,
  },

  setup() {
    const stripeKey = ref(import.meta.env.VITE_PUBLISHABLE_KEY) // test key
    const instanceOptions = ref({
      // https://stripe.com/docs/js/initializing#init_stripe_js-options
    })
    const elementsOptions = ref({
      // https://stripe.com/docs/js/elements_object/create#stripe_elements-options
    })
    const cardOptions = ref({
      // https://stripe.com/docs/stripe.js#element-options
      value: {
        postalCode: '12345',
      },
    })
    const stripeLoaded = ref(false)
    const card = ref()
    const elms = ref()

    onBeforeMount(() => {
      const stripePromise = loadStripe(stripeKey.value)
      stripePromise.then(() => {
        stripeLoaded.value = true
      })
    });

    return {
      stripeKey,
      stripeLoaded,
      instanceOptions,
      elementsOptions,
      cardOptions,
      card,
      elms,
    }
  },
  methods: {
      async handleSubmit () {

        try {
          const response = await fetch('https://localhost/payment', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              amount: 1000,
              currency: 'usd'
            })
          });

          const data = await response.json();
          console.log(data.client_secret);

          const stripe = await loadStripe(import.meta.env.VITE_PUBLISHABLE_KEY);

        const { paymentIntent, error } = await stripe.confirmCardPayment(data.client_secret, {
          payment_method: {
            card: this.$refs.card.element,
            billing_details: {
              name: 'Test name'
            }
          }
        });

        if (error) {
          console.error(error);
        } else {
          console.log(paymentIntent);
        }

        } catch (error) {
          console.error(error);
      }


    }
  }

})
</script>
