<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $companies = [
            'customer-acme' => ['Acme', 'acme'],
            'customer-sensiolabs' => ['SensioLabs', 'sensiolabs'],
        ];

        foreach ($companies as $key => $company) {
            $customer = new Customer();
            $customer->setName($company[0]);
            $customer->setCode($company[1]);
            $manager->persist($customer);
            $this->addReference($key, $customer);
        }

        $manager->flush();
    }
}
