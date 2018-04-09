<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/acudiente/todos", function (Request $request, Response $response) {
  $mapper = new AdultoMapper($this->db);
  $res = $mapper->getAllAcudientes();
  return $response->withJson($res, 201);
});

$app->post("/api/acudiente/crear", function (Request $request, Response $response) {

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
