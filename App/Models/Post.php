<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected ?int $id = null;
    protected ?string $nazov;
    protected ?string $text;
    protected ?string $autor = null;
    protected ?string $obrazok;
    protected ?int $typ_postu;
    protected ?int $rating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazov(): ?string
    {
        return $this->nazov;
    }

    public function setNazov(?string $nazov): void
    {
        $this->nazov = $nazov;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): void
    {
        $this->autor = $autor;
    }

    public function getObrazok(): ?string
    {
        return $this->obrazok;
    }

    public function setObrazok(?string $obrazok): void
    {
        $this->obrazok = $obrazok;
    }

    public function getTypPostu(): ?int
    {
        return $this->typ_postu;
    }

    public function setTypPostu(?int $typ_postu): void
    {
        $this->typ_postu = $typ_postu;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

}
