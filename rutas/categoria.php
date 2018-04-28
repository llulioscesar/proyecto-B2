<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/categoria/all", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $res = $mapper->getAllCategorias();
  return $response->withJson($res, 201);
});

$app->post("/api/categoria/save", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->saveCategoria($args);
  return $response->withJson($res, 201);
});

$app->post("/api/categoria/estado", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->estadoCategoria($args);
  return $response->withJson($res, 201);
});

$app->post("/api/categoria/id", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getCategoriaById($args);
  return $response->withJson($res, 201);
});

$app->post("/api/categoria/alumnos", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getAlumnos($args);
  return $response->withJson($res, 201);
});

$app->post("/api/categoria/set", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->setCategoria($args);
  return $response->withJson($res, 201);
});

$app->post("/api/categoria/search", function (Request $request, Response $response) {
  $mapper = new CategoriaMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->getCategoriaSearch($args);
  return $response->withJson($res, 201);
});







?>
