<?php

use Acruxx\Educacao\Aluno\Application\Rest;

$app->post('/rest/v3/aluno', new Rest\CadastraAlunoAction());
