<?php

namespace Acruxx\Educacao\Aluno\Application\Rest;

use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractAction
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function __invoke(Request $req, Response $res, array $args=[]) : Response
    {
        try {

            return $this->handle($req, $res, $args);

        } catch (\InvalidArgumentException $e) {

            return $res->withStatus(400)->withJson([
                'status_code' => 400,
                'message' => $e->getMessage()
            ]);

        } catch (\DomainException $e) {

            return $res->withStatus(409)->withJson([
                'status_code' => 409,
                'message' => $e->getMessage()
            ]);
        }
    }

    abstract public function handle(Request $req, Response $res, array $args=[]) : Response;
}