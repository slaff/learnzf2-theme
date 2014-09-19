<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Theme for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Theme\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $themeService = $this->serviceLocator->get('theme');

        return array(
            'current' => $themeService->getName(),
            'list' => $themeService->getConfig()
        );
    }

    public function changeAction()
    {
        $theme = $this->params('theme');
        $themeService = $this->serviceLocator->get('theme');
        try {
            $themeService->setName($theme);
            $this->flashmessenger()->addSuccessMessage('The new theme was activated successfully!');
        } catch (\Exception $ex) {
            // Invalid theme name
            $this->flashmessenger()->addErrorMessage('Invalid theme name!');
        }

        return $this->redirect($this->url('theme'));
    }
}
