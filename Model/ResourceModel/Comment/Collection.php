<?php
namespace Dev\ProductComments\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'comment_id';
    protected $_eventPrefix = 'product_comments_collection';
    protected $_eventObject = 'comment_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dev\ProductComments\Model\Comment', 'Dev\ProductComments\Model\ResourceModel\Comment');
    }

}