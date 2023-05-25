<?php

class PageHandler
{
    private $message;
    private $errorMessage;

    private $title;
    private $content;
    private $navbarContent;
    private $sidebarContent;

    public function __construct()
    {
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setNavbarContent($navbarContent)
    {
        $this->navbarContent = $navbarContent;
    }

    public function setSidebarContent($sidebarContent)
    {
        $this->sidebarContent = $sidebarContent;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function render()
    {
        /*  <<<HTML est une balise heredoc : Elle est utilisée 
        pour définir une chaîne de caractères multilignes sans
        avoir à échapper les guillemets ou les apostrophes. */
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../dist/style.css">
            <title>{$this->getTitle()}</title>
        </head>
        <body>
            <div class="container">
                {$this->renderMessage()}
                {$this->renderErrorMessage()}
                <div class="navbar">
                    {$this->getNavbarContent()}
                </div>
                <div class="side_bar">
                    {$this->getSidebarContent()}
                </div>
                <div class="content">
                    {$this->getContent()}
                </div>
            </div>
            <script src="../dist/app-bundle.js"></script>
        </body>
        </html>
HTML;
    }

    private function getTitle()
    {
        return isset($this->title) ? $this->title : "Title";
    }

    private function renderMessage()
    {
        return isset($this->message) ? "<div class=\"message_container\">{$this->message}</div>" : null;
    }

    private function renderErrorMessage()
    {
        return isset($this->errorMessage) ? "<div class=\"erreur_container\">{$this->errorMessage}</div>" : null;
    }

    private function getContent()
    {
        return isset($this->content) ? $this->content : null;
    }

    private function getNavbarContent()
    {
        return isset($this->navbarContent) ? $this->navbarContent : null;
    }

    private function getSidebarContent()
    {
        return isset($this->sidebarContent) ? $this->sidebarContent : null;
    }
}
