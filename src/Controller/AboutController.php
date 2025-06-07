<?php

declare(strict_types=1);

namespace App\Controller;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class AboutController
{

    private $view;

    public function __construct()
    {
        $this->view =  (new \App\Library\Service\ServiceLocator())->get('view');
    }

    public function index(ServerRequestInterface $request)
    {
        return new HtmlResponse($this->view->render('about/index', [
            'title' => 'This is a title for About Us!'
        ]));
    }
}