<?php

class Custom_table
{
    private $col_headers;
    private $data;
    private $btn_edit;
    private $btn_delete;
    private $btn_play;

    public function __construct($col_headers = [], $data = [], $btn_delete = false, $btn_edit = true, $btn_play = false)
    {
        $this->col_headers = $col_headers;
        $this->data = $data;
        $this->btn_edit = $btn_edit;
        $this->btn_delete = $btn_delete;
        $this->btn_play = $btn_play;
    }

    public function render()
    {
        // Créer les en-têtes de la table
        $headers = "";
        foreach ($this->col_headers as $item) {
            $headers .= "<td>$item</td>";
        }
        if ($this->btn_delete || $this->btn_edit || $this->btn_play) {
            $headers .= "<td>Actions</td>";
        }

        // Générer les lignes de données avec les boutons correspondants
        $content = "";
        foreach ($this->data as $row) {
            $rowData = "";
            foreach ($row as $value) {
                $rowData .= "<td>$value</td>";
            }
            if ($this->btn_delete || $this->btn_edit || $this->btn_play) {
                $actions = "";
                if ($this->btn_edit) {
                    $actions .= "<button>Edit</button>";
                }
                if ($this->btn_delete) {
                    $actions .= "<button>Delete</button>";
                }
                if ($this->btn_play) {
                    $actions .= "<button>Play</button>";
                }
                $rowData .= "<td>$actions</td>";
            }
            $content .= "<tr>$rowData</tr>";
        }

        return <<<HTML
        <table>
            <thead>
                <tr>
                    $headers
                </tr>
            </thead>
            <tbody>
                $content
            </tbody>
        </table>
        HTML;
    }
}
