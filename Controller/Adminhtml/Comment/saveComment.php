<?php

namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\Comment;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceComment;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class saveComment extends Action
{
    /**
     * @var Comment
     */
    private $commentModel;
    /**
     * @var ResourceComment
     */
    private $resourceModel;

    /**
     * saveComment constructor.
     * @param Context $context
     * @param Comment $commentModel
     * @param ResourceComment $resourceModel
     */
    public function __construct(
        Context $context,
        Comment $commentModel,
        ResourceComment $resourceModel
    )
    {
        parent::__construct($context);
        $this->commentModel = $commentModel;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $params = $this->getRequest()->getParam('comments');
        $name = trim($params['name']);
        $email = trim($params['email']);
        $comment = trim($params['comment']);
        try {
            if (!\Zend_Validate::is($name, 'NotEmpty')) {
                $this->messageManager->addErrorMessage('Name must not be empty');
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            } else if (!\Zend_Validate::is($comment, 'NotEmpty')) {
                $this->messageManager->addErrorMessage('Comment must not be empty');
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            } else if (!\Zend_Validate::is($email, 'EmailAddress')) {
                $this->messageManager->addErrorMessage('Email address not valid');
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            } else {
                $this->commentModel
                    ->setData('name', $name)
                    ->setData('email', $email)
                    ->setData('comment', $comment);
                try {
                    $this->resourceModel->save($this->commentModel);
                } catch (\Exception $e) {
                }
                $this->messageManager->addSuccessMessage('Comment request has been sent.');
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }
        } catch (\Zend_Validate_Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to add comment: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath($this->_redirect->getRefererUrl(), array('_current' => true));
        }
    }
}