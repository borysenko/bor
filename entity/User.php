<?php

namespace entity;

use Doctrine\ORM\Mapping as ORM;
use function bor\getRandomStringRand;


#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', unique: true)]
    private $username;

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string')]
    private $token;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $value) : void
    {
        $this->username = $value;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function getToken() : string
    {
        return $this->token;
    }

    public function setPassword(string $value) : void
    {
        $this->password = password_hash($value, PASSWORD_BCRYPT);
    }

    public function generateToken() : void
    {
        $this->token = getRandomStringRand();
    }

}