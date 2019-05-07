<?php

namespace Acruxx\Educacao\Aluno\Domain\Listener;

use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiCadastrado;
use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiArquivado;

class NotificaMaeDoAlunoListener implements Listener
{
    public function handle($event) : void
    {
        if ($event instanceof AlunoFoiCadastrado) {
            \error_log(
                <<<HTML
                \n\nNotificando a mãe do aluno {$event->getNome()->toString()} com ID {$event->getId()->toString()}...\n\n
                HTML
            );
            return;
        }

        if ($event instanceof AlunoFoiArquivado) {
            \error_log(
                <<<HTML
                \n\n
                Notificando a mãe do aluno com ID {$event->getId()->toString()} que ele foi arquivado.
                \n\n
                HTML
            );
            return;
        }

        throw new \RuntimeException('Não entendi.');
    }
}
