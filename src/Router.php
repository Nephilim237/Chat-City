<?php
namespace Chat;

use AltoRouter;

class Router
{
    /**
     * @var string Chemin vers le dossier contenant les vues de nos pages
     */
    private string $viewFolder;

    /**
     * @var AltoRouter Routeur Altorouteur
     */
    private AltoRouter $router;

    public function __construct(string $viewFolder)
    {
        $this->viewFolder = $viewFolder;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    public function post(string $url, string $view, string $name):self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }

    public function url(string $routeName, array $param = []): string
    {
        return $this->router->generate($routeName, $param);
    }

    public function run(): self
    {
        $match = $this->router->match();
        $view = $match['target'];
        $router = $this;
        require $this->viewFolder . $view . '.php';

        return $this;

    }
}
