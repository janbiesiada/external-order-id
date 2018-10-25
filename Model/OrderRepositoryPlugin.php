<?php

namespace JBdev\ExternalOrderId\Model;


use Magento\Quote\Model\Quote;
use Magento\Quote\Model\QuoteFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\OrderRepository;


class OrderRepositoryPlugin
{
    /**
     * @var QuoteFactory
     */
    private $quoteFactory;

    /**
     * OrderRepositoryPlugin constructor.
     * @param QuoteFactory $quoteFactory
     */
    public function __construct(
        QuoteFactory $quoteFactory
    )
    {
        $this->quoteFactory = $quoteFactory;
    }

    public function beforeSave(OrderRepository $subject, OrderInterface $order)
    {
        /** @var Quote $quote */
        $quote = $this->quoteFactory->create()->load($order->getQuoteId());
        $quote->getData('external_order_id');
        $order->setData('external_order_id', $quote->getData('external_order_id'));
        return [$order];
    }

}