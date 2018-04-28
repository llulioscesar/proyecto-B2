<?php

class AlumnoEntity
{

  protected $id;
  protected $documento;
  protected $nombre;
  protected $fechaNacimiento;
  protected $tipoSangre;
  protected $fechaIngreso;
  protected $fechaRetiro;
  protected $estado;
  protected $acudiente;
  protected $categoria;

  function __construct(array $data)
  {
    $this->id = $data['id'];
    $this->documento = $data['documento'];
    $this->nombre = $data['nombre'];
    $this->fechaNacimiento = $data['fechaNacimiento'];
    $this->tipoSangre = $data['tipoSangre'];
    $this->fechaIngreso = $data['fechaIngreso'];
    $this->fechaRetiro = $data['fechaRetiro'];
    $this->estado = boolval($data['estado']);
    $this->acudiente = $data['acudiente'];
    $this->categoria = $data['categoria'];
  }

  public function getId() {
    return $this->id;
  }

  public function getDocumento() {
    return $this->documento;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getFechaNacimiento() {
    return $this->fechaNacimiento;
  }

  public function getTipoSangre() {
    return $this->tipoSangre;
  }

  public function getFechaIngreso() {
    return $this->fechaIngreso;
  }

  public function getFechaRetiro() {
    return $this->fechaRetiro;
  }

  public function getEstado() {
    return $this->estado;
  }

  public function getAcudiente() {
    return $this->acudiente;
  }

  public function getCategoria() {
    return $this->categoria;
  }

  public function explode() {
    return get_object_vars($this);
  }
}


?>
