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
use Psr\Container\ContainerInterface;

$container = new \Slim\Container();

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

$container['pdo-connection'] = static function () {
    $pdo = new \PDO('pgsql:host=postgres;dbname=php;user=root;password=123');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  
    return $pdo;
  };

return $container;
