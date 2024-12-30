<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected ?int $id = null;
    protected ?string $meno;
    protected ?string $heslo;
    protected ?int $admin;

    public function getAdmin(): ?int
    {
        return $this->admin;
    }

    public function setAdmin(?int $admin): void
    {
        $this->admin = $admin;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeno(): ?string
    {
        return $this->meno;
    }

    public function setMeno(?string $meno): void
    {
        $this->meno = $meno;
    }

    public function getHeslo(): ?string
    {
        return $this->heslo;
    }

    public function setHeslo(?string $heslo): void
    {
        $this->heslo = $heslo;
    }
}