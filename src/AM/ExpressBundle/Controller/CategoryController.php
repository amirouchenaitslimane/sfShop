<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 13/05/2018
 * Time: 12:35
 */

namespace AM\ExpressBundle\Controller;


use AM\ExpressBundle\Entity\Category;
use AM\ExpressBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function listCategoryAction()
    {

        $em = $this->getDoctrine()->getManager();
        $categoriy_list = $em->getRepository('AMExpressBundle:Category')->findAll();
        return $this->render('AMExpressBundle:Components:category.html.twig',array('categories'=>$categoriy_list));


    }


    public function showAction($id)
    {
        if (null == $id){
            throw new NotFoundHttpException('El producto solicitado no existe ');
        }

        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository(Product::class)->fetchWithCategory($id);
        $cat_name = $em->getRepository(Category::class)->find($id);

        if(null == $cat){
            throw new NotFoundHttpException('La categoría solicitada no existe ');
        }


        return $this->render(
            'AMExpressBundle:Category:category_single.html.twig',
            [
                'products'=>$cat,
                'category'=>$cat_name
            ]
        );
    }
}