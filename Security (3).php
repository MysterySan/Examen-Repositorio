<?php

namespace Dao\Mantenimientos;

use Dao\Table;

class Encuestas extends Table
{

    public static function getAllEncuestas(): array
    {
        $sqlstr = "SELECT * FROM encuestas;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getEncuestaById(int $id): array
    {
        $sqlstr = "SELECT * FROM encuestas WHERE encuesta_id = :id;";
        return self::obtenerUnRegistro($sqlstr, ["id" => $id]);
    }

    public static function crearEncuesta(
        $titulo,
        $descripcion,
        $fecha,
        $activa
    ): int {

        $sqlstr = "INSERT INTO encuestas
        (titulo, descripcion, fecha, activa)
        VALUES
        (:titulo, :descripcion, :fecha, :activa);";

        return self::executeNonQuery($sqlstr, [
            "titulo"      => $titulo,
            "descripcion" => $descripcion,
            "fecha"       => $fecha,
            "activa"      => $activa
        ]);
    }

    public static function actualizarEncuesta(
        $id,
        $titulo,
        $descripcion,
        $fecha,
        $activa
    ): int {

        $sqlstr = "UPDATE encuestas SET
        titulo       = :titulo,
        descripcion  = :descripcion,
        fecha        = :fecha,
        activa       = :activa
        WHERE encuesta_id = :id;";

        return self::executeNonQuery($sqlstr, [
            "id"          => $id,
            "titulo"      => $titulo,
            "descripcion" => $descripcion,
            "fecha"       => $fecha,
            "activa"      => $activa
        ]);
    }

    public static function eliminarEncuesta(int $id): int
    {
        $sqlstr = "DELETE FROM encuestas WHERE encuesta_id = :id;";
        return self::executeNonQuery($sqlstr, ["id" => $id]);
    }
}

