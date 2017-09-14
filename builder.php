<?php

/**
 * Builder PHP design pattern example.
 *
 * @author Rafał Toborek (https://github.com/clash82)
 * @see http://en.wikipedia.org/wiki/Builder_pattern
 */

class User
{
    protected $firstName,
              $lastName,
              $userName,
              $email;

    public function __construct(UserBuilder $builder)
    {
        $this->firstName = $builder->getFirstName();
        $this->lastName = $builder->getLastName();
        $this->userName = $builder->getUserName();
        $this->email = $builder->getEmail();
    }

    public function printDetails()
    {
        echo sprintf('username: %s, first name: %s, last name: %s, e-mail: %s',
            $this->userName,
            $this->firstName,
            $this->lastName,
            $this->email);
    }
}

class UserBuilder
{
    private $firstName,
            $lastName,
            $userName,
            $email;

    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function build()
    {
        return new User($this);
    }
}

$user = (new UserBuilder('clash82'))
    ->setFirstName('Rafal')
    ->setLastName('Toborek')
    ->setEmail('example@example.pl')
    ->build();

// print user details for verification
$user->printDetails();
