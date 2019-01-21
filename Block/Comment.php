<?php

namespace Dev\ProductComments\Block;

use Dev\ProductComments\Model\CommentFactory;
use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Comment extends Template
{

    private $context;

    private $data;
    /**
     * @var CommentFactory
     */
    protected $commentFactory;
    /**
     * Comment constructor.
     * @param Template\Context $context
     * @param CommentFactory $commentFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CommentFactory $commentFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->context = $context;
        $this->data = $data;
        $this->commentFactory = $commentFactory;
    }

    public function getCommentCollection()
    {
        $comment = $this->commentFactory->create();
        $collection = $comment->getCollection()->addFieldToFilter("status", "approved");
        return $collection;
    }
}