<?php

namespace Acruxx\Educacao\Matricula\Application\Ui;

use Acruxx\Educacao\Matricula\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Matricula\Domain\Repository\ClasseRepository;
use Acruxx\Educacao\Matricula\Domain\Entity\Matricula;
use Acruxx\Educacao\Matricula\Domain\Dto\MatriculaAlunoDto;
use Acruxx\Educacao\Matricula\Domain\Service\NovaMatriculaAluno;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Container\ContainerInterface;

final class MatriculaController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function show(Request $req, Response $res) : Response
    {
        $alunoRepository = $this->container->get(AlunoRepository::class);
        $classeRepository = $this->container->get(ClasseRepository::class);

        $alunos = $alunoRepository->findAll();
        $classes = $classeRepository->findAll();
        
        return $this->container->view->render($res, 'matricula.html.twig', [
            'alunos' => $alunos,
            'classes' => $classes
        ]);
    }

    public function insert(Request $req, Response $res) : Response
    {
        $novaMatriculaAlunoDto = MatriculaAlunoDto::fromArray($req->getParams());

        $this->container->get(NovaMatriculaAluno::class)->matricula($novaMatriculaAlunoDto);

        $res->getBody()->write('Sucesso');

        return $res;
    }
}
