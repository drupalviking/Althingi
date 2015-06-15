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
    $lawIssues = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'lagafrumvarp');
    $lawIssueSuggestions = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'þingsályktunartillaga');
    $questions = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'fyrirspurn');
    $reports = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'skýrsla');
    $questionToWritten = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'fyrirspurn til skrifl. svars');
    $requestForReport = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'beiðni um skýrslu');
    $commiteeSuggestionsForReport = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'álit nefndar um skýrslu');
    $disapproval = $issueService->fetchAllForAssembly($this->params()->fromRoute('id'), 'vantraust');

    return new ViewModel([
      "assembly" => $assembly,
      "lawIssues" => $lawIssues,
      "lawIssueSuggestions" => $lawIssueSuggestions,
      "questions" => $questions,
      "reports" => $reports,
      "questionToWritten" => $questionToWritten,
      "requestForReport" => $requestForReport,
      "commiteeSuggestionsForReport" => $commiteeSuggestionsForReport,
      "disapproval" => $disapproval
    ]);
  }
}