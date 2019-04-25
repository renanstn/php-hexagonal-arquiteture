<?php

use Acruxx\Educacao\Aluno\Application\Rest;

$app->post('/rest/v3/aluno', new Rest\CadastraAlunoAction($container));
$app->get('/rest/v3/aluno', new Rest\GetAlunosAction($container));
$app->get('/rest/v3/aluno/{id}', new Rest\GetAlunoAction($container));
$app->put('/rest/v3/aluno', new Rest\ArquivaAlunoAction($container));
