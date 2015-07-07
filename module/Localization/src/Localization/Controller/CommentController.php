<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-02
 */

namespace Localization\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Localization\Model\Comment;
use Localization\Form\CommentForm;

class CommentController extends AbstractActionController
{

    protected $commentTable;

    public function addAction()
    {
        $form = new CommentForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $comment = new Comment();
            $form->setInputFilter($comment->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $comment->exchangeArray($form->getData());
                try {
                    $this->getCommentTable()->saveComment($comment);
                    $this->flashMessenger()->addSuccessMessage('Comment added.');
                } catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('Comment not added. Try again later.');
                }

                //redirect to localization view action
                return $this->redirect()->toRoute('localization', array(
                            'action' => 'view',
                            'id' => $comment->localization_id,
                ));
            }
        }
        return array('form' => $form);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        try {
            $row = $this->getCommentTable()->getComment($id);
            $this->getCommentTable()->deleteComment($id);
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage('The database connection is not available. Try again later.');
        }
        $this->flashMessenger()->addSuccessMessage('Comment deleted.');

        // Redirect back to localization view
        return $this->redirect()->toRoute('localization', array('action' => 'view', 'id' => $row->localization_id));
    }

    public function getCommentTable()
    {
        if (!$this->commentTable) {
            $sm = $this->getServiceLocator();
            $this->commentTable = $sm->get('Localization\Model\CommentTable');
        }
        return $this->commentTable;
    }

}
