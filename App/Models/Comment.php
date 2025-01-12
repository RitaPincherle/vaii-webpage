<?php

namespace App\Models;

use App\Core\Model;

class Comment extends Model
{
    protected ?int $id = null;
    protected ?int $id_postu = null;
    protected ?string $autor = null;
    protected ?string $text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPostu(): ?int
    {
        return $this->id_postu;
    }

    public function setIdPostu(?int $id_postu): void
    {
        $this->id_postu = $id_postu;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): void
    {
        $this->autor = $autor;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }
}
