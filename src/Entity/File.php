<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="files")
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=48)
     * @Assert\NotBlank()
     */
    private $fileName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $fileSize;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    private $fileExtension;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusStation", inversedBy="file")
     * @ORM\JoinColumn(nullable=false)
     */
    private $busStation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getFileExtension(): ?string
    {
        return $this->fileExtension;
    }

    public function setFileExtension(string $fileExtension): self
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    public function getBusStation(): ?BusStation
    {
        return $this->busStation;
    }

    public function setBusStation(?BusStation $busStation): self
    {
        $this->busStation = $busStation;

        return $this;
    }
}
