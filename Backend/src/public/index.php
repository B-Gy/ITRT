<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

require 'connection.php';

$app = new \Slim\App;

$app->get('/folders/[{parentID}]', function (Request $request, Response $response, $args) {
  $conn = getConnection();
  if(isset($args['parentID'])){
    $statement = $conn->prepare("SELECT id, name FROM folder WHERE parentid = :parentid ORDER BY name;");
    $statement->execute(array(':parentid' => $args['parentID']));
  }else{
    $statement = $conn->query("SELECT id, name FROM folder WHERE parentid IS NULL ORDER BY name;");
  }
  $folders = $statement->fetchAll(PDO::FETCH_OBJ);
  return $response->withJson($folders);
});

$app->get('/createSchema', function (Request $request, Response $response, $args) {
  $conn = getConnection();

  $conn->exec("
  CREATE TABLE IF NOT EXISTS `folder` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(64) CHARACTER SET utf8 NOT NULL,
    `parentid` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_parent` (`parentid`,`name`),
    CONSTRAINT `fk_parent` FOREIGN KEY (`parentid`) REFERENCES `folder` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
  $conn->exec("
  CREATE TABLE IF NOT EXISTS `image` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(64) CHARACTER SET utf8 NOT NULL,
    `folder_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_folder` (`folder_id`),
    CONSTRAINT `fk_folder` FOREIGN KEY (`folder_id`) REFERENCES `folder` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
  $response->getBody()->write("Done.");
  return $response;
});
$app->run();
