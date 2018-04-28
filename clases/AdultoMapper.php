<?php
/**
 * Realiza todas las operaciones con la tabla adultos
 */
require_once './Bcrypt.php';

class AdultoMapper extends Mapper
{
  // route "/api/acudiente/all"
  public function getAllAcudientes() {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE tipo = 2 ORDER BY nombre ";
    try {
      $result = $this->db->query($sql);
      $results = [];
      while ($row = $result->fetch()) {
        $results[] = (new AdultoEntity($row))->explode();
      }
      $json['datos'] = $results;
    } catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  // route "/api/acudiente/id"
  public function getAcudienteById($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE (id = :idAcudiente AND tipo = 2)" ;
    try {
      if (isset($data['idAcudiente'])) {
        $result = $this->db->prepare($sql);
        $result->execute(["idAcudiente" => $data['idAcudiente']]);
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

  // route "/api/acudiente/name"
  public function getAcudienteByName($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, documento, nombre, direccion, telefono, correo, tipo, user, password FROM adultos WHERE nombre LIKE '%".$data['name']."%'";
    try {
      if(isset($data['name'])){
          $result = $this->db->query($sql);
          //$result->execute([":idAcudiente" => $data['idAcudiente']]);
          $result->execute();
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new AdultoEntity($row))->explode();
          }
          $json['datos'] = $results;
      }

    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

   // route "/api/acudiente/search"
  public function getAcudienteSearch($data) {
   $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE (nombre LIKE '%".$data['buscar']."%' || documento LIKE
    '".$data['buscar']."%') AND tipo = 2";
    try {
      if(isset($data['buscar'])){
          $result = $this->db->query($sql);
          $result->execute();
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new AdultoEntity($row))->explode();
          }
          if ($results != null) {
            $json['datos'] = $results;
          }else{
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

  public function getHijos($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, documento, nombre, fechaNacimiento, tipoSangre, fechaIngreso, fechaRetiro, estado, acudiente, categoria FROM alumnos WHERE acudiente = :idAcudiente";

    try {
      if(isset($data['idAcudiente'])){
          $result = $this->db->prepare($sql);
          $result->execute([":idAcudiente" => $data['idAcudiente']]);
          //$result->execute();
          $results = [];
          while ($row = $result->fetch()) {
              $results[] = (new AlumnoEntity($row))->explode();
          }
          $json['datos'] = $results;
      }
    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  public function getAcudientesHijos() {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM alumnos WHERE tipo = 2";
    try {
      $array = [];
      $acudientes = $this->getAllAcudientes()['datos'];
      for($i = 0; $i < count($acudientes); $i++){
        $acudiente = $acudientes[$i];

        $id = array('idAcudiente' => $acudiente['id']);
        $acudiente['hijos'] = $this->getHijos($id)['datos'];
        array_push($array, $acudiente);
      }
      $json['datos'] = $array;
    }
    catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }










  // route "/api/profesor/all"
  public function getAllProfesores() {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE tipo = 1 ORDER BY nombre ";
    try {
      $result = $this->db->query($sql);
      $results = [];
      while ($row = $result->fetch()) {
        $results[] = (new AdultoEntity($row))->explode();
      }
      $json['datos'] = $results;
    } catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  public function getProfesorById($data) {

    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE (id = :idProfesor AND tipo = 1)" ;
    try {
      if (isset($data['idProfesor'])) {
          $result = $this->db->prepare($sql);
          $result->execute(["idProfesor" => $data['idProfesor']]);
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

  public function getAdultoById($data) {

    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * FROM adultos WHERE (id = :id AND tipo = ".$data['tip'].")";
    try {
      if (isset($data['id'])) {
          $result = $this->db->prepare($sql);
          $result->execute(["id" => $data['id']]);
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

  public function setAdulto(AdultoEntity $adulto) {

    $json = array('estado' => true, 'datos' => null, 'error' => null);

  }

  public function login($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT * from adultos where user = :user";
    $sql2 = "SELECT password from adultos WHERE id = :id";
    try {
      if(isset($data['user']) && isset($data['password'])) {
        $query = $this->db->prepare($sql);
        $query->bindParam(':user', $data['user']);
        $query->execute();
        $result = $query->fetch();
        if($result) {
          $adulto = new AdultoEntity($result);
          $id = $adulto->getId();
          $query = $this->db->prepare($sql2);
          $query->bindParam(':id', $id);
          $query->execute();
          $password = $query->fetchColumn();

          $verificarPassword = Bcrypt::checkPassword($data['password'], $password);

          if ($verificarPassword == true) {
             $json['datos'] = $adulto->explode();
          } else {
             $json['estado'] = false;
             $json['error'] = "Contraseña incorrecta.";
          }
        } else {
          $json['estado'] = false;
          $json['error'] = "El usuario no existe.";
        }


      } else {
        $json['estado'] = false;
        $json['error'] = "Se esperaba un usuario y contraseña.";
      }
    } catch (PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
      //echo $e->getTraceAsString();
    }

    //$json['datos'] = Bcrypt::hashPassword('123456', 10);
    return $json;
  }

  public function save(AdultoEntity $adulto) {
      //print_r($adulto);
      /*$sql = "INSERT INTO adultos (documento, nombre, direccion, telefono, correo, tipo, user, password) VALUES
          (:documento, :nombre, :direccion, :telefono, :correo, :tipo, :user, :password)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "documento" => $adulto->getDocumento(),
          "nombre" => $adulto->getNombre(),
          "direccion" => $adulto->getDireccion(),
          "telefono" => $adulto->getTelefono(),
          "correo" => $adulto->getCorreo(),
          "tipo" => $adulto->getTipo(),
          "user" => $adulto->getUser(),
          "password" => $adulto->getpassword()
      ]);
      if(!$result) {
          throw new Exception("No pudo guardar el registro");
      }*/
  }






}

?>
