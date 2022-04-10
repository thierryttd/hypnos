<?php
class User
{
    protected int $id;
    protected string $name;
    protected string $firstname;
    protected string $email;
    protected string $role;
    protected string $password;
    
    public function findId($pdo, int $id){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            $users = $stmt->fetch();
            return $this->hydrate($users);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findEmail($pdo, string $email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        try {
            $stmt->execute();
            $users = $stmt->fetch();
            if (!is_bool($users)){
                return $this->hydrate($users);
            }else{
                $response = "Aucun compte ne correspond à cet email.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findCriteria($pdo, string $query){
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute();
            $users = $stmt->fetchAll();
            if (!is_bool($users)){
                return $users;
            }else{
                $response = "Aucun utilisateur ne correspond à ces critères.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function create($pdo){
        $sql = "INSERT INTO users (name, firstname, email, password, role)".
        " VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, htmlspecialchars($this->name));
        $stmt->bindValue(2, htmlspecialchars($this->firstname));
        $stmt->bindValue(3, htmlspecialchars($this->email));
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindValue(4, $password);
        $stmt->bindValue(5, htmlspecialchars($this->role));
        try {
            $stmt->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function changePassword($pdo, int $id){
        $sqlSet = 'UPDATE users SET password = :password ';
        $sqlWhere = 'WHERE id = :id ';
        $sql = $sqlSet . $sqlWhere;     
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $password);
        try {
            $stmt->execute();
            return $this;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function update($pdo, int $id){
        // $sqlSet = 'UPDATE users SET name = :name, email = :email, firstname = :firstname, password = :password, role = :role ';
        $sqlSet = 'UPDATE users SET name = :name, email = :email, firstname = :firstname, role = :role ';
        $sqlWhere = 'WHERE id = :id ';
        $sql = $sqlSet . $sqlWhere;     
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', htmlspecialchars($this->name));
        $stmt->bindValue(':firstname', htmlspecialchars($this->firstname));
        $stmt->bindValue(':email', htmlspecialchars($this->email));
        $stmt->bindValue(':role', htmlspecialchars($this->role));
        try {
            $stmt->execute();
            return $this;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function hydrate(array $donnees) {
        // var_dump($donnees);
        foreach ($donnees as $key => $value) {
          // On récupère le nom du setter correspondant à l'attribut
          $method = 'set'.ucfirst($key);

          // Si le setter correspondant existe.
          if (method_exists($this, $method)) {
            // On appelle le setter
            $this->$method($value);
          }
        }
        return $this;
    }
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}