<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/profesor/all", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $res = $mapper->getAllProfesores();
  return $response->withJson($res, 201);
});

$app->post("/api/profesor/id", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getProfesorById($args);
  return $response->withJson($res, 201);
});


?>