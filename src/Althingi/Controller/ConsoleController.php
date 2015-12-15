<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 26/06/15
 * Time: 14:53
 */
namespace Althingi\Controller;

use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class ConsoleController extends AbstractActionController {
  public function processAssemblyAction() {
    $sm = $this->getServiceLocator();
    $xmlStreamService = $sm->get('Althingi\Service\XMLFeed');
    $xmlStreamService->bootstrapAssembly(145);
    echo "Run done\n";
  }
}
