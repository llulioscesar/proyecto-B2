<?php

class CategoriaEntity
{

  protected $id;
  protected $nombre;
  protected $valor;
  protected $profesor;
  protected $estado;

  function __construct($data){
    $this->id = $data['id'];
    $this->nombre = $data['nombre'];
    $this->valor = $data['valor'];
    $this->estado =  boolval($data['estado']);
  }

  public function getId() {
    return $this->id;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getValor() {
    return $this->valor;
  }

  public function getEstado(){
    return $this->estado;
  }

  public function explode() {
    return get_object_vars($this);
  }

}

?>
