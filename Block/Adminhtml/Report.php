<?php
/**
 * Copyright © Shekhar Suman, 2024. All rights reserved.
 * See COPYING.txt for license details.
 * 
 * @package     AberrantCode_SalesReport
 * @version     1.0.0
 * @license     MIT License (http://opensource.org/licenses/MIT)
 * @autor       Shekhar Suman
 */
namespace AberrantCode\SalesReport\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Eav\Api\AttributeRepositoryInterface;


class Report extends Template
{

    public $collection;

    public function __construct(
        Context $context, 
        CollectionFactory $collectionFactory,
        AttributeRepositoryInterface $attributeRepository,
        array $data = [])
    {
        $this->collection = $collectionFactory;
        $this->attributeRepository = $attributeRepository;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        return $this->collection->create();
    }
    
    public function getAttributeValue()
    {
        $attributeCode = 'product_category'; // Replace with your attribute code

        
        // Get attribute by attribute code
        $attribute = $this->attributeRepository->get('catalog_product', $attributeCode);
        // Get source model for the attribute
        $source = $attribute->getSource();
        
        // Get options
        return  $options = $source->getAllOptions();
        
    }
    
    public function getNextMonth($i)
    {
         return $nextMonth = date('F Y', strtotime("+$i month"));
        //$currentMonthYear = date('F Y');
    }
    
    public function getProductCount($i, $productCategory)
    {
        $month = date('F', strtotime("-$i month"));   
        $year = date('Y', strtotime("-$i month"));  
        
        $itemsByCategory = [];
        $itemQty = 0;
        // Get the first day of the month
        $startDate = date('Y-m-d', strtotime("$year-$month-01"));

        // Get the last day of the month
        $endDate = date('Y-m-t', strtotime("$year-$month-01"));
        $orderCollection = $this->getCollection()
        ->addFieldToFilter('created_at', ['from' => $startDate, 'to' => $endDate]);

        // Iterate through each order
        foreach ($orderCollection as $order) {
            foreach ($order->getAllVisibleItems() as $item) {
                $category = $item->getProduct()->getProductCategory();
                // Check if the item belongs to the desired category
                if ($productCategory == $category) {
                    $itemQty += $item->getQtyOrdered();
                    $itemsByCategory[] = $item;
                }
                
            }
        }
        return $itemQty;

    }

    public function getTotal($productCategory)
    {
        $nextMonth = date('F', strtotime("-11 month"));   
        $lastMonth = date('F');   
        $nextYear = date('Y', strtotime("-11 month")); 
        $lastYear = date('Y');  

        
        $itemsByCategory = [];
        $itemQty = 0;
        // Get the first day of the next month
        $startDate = date('Y-m-d', strtotime("$nextYear-$nextMonth-01"));

        // Get the last day of the month
        $endDate = date('Y-m-t', strtotime("$lastYear-$lastMonth-01"));
        $orderCollection = $this->getCollection()
        ->addFieldToFilter('created_at', ['from' => $startDate, 'to' => $endDate]);

        // Iterate through each order
        foreach ($orderCollection as $order) {
            foreach ($order->getAllVisibleItems() as $item) {
                $category = $item->getProduct()->getProductCategory();
                // Check if the item belongs to the desired category
                if ($productCategory == $category) {
                    $itemQty += $item->getQtyOrdered();
                    $itemsByCategory[] = $item;
                }
                
            }
        }
        return $itemQty;

    }

}
