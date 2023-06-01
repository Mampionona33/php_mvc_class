<?php
class Custom_create_btn
{
    private $path;
    private $btn_label;

    public function __construct(string $path, string $btn_label)
    {
        $this->path = $path;
        $this->btn_label = $btn_label;
    }

    public function render()
    {
        return <<<HTML
        <div>
            <a href="{$this->path}">{$this->btn_label}</a>
        </div>
        HTML;
    }
}
