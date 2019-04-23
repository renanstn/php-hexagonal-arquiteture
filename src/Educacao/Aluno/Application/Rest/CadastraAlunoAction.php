<?php
namespace Acruxx\Educacao\Aluno\Application\Rest;

use Acruxx\Educacao\Aluno\Domain\Dto\CadastraAlunoDto;
use Acruxx\Educacao\Aluno\Domain\Service\CadastraAluno;
use Acruxx\Educacao\Aluno\Infraestructure\Persistence\Json\JsonAlunoRepository;
use Slim\Http\Request;
use Slim\Http\Response;

final class CadastraAlunoAction
{
    public function __invoke(Request $req, Response $res) : Response
    {
        try {
            $storageDir  = '';
            $storageFile = 'alunos.json';

            $alunoRepository = new JsonAlunoRepository($storageDir, $storageFile);
            $cadastraAlunoDto = CadastraAlunoDto::fromArray($req->getParams());
            $cadastraAluno = new CadastraAluno($alunoRepository);

            $cadastraAluno->cadastra($cadastraAlunoDto);

            return $res->withStatus(200)->withJson([
                'message' => 'É nois!'
            ]);

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
}
