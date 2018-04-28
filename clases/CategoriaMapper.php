<?php
/**
 * Realiza todas las operaciones con la tabla categorias
 */
//require_once './Bcrypt.php';

class CategoriaMapper extends Mapper
{
  // route "/api/categoria/all"
  public function getAllCategorias() {
      $json = array('estado' => true, 'datos' => null, 'error' => null);
      $sql = "SELECT * FROM categorias";
      try {
          $result = $this->db->query($sql);
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new CategoriaEntity($row))->explode();
          }
          $json['datos'] = $results;
      }catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  public function getCategoriaSearch($data) {
   $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM categorias WHERE (nombre LIKE '%".$data['buscar']."%')";
    try {
      if(isset($data['buscar'])){
          $result = $this->db->query($sql);
          $result->execute();
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new CategoriaEntity($row))->explode();
          }
          if ($results != null) {
            $json['datos'] = $results;
          } else{
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

  // route "api/categoria/save"
  public function saveCategoria($data) {
      $json = array('estado' => true, 'datos' => null, 'error' => null);
      $sql = "INSERT INTO categorias (nombre, valor, profesor) VALUES
          (:nombre, :valor, :profesor)";
      try{
          if (isset($data['nombre']) && isset($data['valor']) && isset($data['profesor']) ) {
              $stmt = $this->db->prepare($sql);
              $result = $stmt->execute([
              "nombre" => $data['nombre'],
              "valor" => $data['valor'],
              "profesor" => $data['profesor'],
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

  // route "/api/categoria/estado"
  public function estadoCategoria($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "UPDATE categorias  SET estado = :estado WHERE id = :idCategoria";
    try{
      if (isset($data['estado']) && isset($data['idCategoria'])){
        $result = $this->db->prepare($sql);
        $result->execute([
        "idCategoria"=> $data['idCategoria'],
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

  // route "/api/categoria/id"
  public function getCategoriaById($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, nombre, valor, estado FROM categorias WHERE id = :idCategoria" ;
    try {
      if (isset($data['idCategoria'])) {
        $result = $this->db->prepare($sql);
        $result->execute(["idCategoria" => $data['idCategoria']]);
        $data = new CategoriaEntity($result->fetch());
        $json['datos'] = $data->explode();
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

  // route "/api/categoria/alumnos"
  public function getAlumnos($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM alumnos WHERE categoria = :idCategoria";
    try {
      if(isset($data['idCategoria'])){
          $result = $this->db->prepare($sql);
          $result->execute(["idCategoria" => $data['idCategoria']]);
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
      }else {
        $json['estado']= false;
        $json['error'] = "campo requerido";
      }
    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  // route "/api/categoria/set"
  public function setCategoria($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "UPDATE categorias  SET nombre = :nombre, valor = :valor , profesor = :profesor WHERE id = :idCategoria";
    try {
      if (isset($data['idCategoria']) && isset($data['nombre']) && isset($data['valor'])
          && isset($data['profesor']) ) {
            $result = $this->db->prepare($sql);
            $result->execute([
            "idCategoria"=> $data['idCategoria'],
            "nombre" => $data['nombre'],
            "valor" => $data['valor'],
            "profesor" => $data['profesor']
            ]);
            $json['datos'] = true;
         }else {
            $json['estado']= false;
            $json['error'] = "campo requerido";
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
