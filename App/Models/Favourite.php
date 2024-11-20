<?php

namespace App\Models;

use App\Core\Model;

class Favourite extends Model
{
    protected ?int $id = null;
    protected ?string $autor = null;
    protected ?int $id_postu = null;
    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): void
    {
        $this->autor = $autor;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdPostu(): ?int
    {
        return $this->id_postu;
    }

    public function setIdPostu(?int $id_postu): void
    {
        $this->id_postu = $id_postu;
    }

}