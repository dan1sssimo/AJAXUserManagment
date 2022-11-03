<?php


namespace core;


/**
 * Базовий клас для всіх контролерів
 * @package core
 */
class Controller
{
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            return true;
        else
            return false;
    }

    public function render($viewName, $localParams = null, $globalParams = null)
    {
        $tpl = new Template();
        if (is_array($localParams))
            $tpl->setParams($localParams);
        if (!is_array($globalParams))
            $globalParams = [];
        $moduleName = strtolower((new \ReflectionClass($this))->getShortName());
        $globalParams['PageContent'] = $tpl->render("views/{$moduleName}/{$viewName}.php");
        return $globalParams;
    }
}