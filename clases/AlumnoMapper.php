<?php
/**
 * Realiza todas las operaciones con la tabla alumnos
 */

class AlumnoMapper extends Mapper
{
  // route "/api/alumno/all"
  public function getAllAlumnos() {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
      $sql = "SELECT * FROM alumnos ORDER BY nombre";
      try {
          $result = $this->db->query($sql);
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new AlumnoEntity($row))->explode();
          }
          $json['datos'] = $results;
      }catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  // route "api/alumno/save"
  public function saveAlumno($data) {
      $json = array('estado' => true, 'datos' => null, 'error' => null);
     $sql = "INSERT INTO alumnos (documento, nombre, fechaNacimiento, tipoSangre, fechaIngreso, fechaRetiro, acudiente, categoria) VALUES
          (:documento, :nombre, :fechaNacimiento, :tipoSangre, :fechaIngreso, :fechaRetiro,:acudiente, :categoria)";
      try{
          if (isset($data['documento']) && isset($data['nombre']) && isset($data['fechaNacimiento']) &&
              isset($data['tipoSangre']) && isset($data['fechaIngreso']) && isset($data['fechaRetiro'])
              && isset($data['acudiente']) && isset($data['categoria'])) {

            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
            "documento" => $data['documento'],
            "nombre" => $data['nombre'],
            "fechaNacimiento" => $data['fechaNacimiento'],
            "tipoSangre" => $data['tipoSangre'],
            "fechaIngreso" => $data['fechaIngreso'],
            "fechaRetiro" => $data['fechaRetiro'],
            "acudiente" => $data['acudiente'],
            "categoria" => $data['categoria']
            ]);
            $json['datos'] = true;
          }else{
              $json['estado'] = false;
              $json['error'] = "Campo requerido";
          }
      }
      catch(PDOException $e) {
          $json['estado'] = false;
          $json['error'] = $e->getMessage();
      }
      return $json;
  }

   // route "/api/alumno/estado"
  public function estadoAlumno($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "UPDATE alumnos SET estado = :estado WHERE id = :idAlumno";
    try{
      if (isset($data['estado']) && isset($data['idAlumno'])){
        $result = $this->db->prepare($sql);
        $result->execute([
        "idAlumno"=> $data['idAlumno'],
        "estado"=> $data['estado'],
        ]);
         $json['datos'] = true;
      }else{
        $json['estado'] = false;
        $json['error'] = "Campo requerido";
      }
    }
    catch(PDOException $e) {
        $json['estado'] = false;
        $json['error'] = $e->getMessage();
    }
    return $json;
  }

   // route "/api/alumno/id"
  public function getAlumnoById($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM alumnos WHERE id = :idAlumno" ;
    try {
      if (isset($data['idAlumno'])) {
        $result = $this->db->prepare($sql);
        $result->execute(["idAlumno" => $data['idAlumno']]);
        $json['datos'] = (new AlumnoEntity($result->fetch()))->explode();
      }else{
        $json['estado'] = false;
        $json['error'] = "Campo requerido";
      }
    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  // route "/api/alumno/acudiente"
  public function getAcudiente($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE id = (SELECT acudiente FROM alumnos WHERE id = :idAlumno)" ;
    try {
      if (isset($data['idAlumno'])) {
        $result = $this->db->prepare($sql);
        $result->execute(["idAlumno" => $data['idAlumno']]);
        $json['datos'] = (new AdultoEntity($result->fetch()))->explode();
      }else{
        $json['estado'] = false;
        $json['error'] = "Campo requerido";
      }
    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

   // route "/api/alumno/set"
  public function setAlumno($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "UPDATE alumnos  SET documento = :documento, nombre = :nombre, fechaNacimiento = :fechaNacimiento, tipoSangre = :tipoSangre, fechaIngreso = :fechaIngreso,
      fechaRetiro = :fechaRetiro, acudiente = :acudiente, categoria = :categoria, estado = :estado
      WHERE id = :idAlumno";
    try {
      if (isset($data['documento']) && isset($data['nombre']) && isset($data['fechaNacimiento']) &&
              isset($data['tipoSangre']) && isset($data['fechaIngreso']) && isset($data['fechaRetiro'])
              && isset($data['acudiente']) && isset($data['categoria']) && isset($data['estado'])) {

            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
            "idAlumno" => $data['idAlumno'],
            "documento" => $data['documento'],
            "nombre" => $data['nombre'],
            "fechaNacimiento" => $data['fechaNacimiento'],
            "tipoSangre" => $data['tipoSangre'],
            "fechaIngreso" => $data['fechaIngreso'],
            "fechaRetiro" => $data['fechaRetiro'],
            "acudiente" => $data['acudiente'],
            "categoria" => $data['categoria'],
            "estado" => $data['estado']
            ]);
            $json['datos'] = true;
          }else{
              $json['estado'] = false;
              $json['error'] = "Campo requerido";
          }
      }
      catch(PDOException $e) {
          $json['estado'] = false;
          $json['error'] = $e->getMessage();
      }
      return $json;
  }

  // route "/api/alumno/name"
  public function getAlumnoByName($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM alumnos WHERE nombre LIKE '%".$data['nombre']."%' ORDER BY nombre";
    try {
      if(isset($data['nombre'])){
          $result = $this->db->query($sql);
          $result->execute();
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new AlumnoEntity($row))->explode();
          }
          if($results != null){
              $json['datos'] = $results;
          }
          else{
              $json['datos'] = "No se encontraron coincidencias";
          }
      }else{
              $json['estado'] = false;
              $json['error'] = "Campo requerido";
      }
    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

}

?>
