<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 10/05/2018
 * Time: 14:18
 */

namespace AM\ExpressBundle\DataFixtures\ORM;


use AM\ExpressBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategory extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $catego1 = (new Category())
            ->setName('Móviles')
            ->setParent(null);
        $cat2 = (new Category())->setName('Samsung')->setParent($catego1);
        $cat3 = (new Category())->setName('Nokia')->setParent($catego1);
        $cat4 = (new Category())->setName('LG')->setParent($catego1);


        $catego2 = (new Category())->setName('Portátiles')->setParent(null);
        $por1 = (new Category())->setName('Msi')->setParent($catego2);
        $por2 = (new Category())->setName('Asus')->setParent($catego2);
        $por3 = (new Category())->setName('HP')->setParent($catego2);
        $por4 = (new Category())->setName('Lenovo')->setParent($catego2);

        $manager->persist($catego1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        $manager->persist($cat4);
        $manager->persist($catego2);
        $manager->persist($por1);
        $manager->persist($por2);
        $manager->persist($por3);
        $manager->persist($por4);

        $manager->flush();

    }
}