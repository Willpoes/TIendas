<?php
require "conexion.php";

class Categorias
{
    private $con;

    public function __construct()
    {
        $db = new Database();
        $this->con = $db->conectar();
    }

    public function obtenerCategorias()
    {
        $sql = $this->con->prepare(
            "SELECT 
            cg.id_categorias as idcategoria, 
            cg.nombre as nombrecategoria, 
            r.nombre_rubro as nombrerubro,
            cat.nombre as nombrecategoriageneral
            FROM categorias_general AS cg
            INNER JOIN rubro_general AS r 
            ON r.id_rubro = cg.id_rubro
            INNER JOIN tipo_categoria AS cat
            on cat.id_tipo = cg.id_tipo;"
        );

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

$categorias = new Categorias();
$resultado = $categorias->obtenerCategorias();
?>