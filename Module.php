<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Althingi;

use \PDO;
use Psr\Log\LoggerAwareInterface;


use Zend\Authentication\AuthenticationService;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\Application;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Zend\Http\Client;

use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\EventManager\EventInterface;


class Module
{
	/**
	 * Load the application config.
	 *
	 * @return mixed
	 */
	public function getConfig()
	{
        return include __DIR__ . '/config/module.config.php';
    }

	/**
	 * Get how to autoload the application.
	 *
	 * @return array
	 */
	public function getAutoloaderConfig()
	{
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

	/**
	 * Load the services.
	 *
	 * @return array
	 */
	public function getServiceConfig()
	{
		return array(
			'initializers' => array(
				'DataSourceAwareInterface' => function ($instance, $sm) {
					if ($instance instanceof Lib\DataSourceAwareInterface) {
						$instance->setDataSource($sm->get('PDO'));
					}
				},
			),
			'invokables' => [
				'Althingi\Service\Assembly' 			=> 'Althingi\Service\Assembly',
				'Althingi\Service\AssemblyPerson' => 'Althingi\Service\AssemblyPerson',
				'Althingi\Service\Commitee' 			=> 'Althingi\Service\Commitee',
				'Althingi\Service\CommiteePerson' => 'Althingi\Service\CommiteePerson',
				'Althingi\Service\Cv' 						=> 'Althingi\Service\Cv',
				'Althingi\Service\Interests' 			=> 'Althingi\Service\Interests',
				'Althingi\Service\Issue' 					=> 'Althingi\Service\Issue',
				'Althingi\Service\IssueDocument' 	=> 'Althingi\Service\IssueDocument',
				'Althingi\Service\Meeting' 				=> 'Althingi\Service\Meeting',
				'Althingi\Service\Party' 					=> 'Althingi\Service\Party',
				'Althingi\Service\Person' 				=> 'Althingi\Service\Person',
				'Althingi\Service\PersonVote' 		=> 'Althingi\Service\PersonVote',
				'Althingi\Service\Review' 				=> 'Althingi\Service\Review',
				'Althingi\Service\ReviewRequest' 	=> 'Althingi\Service\ReviewRequest',
				'Althingi\Service\Speech' 				=> 'Althingi\Service\Speech',
				'Althingi\Service\Vote' 					=> 'Althingi\Service\Vote',
				'Althingi\Service\XMLFeed' 				=> 'Althingi\Service\XMLFeed',
			],
			'factories' => array(
				'Logger' => function ($sm) {
					$log = new Logger('Althingi');
					$log->pushHandler(new StreamHandler('php://stdout'));

					$evn = getenv('APPLICATION_ENV') ?: 'production';
					if ($evn == 'development') {
						//...
					} else {
						$handler = new StreamHandler('./data/log/error.log', Logger::ERROR);
						$log->pushHandler($handler);

						$handler = new StreamHandler('./data/log/system.log');
						$log->pushHandler($handler);
					}
					return $log;
				},
				'ServiceEventManager' => function ($sm) {

						$logger = $sm->get('Logger');
						$manager = new EventManager();

						$manager->attach(new ErrorEventListener($logger));
						$manager->attach(new ServiceEventListener($logger));
						$activityListener = new ActivityListener($logger);
						$activityListener->setQueueConnectionFactory(
							$sm->get('Stjornvisi\Lib\QueueConnectionFactory')
						);
						$manager->attach($activityListener);

						return $manager;
				},
				'PDO\Config' => function ($sm) {
					$config = $sm->get('config');
					return array(
						'dns' => $config['db']['dns'],
						'user' => $config['db']['user'],
						'password' => $config['db']['password'],
						'options' => array(
							PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
						)
					);
				},
				'PDO' => function ($sm) {
					$config = $sm->get('PDO\Config');
					return new PDO(
						$config['dns'],
						$config['user'],
						$config['password'],
						$config['options']
					);
				},
			),
		);
    }

}
