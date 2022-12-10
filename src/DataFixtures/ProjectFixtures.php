<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $today = new \DateTimeImmutable();

        $website = new Project();
        $website->setName('ACME Website');
        $website->setCustomer($this->getReference('customer-acme'));
        $website->setHours(100);
        $website->setCostPerHour(50);
        $website->setDateStart($today->modify('-6 month'));
        $website->setDateEnd($today->modify('-2 month'));
        $manager->persist($website);

        $websiteMaintenance = new Project();
        $websiteMaintenance->setName('ACME Website Maintenance');
        $websiteMaintenance->setCustomer($this->getReference('customer-acme'));
        $websiteMaintenance->setHours(20);
        $websiteMaintenance->setCostPerHour(40);
        $websiteMaintenance->setDateStart($today->modify('-2 month'));
        $manager->persist($websiteMaintenance);

        $webapp = new Project();
        $webapp->setName('SensioLabs Web App');
        $webapp->setCustomer($this->getReference('customer-sensiolabs'));
        $webapp->setHours(150);
        $webapp->setCostPerHour(60);
        $webapp->setDateStart($today->modify('-3 month'));
        $manager->persist($webapp);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            CustomerFixtures::class,
        ];
    }
}
