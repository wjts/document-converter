<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get","post"={
 *          "method"="POST",
 *          "path"="/conversion",
 *          "controller"=App\Controller\ConversionAction::class,
 *          "defaults"={"_api_receive"=false},
 *          "normalization_context"={"groups"={"conversion"}},
 *     }},
 *     itemOperations={"get"},
 * )

 * @Vich\Uploadable()
 * @ORM\Entity()
 */
class Conversion
{
    /**
     * @var Order
     *
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="App\Entity\Order")
     */
    private $order;

    /**
     * @var File
     *
     * @Assert\NotNull()
     * @Vich\UploadableField(mapping="converted_document", fileNameProperty="convertedFilename", originalName="convertedOriginalName")
     */
    public $convertedFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $convertedFilename;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $convertedOriginalName;

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return Conversion
     */
    public function setOrder(Order $order): Conversion
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return Uuid
     * @Groups({"conversion"})
     */
    public function getId(): UuidInterface
    {
        return $this->order->getId();
    }

    /**
     * @return string
     */
    public function getConvertedFilename(): string
    {
        return $this->convertedFilename;
    }

    /**
     * @param string $convertedFilename
     * @return Conversion
     */
    public function setConvertedFilename(string $convertedFilename): Conversion
    {
        $this->convertedFilename = $convertedFilename;
        return $this;
    }

    /**
     * @return string
     */
    public function getConvertedOriginalName(): string
    {
        return $this->convertedOriginalName;
    }

    /**
     * @param string $convertedOriginalName
     * @return Conversion
     */
    public function setConvertedOriginalName(string $convertedOriginalName): Conversion
    {
        $this->convertedOriginalName = $convertedOriginalName;
        return $this;
    }
}
