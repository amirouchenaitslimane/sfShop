<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 17/05/2018
 * Time: 10:22
 */

namespace AM\ExpressBundle\Payment;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;

class TransactionCart
{
    public static function fromCart($articles,$vtrat = 0)
    {
        $t = 0;
        $listItem = new ItemList();
        foreach ($articles as $article) {
            $item = new Item();
            $item->setName((string) $article["name"]);
            $item->setPrice($article["price"]);
            $item->setCurrency('EUR');
            $item->setQuantity(1);
            $t = $t +  $article["price"];
            $listItem->addItem($item);
        }


        $details = new Details();
        $details->setSubtotal($t);
        $amount = (new Amount())
            ->setCurrency('EUR')
            ->setTotal($t)
            ->setDetails($details);

        $transaction = (new Transaction())->setItemList($listItem)
            ->setDescription('example de lachat' )
            ->setAmount($amount)
            ->setCustom('demo-1');
        return $transaction;

    }

}