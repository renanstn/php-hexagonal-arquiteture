<?php

use Acruxx\Educacao\Aluno\Domain\Service\CadastraAluno;
use Acruxx\Educacao\Aluno\Domain\Service\ArquivaAluno;
use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Infrastructure\Persistence\Json\JsonAlunoRepository;
use Acruxx\Educacao\Aluno\Infrastructure\Persistence\PdoPgSql\PdoPgSqlRepository;
use Acruxx\Educacao\Aluno\Domain\Event\Dispatcher;
use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiCadastrado;
use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiArquivado;
use Acruxx\Educacao\Aluno\Domain\Listener\NotificaMaeDoAlunoListener;
use Acruxx\Educacao\Aluno\Domain\Listener\AtualizaDemandaAlunoListener;
use Acruxx\Educacao\Aluno\Infrastructure\Event\AcruxxDispatcher;
use Acruxx\Educacao\Matricula;

use Psr\Container\ContainerInterface;

$config['settings'] = [
    "displayErrorDetails" => true
];

$container = new \Slim\Container($config);

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../res/templates', [
        'cache' => false //__DIR__ . '/../data/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

session_start();

$container['flash'] = function() {
    return new \Slim\Flash\Messages();
};

$container[CadastraAluno::class] = static function (ContainerInterface $container) {

    $alunoRepository = $container->get(AlunoRepository::class);
    $dispatcher = $container->get(Dispatcher::class);

    return new CadastraAluno($alunoRepository, $dispatcher);
};

$container[ArquivaAluno::class] = static function (ContainerInterface $container) {

    $alunoRepository = $container->get(AlunoRepository::class);
    $dispatcher = $container->get(Dispatcher::class);

    return new ArquivaAluno($alunoRepository, $dispatcher);
};

$container[AlunoRepository::class] = static function(ContainerInterface $container) {

    /* $storageDir  = __DIR__ . '/../data/storage/';
    $storageFile = 'alunos.json';

    return new JsonAlunoRepository($storageDir, $storageFile); */

    return new PdoPgSqlRepository($container->get('pdo-connection'));
};

$container[Dispatcher::class] = static function() {
    
    $dispatcher = new AcruxxDispatcher();
    $dispatcher->attach(AlunoFoiCadastrado::class, new NotificaMaeDoAlunoListener());
    $dispatcher->attach(AlunoFoiCadastrado::class, new AtualizaDemandaAlunoListener());

    $dispatcher->attach(AlunoFoiArquivado::class, new NotificaMaeDoAlunoListener());

    return $dispatcher;
};

/**
 * Contexto Matrícula
 */
$container[Matricula\Domain\Repository\MatriculaRepository::class] = static function (ContainerInterface $container) {
    return  new Matricula\Infrastructure\Persistence\PdoPgSql\PdoPgSqlMatriculaRepository(
        $container->get('pdo-connection')
    );
};

$container[Matricula\Domain\Repository\AlunoRepository::class] = static function (ContainerInterface $container) {
    return  new Matricula\Infrastructure\Persistence\Component\ComponentAlunoRepository(
        $container->get(AlunoRepository::class)
    );
};

$container[Matricula\Domain\Repository\ClasseRepository::class] = static function (ContainerInterface $container) {
    return new Matricula\Infrastructure\Persistence\Fake\FakeClasseRepository();
};

$container[Matricula\Domain\Service\NovaMatriculaAluno::class] = static function (ContainerInterface $container) {
    return new Matricula\Domain\Service\NovaMatriculaAluno(
        $container->get(Matricula\Domain\Repository\MatriculaRepository::class),
        $container->get(Matricula\Domain\Repository\AlunoRepository::class),
        $container->get(Matricula\Domain\Repository\ClasseRepository::class)
    );
};

/**
 * Config Aplicação
 */
$container['pdo-connection'] = static function () {
    $pdo = new \PDO('pgsql:host=postgres;dbname=php;user=root;password=123');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  
    return $pdo;
  };

return $container;
