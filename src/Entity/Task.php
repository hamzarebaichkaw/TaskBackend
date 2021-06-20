<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $priority_level;

  

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_completion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=MediaObject::class, mappedBy="task")
     */
    private $Media;

    public function __construct()
    {
        $this->Media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriorityLevel(): ?string
    {
        return $this->priority_level;
    }

    public function setPriorityLevel(?string $priority_level): self
    {
        $this->priority_level = $priority_level;

        return $this;
    }

    public function getDateCompletion(): ?\DateTimeInterface
    {
        return $this->date_completion;
    }

    public function setDateCompletion(?\DateTimeInterface $date_completion): self
    {
        $this->date_completion = $date_completion;

        return $this;
    }

    public function getValidation(): ?string
    {
        return $this->validation;
    }

    public function setValidation(?string $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|MediaObject[]
     */
    public function getMedia(): Collection
    {
        return $this->Media;
    }

    public function addMedium(MediaObject $medium): self
    {
        if (!$this->Media->contains($medium)) {
            $this->Media[] = $medium;
            $medium->setTask($this);
        }

        return $this;
    }

    public function removeMedium(MediaObject $medium): self
    {
        if ($this->Media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getTask() === $this) {
                $medium->setTask(null);
            }
        }

        return $this;
    }
}
