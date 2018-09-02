<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"={
 *          "method"="POST",
 *          "path"="/order",
 *          "controller"=App\Controller\OrderAction::class,
 *          "defaults"={"_api_receive"=false},
 *          "normalization_context"={"groups"={"post"}},
 *     }},
 *     itemOperations={"get"},
 * )
 * @Vich\Uploadable()
 * @ORM\Entity()
 */
class Order
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @Groups({"post"})
     */
    private $id;

    /**
     * @var File
     *
     * @Assert\NotNull()
     * @Vich\UploadableField(mapping="source_document", fileNameProperty="filename", originalName="originalName")
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $originalName;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Groups({"post", "get"})
     */
    private $status;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return Order
     */
    public function setId(UuidInterface $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return Order
     */
    public function setFilename(string $filename): Order
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Order
     */
    public function setStatus(int $status): Order
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     * @return Order
     */
    public function setOriginalName(string $originalName): Order
    {
        $this->originalName = $originalName;
        return $this;
    }
}
