<?php

namespace Dev\ProductComments\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Comment extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'product_comments';

    protected $cacheTag = 'product_comments';

    protected $_eventPrefix = 'product_comments';

    protected function _construct()
    {
        $this->_init('Dev\ProductComments\Model\ResourceModel\Comment');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}