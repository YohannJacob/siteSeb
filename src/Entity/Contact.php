<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank(message="Merci de renseigner un prénom")
     * @Assert\Length(min = 1, max = 70, minMessage = "Le prénom doit contenir au minimum {{ limit }} caractères", maxMessage = "Le prénom doit contenir au maximum {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Merci de renseigner un nom")
     * @Assert\Length(min = 1, max = 70, minMessage = "Le nom doit contenir au minimum {{ limit }} caractères", maxMessage = "Le nom doit contenir au maximum {{ limit }} caractères")
     */
    private $lastName;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Merci de renseigner un email")
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Merci de renseigner un message")
     * @Assert\Length(min = 5,minMessage = "Le contenu doit contenir au minimum {{ limit }} caractères")
     */
    private $message;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
