<?php

declare(strict_types=1);

namespace App\Http\Action;

use App\Http\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class HomeAction implements RequestHandlerInterface
{
    private Environment $template;

    public function __construct(
        Environment $template,
    ) {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->template->render('index.html.twig', ['variable' => 'Twig'])
        );
    }
}
