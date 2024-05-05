<?php
/**
 * Copyright © Boostmyshop All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace BmsIndia\Report\Model\Product\Attribute\Source;

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

