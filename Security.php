<?php

namespace Controllers\Mantenimientos\Encuestas;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Mantenimientos\Encuestas as EncuestasDAO;

const LIST_VIEW_TEMPLATE = "mantenimientos/encuestas/listado";

class Listado extends PublicController
{

    private array $encuestasList = [];

    public function run(): void
    {
        $this->encuestasList = EncuestasDAO::getAllEncuestas();

        Renderer::render(
            LIST_VIEW_TEMPLATE,
            $this->prepareViewData()
        );
    }

    private function prepareViewData()
    {
        return [
            "encuestas" => $this->encuestasList
        ];
    }
}

