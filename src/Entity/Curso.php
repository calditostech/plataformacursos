<?php

namespace Edsonmaia\Cursos\Entity;

/**
 * @Entity
 */
class Curso implements \JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private int $id;

    /**
     * @Column(type="string")
    */
    private string $nomeCurso;

    /**
     * @Column(type="integer")
    */
    private int $ch;

    public function getId(): int
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getNomeCurso(): string
    {
        return $this->nomeCurso;
    }

    public function setNomeCurso($nome): void
    {
        $this->nomeCurso = $nome;
    }

    public function getCh(): int
    {
        return $this->ch;
    }

    public function setCh($ch): void
    {
        $this->ch = $ch;
    }

    public function jsonSerialize()
    {
    return [
        'id' => $this->id,
        'nomeCurso' => $this->nomeCurso,
        'ch' => $this->ch
    ];
    }

}
