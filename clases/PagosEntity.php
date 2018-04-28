<?php

class AdultosEntity
{

  protected $id;
  protected $alumno;
  protected $fechaPago;
  protected $valorPago;
  protected $mesesPagos;
  
  function __construct(array $data)
  {
    $this->id = $data['id'];
    $this->alumno = $data['alumno'];
    $this->fechaPago = $data['fechaPago'];
    $this->valorPago = $data['valorPago'];
    $this->mesesPagos = $data['mesesPagos'];
  }

  public function getId() {
    return $this->id;
  }

  public function getAlumno() {
    return $this->alumno;
  }

  public function getFechaPago() {
    return $this->fechaPago;
  }

  public function getValorPago() {
    return $this->valorPago;
  }

  public function getMesesPagos() {
    return $this->mesesPagos;
  }

}

?>
