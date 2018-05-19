<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 16/05/2018
 * Time: 19:37
 */

namespace AM\ExpressBundle\Controller;



use AM\ExpressBundle\Entity\Command;
use AM\ExpressBundle\Entity\Product;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PayController extends Controller
{

    public function indexAction(Request $request)
    {
        $config = [
            'id'=>'your_id',
            'secret'=>'your secrete key paypal',
        ];

        $session = $request->getSession();
        $panier = $session->get('panier');
        $em = $this->getDoctrine()->getManager();
        $articles =  $em->getRepository(Product::class)->getByArray(array_keys($panier));

        $redirectUrls = (new RedirectUrls())
            ->setReturnUrl('http://localhost/shopping/web/app_dev.php/paiement')
            ->setCancelUrl('http://localhost/tienda3/web/app_dev.php/cart');

        $transaction = $this->get('am_express.Transactioncart');

        $apiContext = new ApiContext(
            new OAuthTokenCredential($config['id'],$config['secret'])
        );

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setRedirectUrls($redirectUrls);
        $payment->setPayer((new Payer())->setPaymentMethod('paypal'));
        $payment->setTransactions([$transaction::fromCart($articles)]);

        try{
            $payment->create($apiContext);

            return $this->redirect($payment->getApprovalLink());

        }catch (PayPalConnectionException $e){
            echo '<pre>';
            var_dump(json_decode($e->getData()));
            echo '</pre>';
        }




        $amount = $request->get('amount');

        return $this->render('AMExpressBundle:Payment:index.html.twig',['amount'=>$amount]);

    }

    public function paiementAction(Request $request)
    {

        $config = [
            'id'=>'ASLk9Rt4q5BO4oavmGVWVb8QuHWeV61kJVKHqQvo69Z5_alGhG4C3huU5wj1pzE5zFG0yUi-jW8t7_m2',
            'secret'=>'EOagxu224gORtm473EUwCclcmz6o-uKhGwmN5yqAMVbAqcdSjp9BmKaUx6AR2gaaS438c01z9Fe_1UkY',

        ];
        $apiContext = new ApiContext(
            new OAuthTokenCredential($config['id'],$config['secret'])
        );
        $session = $request->getSession();
        $panier = $session->get('panier');
        $em = $this->getDoctrine()->getManager();
        $articles =  $em->getRepository(Product::class)->getByArray(array_keys($panier));



        $payement = Payment::get($request->get('paymentId'),$apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($request->get('PayerID'))
            ->setTransactions($payement->getTransactions());

        $command = new Command();
        $command->setUser($this->getUser());
        $command->setProducts($articles);
        $command->setDate(new \DateTime());
        $command->setValider(1);
        $command->setReference(120);

        $em->persist($command);
        $em->flush();
        $request->getSession()->remove('panier');


        try{
            $payement->execute($execution,$apiContext);


        }catch (PayPalConnectionException $e){
            echo '<pre>';
            var_dump(json_decode($e->getData()));
            echo '</pre>';
        }



        return $this->redirectToRoute('am_express_command');
    }

    public function cancelAction()
    {
        return new Response('Payment system cancel aqui');
    }




}
