<?php

namespace EducacaoUnitTest\Aluno\Domain\Service;

use Acruxx\Educacao\Aluno\Domain\Service\ArquivaAluno;
use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\Event\Dispatcher;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Aluno\Domain\Entity\Aluno;
use PHPUnit\Framework\TestCase;

class ArquivaAlunoTest extends TestCase
{
    /**
     * @test
     */
    public function arquivaDeveFuncionar() : void
    {
        $events = [];

        $idAluno = IdAluno::fromString('0001-idaluno-test');
        $aluno = $this
            ->getMockBuilder(Aluno::class)
            ->disableOriginalConstructor()
            ->getMock();

        $aluno
            ->expects($this->once())
            ->method('arquiva');
        $aluno
            ->expects($this->once())
            ->method('releaseEvents')
            ->willReturn($events);

        $alunoRepository = $this->getMockForAbstractClass(AlunoRepository::class);
        $alunoRepository
            ->expects($this->once())
            ->method('getById')
            ->with($idAluno)
            ->willReturn($aluno);
        $alunoRepository
            ->expects($this->once())
            ->method('store')
            ->with($aluno);

        $dispatcher = $this->getMockForAbstractClass(Dispatcher::class);
        $dispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($events);

        $arquivaAluno = new ArquivaAluno($alunoRepository, $dispatcher);
        $arquivaAluno->arquiva($idAluno);

        $this->assertTrue(True);
    }
}
