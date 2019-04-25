<?php

namespace Acruxx\Educacao\Aluno\Application\Rest;

use Acruxx\Educacao\Aluno\Domain\Dto\CadastraAlunoDto;
use Acruxx\Educacao\Aluno\Domain\Service\CadastraAluno;
use Acruxx\Educacao\Aluno\Infraestructure\Persistence\Json\JsonAlunoRepository;
use Slim\Http\Request;
use Slim\Http\Response;

final class CadastraAlunoAction extends AbstractAction
{
    public function handle(Request $req, Response $res, array $args=[]) : Response
    {
        $cadastraAlunoDto = CadastraAlunoDto::fromArray($req->getParams());

        $this->container->get(CadastraAluno::class)->cadastra($cadastraAlunoDto);

        return $res->withStatus(200)->withJson([
            'message' => 'É nois!'
        ]);
    }
}
