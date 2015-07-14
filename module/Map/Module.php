<?php

/*
* @author: Katarzyna Kajzar <k.kajzar@gmail.com>
* created 2015-07-15
*/
// TODO KK change
 namespace Map;

 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 use Localization\Model\Localization;
 use Localization\Model\LocalizationTable;
 use Localization\Model\Comment;
 use Localization\Model\CommentTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                     'Lib' => __DIR__ . '/../../vendor/Lib',
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Localization\Model\LocalizationTable' =>  function($sm) {
                     $tableGateway = $sm->get('LocalizationTableGateway');
                     $table = new LocalizationTable($tableGateway);
                     return $table;
                 },
                 'LocalizationTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Localization());
                     return new TableGateway('localization', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Localization\Model\CommentTable' =>  function($sm) {
                     $tableGateway = $sm->get('CommentTableGateway');
                     $table = new CommentTable($tableGateway);
                     return $table;
                 },
                 'CommentTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Comment());
                     return new TableGateway('comment', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 