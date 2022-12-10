<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'category-php' => 'PHP',
            'category-symfony' => 'Symfony',
            'category-mysql' => 'MySQL',
            'category-javascript' => 'JavaScript',
            'category-html' => 'HTML',
            'category-css' => 'CSS',
            'category-reactjs' => 'ReactJS',
        ];

        foreach ($categories as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference($key, $category);
        }

        $manager->flush();
    }
}
