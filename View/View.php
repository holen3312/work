<?php

namespace View;

class View
{
    private $templatePath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function renderHtml(string $templateName, array $vars = [])
    {
        extract($vars);
        include $this->templatePath . '/' . $templateName;
    }

    public function setVar(string $name, $value): void
    {
        $this->extraVars[$name] = $value;
    }
}