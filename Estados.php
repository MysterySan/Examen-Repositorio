<?php

namespace Controllers\Mantenimientos\Encuestas;

use Controllers\PublicController;
use Dao\Mantenimientos\Encuestas as EncuestasDAO;
use Utilities\Site;
use Views\Renderer;

const ENCUESTAS_FORM_URL = 'index.php?page=Mantenimientos-Encuestas-Formulario';
const ENCUESTAS_LIST_URL = 'index.php?page=Mantenimientos-Encuestas-Listado';

class Formulario extends PublicController
{

    private array $viewData = [];

    private array $modes = [
        'INS' => 'Nueva Encuesta',
        'UPD' => 'Actualizar %s',
        'DSP' => 'Detalle de %s',
        'DEL' => 'Eliminando %s',
    ];

    private $id;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $activa;

    private $mode;

    public function run(): void
    {
        $this->loadPage();

        if ($this->isPostBack()) {

            $this->capturarDatos();

            if ($this->validarDatos()) {

                switch ($this->mode) {

                    case 'INS':

                        EncuestasDAO::crearEncuesta(
                            $this->titulo,
                            $this->descripcion,
                            $this->fecha,
                            $this->activa
                        );

                        Site::redirectTo(ENCUESTAS_LIST_URL);

                        break;

                    case 'UPD':

                        EncuestasDAO::actualizarEncuesta(
                            $this->id,
                            $this->titulo,
                            $this->descripcion,
                            $this->fecha,
                            $this->activa
                        );

                        Site::redirectTo(ENCUESTAS_LIST_URL);

                        break;

                    case 'DEL':

                        EncuestasDAO::eliminarEncuesta($this->id);

                        Site::redirectTo(ENCUESTAS_LIST_URL);

                        break;
                }
            }
        }

        $this->generarViewData();

        Renderer::render(
            "mantenimientos/encuestas/formulario",
            $this->viewData
        );
    }

    private function loadPage()
    {
        $this->mode = $_GET['mode'] ?? '';

        $this->id = intval($_GET['id'] ?? 0);

        if ($this->mode !== 'INS') {

            $tmp = EncuestasDAO::getEncuestaById($this->id);

            $this->titulo      = $tmp['titulo'];
            $this->descripcion = $tmp['descripcion'];
            $this->fecha       = $tmp['fecha'];
            $this->activa      = $tmp['activa'];
        }
    }

    private function capturarDatos()
    {
        $this->id          = $_POST['id'] ?? 0;
        $this->titulo      = $_POST['titulo'] ?? "";
        $this->descripcion = $_POST['descripcion'] ?? "";
        $this->fecha       = $_POST['fecha'] ?? "";
        $this->activa      = isset($_POST['activa']) ? 1 : 0;
    }

    private function validarDatos()
    {
        if ($this->titulo == "") {
            return false;
        }

        return true;
    }

    private function generarViewData()
    {
        $this->viewData["mode"]    = $this->mode;
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->mode],
            $this->titulo
        );

        $this->viewData["id"]          = $this->id;
        $this->viewData["titulo"]      = $this->titulo;
        $this->viewData["descripcion"] = $this->descripcion;
        $this->viewData["fecha"]       = $this->fecha;
        $this->viewData["activa"]      = $this->activa;
    }
}

