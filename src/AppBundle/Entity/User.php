<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_birth", type="date")
     */
    private $dateOfBirth;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_driver_license", type="boolean",nullable=true)
     */
    private $hasDriverLicense;

    /**
     * @var Car
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Car", cascade={"persist","remove"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    private $car;


    /**
     * @var Color
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Color", cascade={"persist","remove"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    private $color;


    /**
     * Get id
     *
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname(){
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname(){
        return $this->lastname;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth(){
        return $this->dateOfBirth;
    }

    /**
     * Set hasDriverLicense
     *
     * @param boolean $hasDriverLicense
     *
     * @return User
     */
    public function setHasDriverLicense($hasDriverLicense) {
        $this->hasDriverLicense = $hasDriverLicense;

        return $this;
    }

    /**
     * Get hasDriverLicense
     *
     * @return bool
     */
    public function getHasDriverLicense(){
        return $this->hasDriverLicense;
    }



    /**
     * Set car
     *
     * @param \AppBundle\Entity\Car $car
     *
     * @return User
     */
    public function setCar(Car $car = null) {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \AppBundle\Entity\Car
     */
    public function getCar(){
        return $this->car;
    }

    /**
     * Set color
     *
     * @param \AppBundle\Entity\Color $color
     *
     * @return User
     */
    public function setColor(Color $color = null) {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \AppBundle\Entity\Color
     */
    public function getColor(){
        return $this->color;
    }
}
