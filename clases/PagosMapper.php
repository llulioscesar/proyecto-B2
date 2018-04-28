<?php
/**
 * Realiza todas las operaciones con la tabla adultos
 */
class PagosMapper extends Mapper
{
  // obtener todos los adultos
  public function getPagos() {
    $sql = "SELECT * FROM pagos";
    $stmt = $this->db->query($sql);
    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PagosEntity($row);
    }
    return $results;
  }

  public function getPagoById($id) {
      // el parametro :id es el id q voy a buscar
      $sql = "SELECT * FROM pagos WHERE id = :id";
      $stmt = $this->db->prepare($sql);
      // asigno el id al sql
      $stmt->execute(["id" => $id]);
      return new PagosEntity($stmt->fetch());
  }

  public function save(PagosEntity $pago) {
      $sql = "INSERT INTO pagos (alumno, fechaPago, valorPago, mesesPagos) VALUES
          (:alumno, :fechaPago, :valorPago, :mesesPagos)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "alumno" => $pago->getAlumno(),
          "fechaPago" => $pago->getfechaPago(),
          "valorPago" => $pago->getValorPago(),
          "mesesPagos" => $pago->getMesesPagos()
      ]);
      if(!$result) {
          throw new Exception("No pudo guardar el registro");
      }
  }

}

?>
