<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 13/05/2018
 * Time: 12:03
 */

namespace AM\ExpressBundle\Controller;



use AM\ExpressBundle\Entity\Product;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CartController extends Controller
{
    public function indexAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $this->addFlash('danger', 'Debes Identificarse para poder comprar ');
        }


        $session = $request->getSession();
        $panier = $session->get('panier');
        $em = $this->getDoctrine()->getManager();
        if ($panier !== null){

            $articles =  $em->getRepository(Product::class)->findByArray(array_keys($panier));
        }else{
            $articles = null;
        }


        return $this->render(
            'AMExpressBundle:Cart:cart.html.twig',
            array('products'=>$articles)

        );

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * A verifier apres
     */
    public function addAction(Request $request,$id)
    {
        $panier = [];
        /**
         * crear una session
         */

        $session = $request->getSession();
        /**
         * comprobar si existe una session con el nombre panier
         */
        if (!$session->has('panier')){
            /**
             * crear session llamada panier
             */
            $panier = $session->set('panier',$panier);
        }else{
            /**
             * develvemos la session con el nombre panier
             */
            $panier = $session->get('panier');
        }

        /**
         * creamo la variable cantidad con el cast porque es una cadena en el origen
         */
        $qty = (int) $request->get('qty');
        /**
         * si la cantidad igual a null eso es decir que se agrega sin cantidad
         */
        if ($qty == null){
            $qty = 1;
        }
        /**
         * si existe una key con el id del producto eso significa que
         * hay un producto en la session
         */

        if (is_array($panier) && array_key_exists($id,$panier)){
            if ($qty == null){
                $panier[$id] = 1;
            }else{
                $panier[$id] = $panier[$id] + $qty ;
            }
        }else{

            $panier[$id] = $qty;
        }

        $session->set('panier',$panier);


        return $this->redirect($this->generateUrl('am_express_cart'));
        // return $this->render('AMPracticaBundle:Default:teste.html.twig');

    }

    public function updateAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        if ($request->isXmlHttpRequest()){
            $id = (int)$request->get('obj');
            $qty = (int)$request->get('qty');
            if($qty < 1){
                $this->addFlash('danger', 'problem ');
            }
            if (array_key_exists($id,$panier)){
                $panier[$id] = $qty;
                $session->set('panier',$panier);
                $this->addFlash('success', 'cantidad cambiada ');
            }

        }
        return $this->redirectToRoute('am_express_cart');

    }

    public function deleteAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        if ($request->isXmlHttpRequest()) {
            $id = (int)$request->get('id');
            if (array_key_exists($id, $panier)) {
                unset($panier[$id]);
                $session->set('panier', $panier);
                $this->addFlash('danger', 'Producto eliminado del carrito ');
            }
            return new Response();
        }
    }
}