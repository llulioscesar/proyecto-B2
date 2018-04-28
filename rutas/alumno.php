<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/alumno/all", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $res = $mapper->getAllAlumnos();
  return $response->withJson($res, 201);
});

$app->post("/api/alumno/save", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->saveAlumno($args);
  return $response->withJson($res, 201);
});

$app->post("/api/alumno/estado", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->estadoAlumno($args);
  return $response->withJson($res, 201);
});

$app->post("/api/alumno/id", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAlumnoById($args);
  return $response->withJson($res, 201);
});

$app->post("/api/alumno/acudiente", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAcudiente($args);
  return $response->withJson($res, 201);
});

$app->post("/api/alumno/set", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->setAlumno($args);
  return $response->withJson($res, 201);
});

$app->post("/api/alumno/name", function (Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAlumnoByName($args);
  return $response->withJson($res, 201);
});
$app->get("/api/alumno/pdf", function(Request $request, Response $response) {
  $mapper = new AlumnoMapper($this->db);
  $args = array('idAlumno' => $request->getParam('idAlumno'));
  $alumno = $mapper->getAlumnoById($args)['datos'];
  $acudiente = $mapper->getAcudiente($args)['datos'];
  $categoria = (new CategoriaMapper($this->db))->getCategoriaById(array('idCategoria' => $alumno['categoria']))['datos'];
  $pdf = new PDF('P','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(80);
  $pdf->Cell(30,10,'Escuela de futbol Los Galaxy',0,0,'C');
  $pdf->Ln();
  $pdf->Cell(80);
  $pdf->Cell(30,10,'Hoja de vida',0,0,'C');
  $pdf->Ln(20);
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(40,10,'Informacion del Alumno:');
  $pdf->Ln();
  $pdf->setLinea(25, "Documento", $alumno['documento']);
  $pdf->setLinea(18, "Nombre", $alumno['nombre']);
  $pdf->setLinea(44, "Fecha de nacimiento", $alumno['fechaNacimiento']);
  $pdf->setLinea(34, "Tipo de sangre", $alumno['tipoSangre']);
  $pdf->setLinea(38, "Fecha de ingreso", $alumno['fechaIngreso']);
  $pdf->setLinea(34, "Fecha de retiro", $alumno['fechaRetiro']);
  $pdf->setLinea(18, "Estado", $alumno['estado'] == "1" ? "Activo" : "Inactivo");
  $pdf->Ln(20);
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(40,10,'Informacion de la categoria:');
  $pdf->Ln();
  $pdf->setLinea(18, "Nombre", $categoria['nombre']);
  $pdf->setLinea(14, "Valor", "$".$categoria['valor']);
  $pdf->Ln(20);
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(40,10,'Informacion del acudiente:');
  $pdf->Ln();
  $pdf->setLinea(25, "Documento", $acudiente['documento']);
  $pdf->setLinea(18, "Nombre", $acudiente['nombre']);
  $pdf->setLinea(22, "Direccion", $acudiente['direccion']);
  $pdf->setLinea(22, "Telefono", $acudiente['telefono']);
  $pdf->setLinea(18, "Correo", $acudiente['correo']);
  $pdf->setLinea(18, "Usuario", $acudiente['user']);

  $response = $response->withHeader('Content-type', 'application/pdf');
  $response->write($pdf->Output());
  return $response;
});
?>
