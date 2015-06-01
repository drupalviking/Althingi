<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Althingi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\FeedModel;


/**
 * Class IndexController.
 *
 * @package Stjornvisi\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * This is the landing page or the home page.
     *
     * It will display a <em>welcome</em> and a <em>sales pitch</em>
     * if the use is not logged in, else it will be the user's personal
     * profile.
     */
    public function indexAction()
    {
        //SERVICES
        //  load all services
        $sm = $this->getServiceLocator();
        $assemblyService = $sm->get("Althingi\Service\Assembly");
        //$assemblies = $assemblyService->get($this->params()->fromRoute('id'));
        $xmlService = $sm->get("Althingi\Service\XMLFeed");
        /*for($i = 144; $i < 145; $i++){
            echo "Working on {$i} Assembly<br>";
            $data = $xmlService->processAssemblyPersons($i);
            echo "Finished working on {$i} Assembly<br>";
        }*/
        $data = $xmlService->processAssemblyIssues(141);

        $assemblies = $assemblyService->fetchAll();
        return new ViewModel(["assemblies" => $assemblies]);
    }
}
