<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/acudiente/listar_todo", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $res = $mapper->getAcudientesHijos();
  return $response->withJson($res, 201);
});

$app->post("/api/acudiente/all", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $res = $mapper->getAllAcudientes();
  return $response->withJson($res, 201);
});

$app->post("/api/acudiente/id", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAcudienteById($args);
  return $response->withJson($res, 201);
});

$app->post("/api/acudiente/name", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAcudienteByName($args);
  return $response->withJson($res, 201);
});

$app->post("/api/acudiente/search", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAcudienteSearch($args);
  return $response->withJson($res, 201);
});


$app->post("/api/acudiente/insertar", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  //$res = $mapper->save(new AdultoEntity($args));
  print_r($args);
  //return $response->withJson($res, 201);
});

$app->post("/api/acudiente/hijos", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getHijos($args);
  return $response->withJson($res, 201);
});



$app->post("/api/adulto/id", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAdultoById($args);
  return $response->withJson($res, 201);
});



$app->post("/api/acudiente/modificar", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->actualizarAdulto($args);
  return $response->withJson($res, 201);
});




/*
headers: {
  'Access-Control-Allow-Origin': '*',
  'Content-Type': 'application/json'
},
data: {
  firstName: 'Fred',
  lastName: 'Flintstone'
},
*/
?>
