<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @Vich\Uploadable
 */
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['product:read']], 
    denormalizationContext: ['groups' => ['product:write']], 
    types: ['https://schema.org/Product'],
    operations: [
        new GetCollection(),
        new Post(inputFormats: ['multipart' => ['multipart/form-data']])
    ]
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups(['product:read'])]
    public ?string $contentUrl = null;

     /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    #[Groups(['product:write'])]
    public ?File $file = null;

    #[ORM\Column(nullable: true)] 
    public ?string $filePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
