<?php
namespace App\Controller;

use App\Entity\PaymentIntent;
use Stripe\PaymentIntent as StripePaymentIntent;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PaymentController
{   

    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    #[Route('/payment', name: 'app_payment', methods: 'POST')]
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey($_ENV['STRIPE_SK']);

        $paymentIntentData = $this->serializer->deserialize($request->getContent(), PaymentIntent::class, 'json');

        $paymentIntent = StripePaymentIntent::create([
            'amount' => $paymentIntentData->getAmount(),
            'currency' => $paymentIntentData->getCurrency(),
        ]);

        return new JsonResponse([
            'id' => $paymentIntent->id,
            'client_secret' => $paymentIntent->client_secret,
        ]);
    }
}
