<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/entrar", function(Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $args = $request->getParsedBody();
  $res = $mapper->login($args);
  return $response->withJson($res, 201);
});



?>
