<template>
    <div>
        <stripe-element-payment
            ref="paymentRef"
            :pk="pk"
            :elements-options="elementsOptions"
            :confirm-params="confirmParams"
        />
        <button @click="pay">Pay Now</button>
    </div>
</template>

<script>
import { StripeElementPayment } from '@vue-stripe/vue-stripe';
export default {
    const publishableKey = import.meta.env.VITE_PUBLISHABLE_KEY
    components: {
        StripeElementPayment,
    },
    data () {
        return {
        pk: publishableKey
        elementsOptions: {
            appearance: {}, // appearance options
        },
        confirmParams: {
            return_url: 'https://localhost:5173/success', // success url
        },
        };
    },
    mounted () {
        this.generatePaymentIntent();
    },
    methods: {
        async generatePaymentIntent () {
        const paymentIntent = await apiCallToGeneratePaymentIntent(); // this is just a dummy, create your own API call
        this.elementsOptions.clientSecret = paymentIntent.client_secret;
        },
        pay () {
        this.$refs.paymentRef.submit();
        },
    },
    };
</script>