<?php

/*
* @author: Katarzyna Kajzar <k.kajzar@gmail.com>
* created 2015-06-30
*/


return array(
     'controllers' => array(
         'invokables' => array(
             'Localization\Controller\Localization' => 'Localization\Controller\LocalizationController',
             'Localization\Controller\Comment' => 'Localization\Controller\CommentController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'localization' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/localization[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Localization\Controller\Localization',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'comment' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/comment[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Localization\Controller\Comment',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'localization' => __DIR__ . '/../view',
         ),
     ),
 );