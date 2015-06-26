<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
	'session' => array(
		'remember_me_seconds' => 2419200,
		'use_cookies' => true,
		'cookie_httponly' => true,
	),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Althingi\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
          'issue' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
              'route' => '/issue',
              'defaults' => array(
                'controller' => 'Althingi\Controller\Issue',
                'action' => 'index'
              ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
              'index' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                  'route' => '/:assembly_id/:id',
                  'constraints' => array(
                    'id' => '[0-9]*',
                  ),
                  'defaults' => array(
                    'controller' => 'Althingi\Controller\Issue',
                    'action' => 'index'
                  ),
                )
              ),
            ),
          ),
          'speech' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
              'route' => '/speech',
              'defaults' => array(
                'controller' => 'Althingi\Controller\Speech',
                'action' => 'list'
              ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
              'index' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                  'route' => '/:assembly_id/:issue_id',
                  'constraints' => array(
                    'id' => '[0-9]*',
                  ),
                  'defaults' => array(
                    'controller' => 'Althingi\Controller\Speech',
                    'action' => 'list'
                  ),
                )
              ),
            ),
          ),
          'assembly' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
              'route' => '/assembly',
              'defaults' => array(
                'controller' => 'Althingi\Controller\Assembly',
                'action' => 'index'
              ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
              'index' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                  'route' => '/:id',
                  'constraints' => array(
                    'id' => '[0-9]*',
                  ),
                  'defaults' => array(
                    'controller' => 'Althingi\Controller\Assembly',
                    'action' => 'index'
                  ),
                )
              ),
              'list' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                  'route' => '/list',
                  'defaults' => array(
                    'controller' => 'Althingi\Controller\Assembly',
                    'action' => 'list'
                  ),
                )
              ),
              'update' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                  'route' => '/:id/update',
                  'constraints' => array(
                    'id' => '[0-9]*',
                  ),
                  'defaults' => array(
                    'controller' => 'Althingi\Controller\Assembly',
                    'action' => 'update'
                  ),
                )
              ),
            ),
          ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Althingi\Controller\Assembly' => 'Althingi\Controller\AssemblyController',
            'Althingi\Controller\Console' => 'Althingi\Controller\ConsoleController',
            'Althingi\Controller\Index' => 'Althingi\Controller\IndexController',
            'Althingi\Controller\Issue' => 'Althingi\Controller\IssueController',
            'Althingi\Controller\Speech' => 'Althingi\Controller\SpeechController',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'paragrapher' => 'Althingi\View\Helper\Paragrapher',
            'time'        => 'Althingi\View\Helper\Time'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
		'base_path' => '/althingi/',
        'strategies' => array(
            'ViewFeedStrategy',
			'ViewJsonStrategy',
        ),
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
			'layout/landing'           => __DIR__ . '/../view/layout/landing.phtml',
			'layout/anonymous'           => __DIR__ . '/../view/layout/anonymous.phtml',
			'layout/csv'           	  => __DIR__ . '/../view/layout/csv.phtml',
            'althingi/index/index' => __DIR__ . '/../view/althingi/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
			'error/401'               => __DIR__ . '/../view/error/401.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
  'console' => array(
    'router' => array(
      'routes' => array(
        'process-assembly' => array(
          'options' => array(
            'route'    => 'process-assembly',
            'defaults' => array(
              'controller' => 'Althingi\Controller\Console',
              'action'     => 'process-assembly'
            )
          )
        ),
      ),
    ),
  ),
);
