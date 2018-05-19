<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 12/05/2018
 * Time: 19:04
 */

namespace AM\ExpressBundle\Controller;


use AM\ExpressBundle\Entity\Product;
use Proxies\__CG__\AM\ExpressBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CatalogController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * Productos destacados
         */
        $products = $em->getRepository(Product::class)->getNewProduct(4);

        // $categ = $em->getRepository(Category::class)->find(3);
        //$product = $em->getRepository(Product::class)->findBy(['category'=>$categ->getId()]);
        return $this->render('AMExpressBundle:Catalog:index.html.twig',
            [
                'newproduct'=>$products,

            ]


        );
    }

    public function listAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT e 
                FROM AMExpressBundle:Product e ORDER BY e.createdAt  ASC ";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render(
            'AMExpressBundle:Catalog:all_product.html.twig',
            array('pagination'=>$pagination)


        );
    }

    public function showAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        if (null == $id){
            throw new NotFoundHttpException('El producto solicitado no existe ');
        }
        $product = $em->getRepository(Product::class)->find($id);
        if (null == $product){
            throw new NotFoundHttpException('El producto solicitado no existe ');
        }

        $article_cat = $em->getRepository(Category::class)->find($product->getCategory()->getId());
        return $this->render('AMExpressBundle:Catalog:product_single.html.twig',
            [
                'product'=>$product,
                'product_category'=>$article_cat
            ]
        );

    }
}