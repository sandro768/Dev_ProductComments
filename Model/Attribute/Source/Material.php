<?php

namespace Dev\ProductComments\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Material extends AbstractSource
{
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Yes'), 'value' => 'yes'],
                ['label' => __('No'), 'value' => 'no'],
            ];
        }
        return $this->_options;
    }
}