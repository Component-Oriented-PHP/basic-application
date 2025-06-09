<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\View\PlatesRenderer;

abstract class AbstractController
{

    protected PlatesRenderer $view;

    public function __construct()
    {
        $this->view = new PlatesRenderer();
    }

    /**
     * you can even have a separate method to render the view
     */
    protected function render(string $template, array $data = []): string
    {
        return $this->view->render($template, $data);
    }

    /**
     * Or, a separate method to only return an instance of PlatesRenderer;
     * but then it becomes something akin to a Service Locator (gonna cover it in IoC chapter)
     */
    protected function getView(): PlatesRenderer
    {
        return $this->view;
    }
}