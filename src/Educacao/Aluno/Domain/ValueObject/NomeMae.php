<?php

namespace Acruxx\Educacao\Aluno\Domain\ValueObject;

use Assert\Assertion;

final class NomeMae
{
    private $nomeMae;

    private function __construct()
    {

    }


    public function toString() : string
    {
        return $this->nomeMae;
    }

    
    public static function fromString(string $nomeMae) : self
    {
        Assertion::string($nomeMae);
        Assertion::notBlank($nomeMae);
        Assertion::minLength($nomeMae, 3);
        Assertion::maxLength($nomeMae, 100);

        $instance = new self();
        $instance->nomeMae = $nomeMae;

        return $instance;
    }
}
