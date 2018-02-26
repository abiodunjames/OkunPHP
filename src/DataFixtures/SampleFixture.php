<?php
declare(strict_types = 1);

namespace App\DataFixtures;

 use Doctrine\Bundle\FixturesBundle\Fixture;
 use Doctrine\Common\Persistence\ObjectManager;

 class SampleFixture extends Fixture
{
    public  function load(ObjectManager $manager)
    {
        // Define your fixture here
    }
 }
