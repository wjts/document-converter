<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"={
 *          "method"="POST",
 *          "path"="/conversion",
 *          "controller"=App\Controller\ConvertDocument::class,
 *          "defaults"={"_api_receive"=false},
 *          "normalization_context"={"groups"={"post"}},
 *     }},
 *     itemOperations={"get"},
 * )
 * @Vich\Uploadable()
 * @ORM\Entity()
 */
class Conversion
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"post"})
     */
    private $id;

    /**
     * @var File
     *
     * @Assert\NotNull()
     * @Vich\UploadableField(mapping="document_object", fileNameProperty="filename", mimeType="mimeType", originalName="originalName")
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
    private $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $originalName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, options={"fixed": true})
     */
    private $hash;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Groups({"post", "get"})
     */
    private $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Conversion
     */
    public function setId(int $id): Conversion
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
     * @return Conversion
     */
    public function setFilename(string $filename): Conversion
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @return Conversion
     */
    public function setMimeType(string $mimeType): Conversion
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Conversion
     */
    public function setHash(string $hash): Conversion
    {
        $this->hash = $hash;
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
     * @return Conversion
     */
    public function setStatus(int $status): Conversion
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
     * @return Conversion
     */
    public function setOriginalName(string $originalName): Conversion
    {
        $this->originalName = $originalName;
        return $this;
    }
}
