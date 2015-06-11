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
    //SERVICES
    //  load all services
    $sm = $this->getServiceLocator();
    $assemblyId = $this->params()->fromRoute('assembly_id');
    $issueId = $this->params()->fromRoute('id');

    return new ViewModel();
  }
}
