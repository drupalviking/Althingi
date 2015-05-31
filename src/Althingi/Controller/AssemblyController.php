<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 26/05/15
 * Time: 20:31
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
class AssemblyController extends AbstractActionController
{
  public function indexAction()
  {
    //SERVICES
    //  load all services
    $sm = $this->getServiceLocator();
    $assemblyService = $sm->get("Althingi\Service\Assembly");
    $issueService = $sm->get("Althingi\Service\Issue");
    $assembly = $assemblyService->get($this->params()->fromRoute('id'));
    $issues = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'));
    return new ViewModel([
      "assembly" => $assembly,
      "issues" => $issues,
    ]);
  }
}