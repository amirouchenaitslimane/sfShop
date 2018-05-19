<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 10/05/2018
 * Time: 14:18
 */

namespace AM\ExpressBundle\DataFixtures\ORM;



use AM\ExpressBundle\Entity\Category;
use AM\ExpressBundle\Entity\Image;
use AM\ExpressBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProduct extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        for($i = 0;$i<10 ;$i++){
            $product = new Product();
            $product->setName('product'.$i);

            $product->setDescription('
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus at Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aspernatur cupiditate eaque eius eum excepturi explicabo ipsum laudantium molestiae nobis numquam officiis, placeat quo saepe sint soluta sunt suscipit vitae?
    
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut beatae distinctio dolores ducimus excepturi, expedita facere, hic libero maiores minima minus modi, nesciunt non quae reiciendis reprehenderit tempore ut? Consectetur?
    autem commodi delectus deleniti, dignissimos distinctio dolorum eius facere fuga fugit hic inventore mollitia obcaecati similique tempore veritatis. Animi, odit!
            '.$i);
            $product->setPrice(15.2.$i);
            $image = new Image();$image->setUrl($i.'.png');$image->setAlt('mon image numero'.$i);


            $product->setImage($image);

            $manager->persist($product);
            $manager->persist($image);

        }
        for($i = 0;$i<10 ;$i++){
            $product1 = new Product();
            $product1->setName('product'.$i);

            $product1->setDescription('
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus at Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aspernatur cupiditate eaque eius eum excepturi explicabo ipsum laudantium molestiae nobis numquam officiis, placeat quo saepe sint soluta sunt suscipit vitae?
    
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut beatae distinctio dolores ducimus excepturi, expedita facere, hic libero maiores minima minus modi, nesciunt non quae reiciendis reprehenderit tempore ut? Consectetur?
    autem commodi delectus deleniti, dignissimos distinctio dolorum eius facere fuga fugit hic inventore mollitia obcaecati similique tempore veritatis. Animi, odit!
            '.$i);
            $product1->setPrice(15.2.$i);
            $image = new Image();$image->setUrl($i.'.png');$image->setAlt('mon image numero'.$i);


            $product1->setImage($image);

            $manager->persist($product1);
            $manager->persist($image);

        }
        $manager->flush();



    }
}