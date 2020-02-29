<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
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

    /**
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
}
