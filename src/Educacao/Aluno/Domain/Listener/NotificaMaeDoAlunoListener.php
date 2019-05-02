<?php

namespace Acruxx\Educacao\Aluno\Domain\Listener;

use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiCadastrado;

class NotificaMaeDoAlunoListener implements Listener
{
    public function handle($event) : void
    {
        if ($event instanceof AlunoFoiCadastrado) {
            \error_log('Notificando a mãe do aluno...');
            return;
        }

        throw new \RuntimeException('Não entendi.');
    }
}
