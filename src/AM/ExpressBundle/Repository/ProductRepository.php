<?php

namespace AM\ExpressBundle\Repository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByArray($array )
    {
        $em = $this->getEntityManager();
        $result = $em->createQueryBuilder()
            ->select('p')
            ->from('AMExpressBundle:Product','p')
            ->where('p.id IN (:array)')
            ->setParameter(':array',$array)
            ->getQuery()->getResult();
        return $result;
    }


    public function getNewProduct($limit = 5)
    {
        $em = $this->getEntityManager();
        return $result = $em->createQueryBuilder()
            ->select('p')->from('AMExpressBundle:Product','p')
            ->orderBy('p.createdAt','DESC')->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    public function fetchWithCategory($category_id)
    {
        $em = $this->getEntityManager();
        $result = $em->createQueryBuilder()
            ->select('p')
            ->from('AMExpressBundle:Product','p')
            ->leftJoin('AMExpressBundle:Category','c',Join::WITH, 'p.category = c.id' )
            ->where('p.category=:category')
            ->setParameter('category',$category_id)
            ->getQuery()->getResult();
        return $result;
    }
    public function getByArray($array )
    {
        $em = $this->getEntityManager();
        $result = $em->createQueryBuilder()
            ->select('p')
            ->from('AMExpressBundle:Product','p')
            ->where('p.id IN (:array)')
            ->setParameter(':array',$array)
            ->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }

}
