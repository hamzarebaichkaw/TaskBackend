<?php
// api/src/Entity/MediaObject.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateMediaObjectAction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
 

/**
 * @ORM\Entity
 * @ApiResource(
 *    
 *     normalizationContext={
 *         "groups"={"media_object_read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateMediaObjectAction::class,
 *             "deserialize"=false,
 *            
 *             "validation_groups"={"Default", "media_object_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @Vich\Uploadable
 */
class MediaObject 
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"media_object_read"})
     * 
     */
    public $contentUrl;
    

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"media_object_create"})
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    public $file;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $filePath;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="media")
     */
    private $Id_media;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="Media")
     */
    private $task;

 

 

  
 
 

    public function __construct()
    {
        $this->enseignants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function SetFile(File $file): void
    {
       $this->file  = $file;
      
    }


  public function getFile(): ?File
    {
        return $this->file;
    }
    public function getIdMedia(): ?User
    {
        return $this->Id_media;
    }
  
    public function setIdMedia(?User $Id_media): self
    {
        $this->Id_media = $Id_media;
  
        return $this;
    }
  public function getfilePath(): ?string
  {
      return $this->filePath;
  }

  public function setIfilePath(?string $Id_media): self
  {
      $this->filePath = $filePath;

      return $this;
  }

  
 
  public function getType(): ?string
  {
      return $this->Type;
  }

  public function setType(?string $Type): self
  {
      $this->Type = $Type;

      return $this;
  }

  public function getTask(): ?Task
  {
      return $this->task;
  }

  public function setTask(?Task $task): self
  {
      $this->task = $task;

      return $this;
  }

   
}