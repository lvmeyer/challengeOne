<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "post"={
 *             "method"="POST",
 *             "path"="/payment",
 *             "denormalization_context"={"groups"={"write"}}
 *         }
 *     },
 *     itemOperations={}
 * )
 */
class PaymentIntent
{
    /**
     * @Groups({"write"})
     */
    private $amount;

    /**
     * @Groups({"write"})
     */
    private $currency;

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }
}
