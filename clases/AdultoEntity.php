<?php

class AdultoEntity
{

  protected $id;
  protected $documento;
  protected $nombre;
  protected $direccion;
  protected $telefono;
  protected $correo;
  protected $tipo;
  protected $user;
  protected $password;
  protected $estado;

  function __construct(array $data)
  {
    $this->id = $data['id'];
    $this->documento = $data['documento'];
    $this->nombre = $data['nombre'];
    $this->direccion = $data['direccion'];
    $this->telefono = $data['telefono'];
    $this->correo = $data['correo'];
    $this->tipo = $data['tipo'];
    $this->user = $data['user'];
    $this->password = $data['password'];
    $this->estado = boolval($data['estado']);
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

  public function getDireccion() {
    return $this->direccion;
  }

  public function getTelefono() {
    return $this->telefono;
  }

  public function getCorreo() {
    return $this->correo;
  }

  public function getTipo() {
    return $this->tipo;
  }

  public function getUser() {
    return $this->user;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getEstado() {
    return $this->estado;
  }

  public function explode() {
    return get_object_vars($this);
  }
}


?>
