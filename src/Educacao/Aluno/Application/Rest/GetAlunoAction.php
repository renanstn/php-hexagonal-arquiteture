<?php

namespace Acruxx\Educacao\Aluno\Application\Rest;

use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\Entity\Aluno;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetAlunoAction extends AbstractAction
{
    public function handle(Request $req, Response $res, array $args=[]) : Response
    {
        $id = $args['id'] ?? '';

        $aluno = $this->container->get(AlunoRepository::class)->getById(IdAluno::fromString($id));

        return $res->withStatus(200)->withJson([
            'id'        => $aluno->getId()->toString(),
            'nome'      => $aluno->getNome()->toString(),
            'arquivado' => $aluno->arquivado(),
        ]);
    }
}
