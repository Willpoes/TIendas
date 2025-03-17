<?php
include_once "conexion.php";

class CategoriasGenerales
{
    private $con;

    public function __construct()
    {
        $db = new Database();
        $this->con = $db->conectar();
    }

    public function obtenerCategorias()
    {
        $sql = $this->con->prepare("SELECT
            id_tipo as idcategorigeneral,
            nombre as nombrecategoriageneral
            FROM tipo_categoria;"
        );

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRubros()
    {
        $sql = $this->con->prepare("SELECT
            id_rubro as idrubro,
            nombre_rubro as nombrerubro
            FROM rubro_general;"
        );

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

$categorias = new CategoriasGenerales();
$resultado = $categorias->obtenerCategorias();

$rubros = new CategoriasGenerales();
$resultadoListaRubros = $rubros->obtenerRubros();

?>