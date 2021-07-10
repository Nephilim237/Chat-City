<?php
namespace Chat\Model;

use Chat\DatabaseConnexion;
use PDO;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $profile;
    private $status;
    private $created_at;
    private $token;
    private $login_status;

    public \PDO $db;

    public function __construct()
    {
        $this->db = (new DatabaseConnexion())->getDB();
    }

    /**
     * @return bool Insère un nouvel utilisateur en base des données et renvoie true en cas de succès et false dans le cas contraire
     */
    public function saveData(): bool
    {
        $this->db->beginTransaction();
        $q = $this->db->prepare("INSERT INTO user (name, email, password, profile, status, created_at, token, login_status) VALUES (:name, :email, :password, :profile, :status, :created_at, :token, :login_status)");
        $q->execute([
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => $this->password,
            'profile'       => $this->profile,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'token'         => $this->token,
            'login_status'  => $this->login_status
        ]);
        $status = $this->db->commit();

        if($status) {
            return true;
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public function getAllEmails() {
        $q = $this->db->prepare("SELECT email FROM user");
        $q->setFetchMode(PDO::FETCH_CLASS, User::class);
        $q->execute();

        return $q->fetchAll();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return User
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     *
     * @return User
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return User
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     *
     * @return User
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLoginStatus()
    {
        return $this->login_status;
    }

    /**
     * @param mixed $login_status
     *
     * @return User
     */
    public function setLoginStatus($login_status)
    {
        $this->login_status = $login_status;
        return $this;
    }


}