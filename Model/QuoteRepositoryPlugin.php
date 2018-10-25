<?php

namespace JBdev\ExternalOrderId\Model;


use Magento\Quote\Api\Data\AddressExtensionInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\QuoteRepository;


class QuoteRepositoryPlugin
{
    public function beforeSave(QuoteRepository $subject, CartInterface $quote)
    {
        if($cartExtension = $quote->getExtensionAttributes()){
            $shippingAssignments = $cartExtension->getShippingAssignments();
            /** @var ShippingAssignmentInterface $shippingAssignment */
            foreach ($shippingAssignments as $shippingAssignment) {
                /** @var AddressInterface $shippingAddress */
                $shippingAddress = $shippingAssignment->getShipping()->getAddress();
                /** @var AddressExtensionInterface $extension */
                $extension = $shippingAddress->getExtensionAttributes();
                if ($extension && $externalOrderiD = $extension->getExternalOrderId()) {
                    $quote->setData('external_order_id', $externalOrderiD);

                }
            }
        }
        return [$quote];
    }

}