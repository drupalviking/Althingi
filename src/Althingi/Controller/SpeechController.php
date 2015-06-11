<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 11/06/15
 * Time: 13:08
 */

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
 * @package Althingi\Controller
 */
class SpeechController extends AbstractActionController
{
  /**
   * This is the landing page of an issue
   *
   */
  public function listAction()
  {
    $assemblyId = $this->params()->fromRoute('assembly_id');
    $issueId = $this->params()->fromRoute('issue_id');
    //SERVICES
    //  load all services
    $sm = $this->getServiceLocator();
    $issueService = $sm->get('Althingi\Service\Issue');
    $speechService = $sm->get('Althingi\Service\Speech');

    $issue = $issueService->getByIssueAndAssembly($issueId, $assemblyId);
    $speeches = $speechService->getForIssueAndAssembly($issueId, $assemblyId);

    return new ViewModel([
      "issue" => $issue,
      "speeches" => $speeches
    ]);
  }
}