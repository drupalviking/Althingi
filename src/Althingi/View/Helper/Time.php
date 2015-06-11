<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 11/06/15
 * Time: 11:44
 */
namespace Althingi\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Time extends AbstractHelper
{
  public function __invoke($seconds)
  {
    $hours = (int)($seconds / 3600);
    $remainder = ($seconds - ($hours * 3600));
    $minutes = (int)($remainder / 60);
    $remainder = ($remainder % 60);
    $minutes = ($minutes < 10) ? "0" . $minutes : $minutes;
    $remainder = ($remainder < 10) ? "0" . $remainder : $remainder;
    return $hours . ":" . $minutes . ":" . $remainder;
  }
}
