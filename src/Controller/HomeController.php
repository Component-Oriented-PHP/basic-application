<?php

declare(strict_types=1);

namespace App\Controller;

use App\Library\Http\CustomResponseInterface;
use App\Library\View\RendererInterface;
use App\Service\PageFetcher;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct(
        private PageFetcher $pageFetcher,
        private RendererInterface $view,
        private CustomResponseInterface $response,
    ) {
    }

    public function index(ServerRequestInterface $request)
    {
        $pages = $this->pageFetcher->fetchAll();

        $html = $this->view->render('home/index', [
            'title' => 'This is a title for Homepage!',
            'pages' => $pages
        ]);

        return $this->response->html($html);
    }
}