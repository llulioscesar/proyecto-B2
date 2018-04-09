<?php
/**
 * Realiza todas las operaciones con la tabla adultos
 */
require_once './Bcrypt.php';

class AdultoMapper extends Mapper
{
  public function getAllAcudientes() {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, documento, nombre, direccion, telefono, correo, tipo, user, password FROM adultos where tipo = 2";
    try {
      $result = $this->db->query($sql);
      $results = [];
      while ($row = $result->fetch()) {
        $results[] = (new AdultoEntity($row))->explode();
      }
      $json['datos'] = $results;
    } catch(PDOException $e) {
      $json['estado'] = false;
      //$error = array('mensaje' => $e->getMessage(), 'trace' => $e->getTraceAsString());
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  public function getAllProfesores() {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, documento, nombre, direccion, telefono, correo, tipo, user, password FROM adultos where tipo = 1";
    try {
      $result = $this->db->query($sql);
      $results = [];
      while ($row = $result->fetch()) {
        $results[] = (new AdultoEntity($row))->explode();
      }
      $json['datos'] = $result;
    } catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  public function getAdultoById($id) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, documento, nombre, direccion, telefono, correo, tipo, user, password from adultos where id = :id";
    try {
      $result = $this->db->prepare($sql);
      $result->execute(["id" => $id]);
      $json['datos'] = (new AdultoEntity($result->fetch()))->explode();
    } catch(PDOException $e) {
      $json['estado'] = false;
      $json['error'] = $e->getMessage();
    }
    return $json;
  }

  public function login($data) {
    $json = array('estado' => true, 'datos' => null, 'error' => null);
    $sql = "SELECT id, documento, nombre, direccion, telefono, correo, tipo, user, password from adultos where user = :user";
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
      echo $e->getTraceAsString();
    }

    //$json['datos'] = Bcrypt::hashPassword('123456', 10);
    return $json;
  }

  public function save(AdultoEntity $adulto) {
      $sql = "insert into adultos (documento, nombre, direccion, telefono, correo, tipo, user, password) values
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
      }
  }

}

?>
