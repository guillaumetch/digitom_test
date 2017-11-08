<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Car;
use AppBundle\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $color = new Color();
        $color->setName('rouge');
        $manager->persist($color);

        $this->addReference('rouge', $color);

        $color = new Color();
        $color->setName('bleue');
        $manager->persist($color);

        $this->addReference('bleue', $color);

        $color = new Color();
        $color->setName('jaune');
        $manager->persist($color);

        $this->addReference('jaune', $color);

        $color = new Color();
        $color->setName('verte');
        $manager->persist($color);

        $this->addReference('verte', $color);

        $color = new Color();
        $color->setName('noire');
        $manager->persist($color);

        $this->addReference('noire', $color);

        $color = new Color();
        $color->setName('blanche');
        $manager->persist($color);

        $this->addReference('blanche', $color);

        $car = new Car();
        $car->setName('renault');
        $car->addColor($this->getReference('jaune'));
        $car->addColor($this->getReference('rouge'));
        $car->addColor($this->getReference('noire'));
        $car->addColor($this->getReference('blanche'));
        $manager->persist($car);

        $car = new Car();
        $car->setName('peugeot');
        $car->addColor($this->getReference('bleue'));
        $car->addColor($this->getReference('verte'));
        $car->addColor($this->getReference('noire'));
        $car->addColor($this->getReference('blanche'));
        $manager->persist($car);

        $car = new Car();
        $car->setName('citroen');
        $car->addColor($this->getReference('rouge'));
        $car->addColor($this->getReference('verte'));
        $car->addColor($this->getReference('bleue'));
        $car->addColor($this->getReference('jaune'));
        $manager->persist($car);


        $manager->flush();
    }
}