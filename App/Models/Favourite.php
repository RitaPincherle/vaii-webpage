<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Favourite extends Model
{
    protected ?int $id = null;
    protected ?string $id_autor = null;
    protected ?int $id_postu = null;
    public function getIdAutor(): ?string
    {
        return $this->id_autor;
    }

    public function setIdAutor(?string $autor): void
    {
        $this->id_autor = $autor;
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

    /**
     * @throws Exception
     */
    public function getFavourites(?string $autor): array
    {
        return Favourite::getAll("id_autor =?", [$autor]);
    }

}