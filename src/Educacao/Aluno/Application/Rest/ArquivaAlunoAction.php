<?php

namespace Acruxx\Educacao\Aluno\Application\Rest;

use Acruxx\Educacao\Aluno\Domain\Service\ArquivaAluno;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Slim\Http\Request;
use Slim\Http\Response;

final class ArquivaAlunoAction extends AbstractAction
{
    public function handle(Request $req, Response $res, array $args=[]) : Response
    {
        $id = $req->getParams()['id'] ?? '';

        $this->container->get(ArquivaAluno::class)->arquiva(IdAluno::fromString($id));

        return $res->withStatus(200)->withJson([
            'message' => 'Arquivado!'
        ]);
    }
}
