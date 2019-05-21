<?php

namespace Acruxx\Educacao\Matricula\Infrastructure\Persistence\PdoPgSql;

use Acruxx\Educacao\Matricula\Domain\Repository\MatriculaRepository;
use Acruxx\Educacao\Matricula\Domain\Entity\Matricula;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdMatricula;

class PdoPgSqlMatriculaRepository implements MatriculaRepository
{
    /** \PDO */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function store(Matricula $matricula) : void
    {
        if ($this->findById($matricula->getId())) { /* deveria ser um findById */
            $stm = $this->pdo->prepare('
                UPDATE 
                    matriculas
                SET
                    id_aluno        = :id_aluno,
                    id_classe       = :id_classe,
                    status          = :status,
                    data_matricula  = :data_matricula
                WHERE
                    id=:id
            ');

        } else {

            $stm = $this->pdo->prepare('
                INSERT INTO
                    matriculas
                VALUES (
                    :id,
                    :id_aluno,
                    :id_classe,
                    :status,
                    :data_matricula
                )
            ');
        }

        $id = $matricula->getId()->toString();
        $idAluno = $matricula->getAluno()->getId()->toString();
        $idClasse = $matricula->getClasse()->getId()->toString();
        $status = $matricula->getStatus()->toString();
        $dataMatricula = $matricula->getData()->toString();

        $stm->bindParam(':id', $id, \PDO::PARAM_STR);
        $stm->bindParam(':id_aluno', $idAluno, \PDO::PARAM_STR);
        $stm->bindParam(':id_classe', $idClasse, \PDO::PARAM_STR);
        $stm->bindParam(':status', $status, \PDO::PARAM_STR);
        $stm->bindParam(':data_matricula', $dataMatricula);

        $stm->execute();
    }

    public function findById(IdMatricula $id) : ?Matricula
    {
        $id = $id->toString();

        $stm = $this->pdo->prepare('
            SELECT 
                * 
            FROM
                matriculas
            WHERE 
                id=:id
        ');
        $stm->bindParam(':id', $id, \PDO::PARAM_STR);
        $stm->execute();

        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        return is_array($result) ? $this->createMatriculaFromArray($result) : null;
    }

    public function findAll() : array
    {
        $stm = $this->pdo->prepare('
            SELECT
                matriculas.id           AS id,
                matriculas.id_aluno     AS id_aluno,
                alunos.nome             AS nome_aluno,
                matriculas.id_classe    AS id_classe,
                \'Nome da classe fake\' AS nome_classe,
                matriculas.status       AS status,
                matriculas.data         AS data_matricula

            FROM
                matriculas
            
            INNER JOIN
                alunos
                    ON matriculas.id_aluno = alunos.id
        ');

        $stm->execute();

        $arrMatriculas = $stm->fetchAll(\PDO::FETCH_ASSOC);

        $retorno = \array_map(function (array $arrMatricula) {
            return $this->createMatriculaFromArray($arrMatricula);
        }, $arrMatriculas);

        return $retorno;
    }

    private function createMatriculaFromArray(array $result) : Matricula
    {
        return Matricula::populate($result); // Isso não precisa quando usamos ORM.
    }
}
