<?php

namespace Acruxx\Educacao\Aluno\Domain\Listener;

use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiCadastrado;

class AtualizaDemandaAlunoListener implements Listener
{
    public function handle($event) : void
    {
        if ($event instanceof AlunoFoiCadastrado) {
            \error_log(
                <<<HTML
                \n\nAtualizando a demanda do aluno {$event->getNome()->toString()} para 'Matriculado'...\n\n
                HTML
            );
            return;
        }

        throw new \RuntimeException('Não entendi.');
    }
}
