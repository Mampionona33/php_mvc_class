<?php

class PageHandler
{
    private $message;
    private $errorMessage;

    private $title;
    private $content;

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
                {$this->getContent()}
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
}
