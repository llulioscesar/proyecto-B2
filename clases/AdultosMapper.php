<?php
/**
 * Realiza todas las operaciones con la tabla adultos
 */
class AdultosMapper extends Mapper
{
  // obtener todos los adultos
  public fuction getAdultos() {
    $sql = "SELECT * FROM adultos";
    $stmt = $this->db->query($sql);
    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AdultosEntity($row);
    }
    return $results;
  }

  public function getAdultoById($id) {
      // el parametro :id es el id q voy a buscar
      $sql = "SELECT * from adultos where id = :id";
      $stmt = $this->db->prepare($sql);
      // asigno el id al sql
      $stmt->execute(["id" => $id]);
      return new AdultoEntity($stmt->fetch());
  }

  public function save(AdultoEntity $adulto) {
      $sql = "insert into adultos (documento, nombre, direccion, telefono, correo, tipo, user, contraseña) values
          (:documento, :nombre, :direccion, :telefono, :correo, :tipo, :user, :contraseña)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "documento" => $adulto->getDocumento(),
          "nombre" => $adulto->getNombre(),
          "direccion" => $adulto->getDireccion(),
          "telefono" => $adulto->getTelefono(),
          "correo" => $adulto->getCorreo(),
          "tipo" => $adulto->getTipo(),
          "user" => $adulto->getUser(),
          "contraseña" => $adulto->getContraseña()
      ]);
      if(!$result) {
          throw new Exception("No pudo guardar el registro");
      }
  }

}

?>
