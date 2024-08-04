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
declare(strict_types=1);

namespace AberrantCode\SalesReport\Model\Product\Attribute\Source;

class ProductCategory extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
        ['value' => '0', 'label' => __('A')],
        ['value' => '1', 'label' => __('B')],
        ['value' => '3', 'label' => __('C')],
        ['value' => '4', 'label' => __('D')]
        ];
        return $this->_options;
    }
}

