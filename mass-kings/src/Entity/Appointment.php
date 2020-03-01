<?php

namespace App\Entity;

use App\Validator\Package;
use App\Validator\Car;
use App\Validator\Phone;
use App\Validator\Time;
use App\Validator\Name;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 * @ORM\Table(name="appointment",indexes={@ORM\Index(name="time_valid_idx", columns={"time"})})
 */
class Appointment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $package;

    /**use App\Validator\Time;
     * @ORM\Column(type="integer")
     */
    private $car_size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact_phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact_email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPackage(): ?int
    {
        return $this->package;
    }

    public function setPackage(?int $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function getCarSize(): ?int
    {
        return $this->car_size;
    }

    public function setCarSize(int $car_size): self
    {
        $this->car_size = $car_size;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getTime(): ?\DateTimeImmutable
    {
        return $this->time;
    }

    public function setTime(\DateTimeImmutable $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contact_name;
    }

    public function setContactName(string $contact_name): self
    {
        $this->contact_name = $contact_name;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contact_phone;
    }

    public function setContactPhone(string $contact_phone): self
    {
        $this->contact_phone = $contact_phone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contact_email;
    }

    public function setContactEmail(string $contact_email): self
    {
        $this->contact_email = $contact_email;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata) : void
    {
        //package
        $metadata->addPropertyConstraint('package', new NotBlank());
        $metadata->addPropertyConstraint('package', new Package());

        //contact_phone
        $metadata->addPropertyConstraint('contact_phone', new NotBlank());
        $metadata->addPropertyConstraint('contact_phone', new Phone());

        //time
        $metadata->addPropertyConstraint('time', new NotBlank());
        $metadata->addPropertyConstraint('time', new Time());

        //car_size
        $metadata->addPropertyConstraint('car_size', new NotBlank());
        $metadata->addPropertyConstraint('car_size', new Car());

        //location
        $metadata->addPropertyConstraint('location', new NotBlank());

        //contact_name
        $metadata->addPropertyConstraint('contact_name', new NotBlank());
        $metadata->addPropertyConstraint('contact_name', new Name());

        //contact_email
        $metadata->addPropertyConstraint('contact_email', new Email());

    }
}
