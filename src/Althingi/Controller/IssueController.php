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
 * Class IssueController.
 *
 * @package Althingi\Controller
 */
class IssueController extends AbstractActionController
{
  /**
   * This is the landing page of an issue
   *
   */
  public function indexAction()
  {
    $assemblyId = $this->params()->fromRoute('assembly_id');
    $issueId = $this->params()->fromRoute('id');
    //SERVICES
    //  load all services
    $sm = $this->getServiceLocator();
    $issueService = $sm->get('Althingi\Service\Issue');
    $speechService = $sm->get('Althingi\Service\Speech');
    $voteService = $sm->get('Althingi\Service\Vote');

    $issue = $issueService->getByIssueAndAssembly($issueId, $assemblyId);
    $speeches = $speechService->getMetadataForIssueAndAssembly($issue->id, $assemblyId);
    $votes = $voteService->getForIssue($issue->id);

    return new ViewModel([
      "issue" => $issue,
      "speech_meta" => $speeches,
      "votes" => $votes
    ]);
  }
}
