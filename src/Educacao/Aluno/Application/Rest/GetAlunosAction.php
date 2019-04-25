<?php

namespace Acruxx\Educacao\Aluno\Application\Rest;

use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\Entity\Aluno;
use Slim\Http\Request;
use Slim\Http\Response;

final class GetAlunosAction extends AbstractAction
{
    public function handle(Request $req, Response $res, array $args=[]) : Response
    {
        $alunos = $this->container->get(AlunoRepository::class)->findAll();

        $arrAlunos = array_map(function(Aluno $aluno) : array {
            return [
                'id'        => $aluno->getId()->toString(),
                'nome'      => $aluno->getNome()->toString(),
                'arquivado' => $aluno->arquivado(),
            ];
        }, $alunos);

        return $res->withStatus(200)->withJson($arrAlunos);
    }
}
