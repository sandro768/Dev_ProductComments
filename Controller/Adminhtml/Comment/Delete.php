<?php

namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\Comment;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceComment;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    private $commentModel;

    private $resourceModel;

    public function __construct(
        Context $context,
        Comment $commentModel,
        ResourceComment $resourceModel
    ) {
        parent::__construct($context);
        $this->commentModel = $commentModel;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $id = $params['id'];
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if (!($contact = $this->commentModel->load($id))) {
            $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }
        try {
            $contact->delete();
            $this->messageManager->addSuccessMessage(__('Your contact has been deleted !'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete comment: '));
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }
        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }
}
