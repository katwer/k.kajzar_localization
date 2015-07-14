<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-15
 */
// TODO KK change
namespace Map\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Localization\Model\Localization;
use Localization\Form\LocalizationForm;
use Localization\Form\CommentForm;
use Localization\Form\SearchForm;
use Localization\Form\SearchFilter;
use Zend\Mail;

class MapController extends AbstractActionController
{

    protected $localizationTable;
    protected $commentTable;

    public function indexAction()
    {
        try {
            $paginator = $this->getLocalizationTable()->fetchAll(true);
            $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
            $paginator->setItemCountPerPage(10);
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage('The database connection is not available. Try again later.');
            $paginator = array();
        }

        return new ViewModel(array(
            'paginator' => $paginator,
            'searchFrom' => new SearchForm(),
        ));
    }

    public function addAction()
    {
        $form = new LocalizationForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $localization = new Localization();
            $form->setInputFilter($localization->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $localization->exchangeArray($form->getData());
                try {
                    $added_id = $this->getLocalizationTable()->saveLocalization($localization);
                    $this->flashMessenger()->addSuccessMessage('Localization is added.');
                } catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('The database connection is not available or your localization is not recognized. Try again later.');
                    return $this->redirect()->toRoute('localization');
                }
                $uri = $this->getRequest()->getUri();
                $base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
                $view_link = $base . '/localization/view/' . $added_id;
                try {
                    //function send email to administrator about new localization
                    $mail = new Mail\Message();
                    $mail->setBody('Hallo! New localization is added, look here: ' . $view_link);
                    $mail->setSubject('New localization');
                    $config = $this->getServiceLocator()->get('Config');
                    $mail->addTo($config['admin_mail']); // TODO should take it from config file (probably is defined in main application)
                    $transport = new Mail\Transport\Sendmail();
                    $transport->send($mail);
                } catch (\Exception $ex) {
                    //TODO log it in application logger (probably is defind in main application)
                }
                // Redirect to list of localizations
                return $this->redirect()->toRoute('localization');
            }
        }
        return array('form' => $form);
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');
        try {
            // get localization
            $localization = $this->getLocalizationTable()->getLocalization($id);

            // get comments
            $comments = $this->getCommentTable()->getByLocalization($id);

            // get comment form
            $commentForm = new CommentForm();
            $commentForm->get('localization_id')->setValue($id);
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('The database connection is not available or link was bad. Try find localization with search box.');
            return $this->redirect()->toRoute('localization');
        }

        return new ViewModel(array(
            'localization' => $localization,
            'commentFrom' => $commentForm,
            'comments' => $comments,
        ));
    }

    public function searchAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->redirect()->toRoute('localization');
        }
        $form = new SearchForm();
        $form->setInputFilter(new SearchFilter());
        $form->setData($request->getPost());

        if ($form->isValid()) {
            // validated data from form
            $data = $form->getData();
            $form->setData($data);

            try {
                $googleApi = \Lib\GoogleMapsApi::geocode($data['address']);
            } catch (\Exception $ex) {
                $this->flashMessenger()->addErrorMessage('Something went wrong, try again.');
                return $this->redirect()->toRoute('localization');
            }

            $localizations = $this->getLocalizationTable()->getNearLocalizations($googleApi['lat'], $googleApi['lng']);
            $searchResult = true;

            if (count($localizations)) {
                $this->flashMessenger()->addSuccessMessage('We found ' . count($localizations) . ' localizations near ' . $googleApi['address']);
            } else {
                $address = $googleApi['address'] ? $googleApi['address'] : $data['address'];
                $this->flashMessenger()->addErrorMessage('No localizations found near ' . $address);
            }
        } else {
            $localizations = $this->getLocalizationTable()->fetchAll();
            $searchResult = false;
        }

        $view = new ViewModel(['localizations' => $localizations,
            'searchFrom' => $form,
            'searchResult' => $searchResult,
        ]);
        $view->setTemplate('localization/localization/index.phtml');
        return $view;
    }

    public function getLocalizationTable()
    {
        if (!$this->localizationTable) {
            $sm = $this->getServiceLocator();
            $this->localizationTable = $sm->get('Localization\Model\LocalizationTable');
        }
        return $this->localizationTable;
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
