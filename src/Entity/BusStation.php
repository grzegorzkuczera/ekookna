<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\File;

/**
 * @ORM\Table(name="busstations")
 * @ORM\Entity(repositoryClass="App\Repository\BusStationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class BusStation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $address;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $createdBy;

    /**
     * @Assert\NotBlank()
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="busStation", cascade={"persist", "remove"})  
     */
    private $file;

    /** 
        * @Assert\Count(
        *      min = 1,
        *      max = 3,
        *      minMessage = "You must upload at least one file",
        *      maxMessage = "You cannot specify more than {{ limit }} files"
        * )
       * @Assert\All({
        * @Assert\File(
        *     mimeTypes = {"image/bmp", "image/png", "image/jpeg", "image/jpg"},
        *     mimeTypesMessage = "Please upload a valid format jpg, png, bmp"
        * )})
    */
    private $attachments;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $onRead;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->file = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }


    /**
     * @return Collection|File[]
     */
    public function getFile(): Collection
    {
        return $this->file;
    }
    
    public function addFile(File $file): self
    {
        if (!$this->file->contains($file)) {
            $this->file[] = $file;
            $file->setBusStation($this);
        }

        return $this;
    }
    
    
    public function removeFile(File $file): self
    {
        if ($this->file->contains($file)) {
            $this->file->removeElement($file);
            // set the owning side to null (unless already changed)
            if ($file->getBusStation() === $this) {
                $file->setBusStation(null);
            }
        }

        return $this;
    }
    public function getAttachments()
    {
        return $this->attachments;
    }

    public function setAttachments(array $attachments): self
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function getOnRead(): ?bool
    {
        return $this->onRead;
    }

    public function setOnRead(bool $onRead): self
    {
        $this->onRead = $onRead;

        return $this;
    }
}
