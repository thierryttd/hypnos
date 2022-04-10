<?php
class Hotel
{
    protected int $id;
    protected string $name;
    protected string $city;
    protected string $zipcode;
    protected string $street;
    protected string $streetnumber;
    protected string $description;
    protected int $manager;
    
    public function findId($pdo, int $id){
        $sql = "SELECT * FROM hotels WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            $hotels = $stmt->fetch();
            return $this->hydrate($hotels);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findByManager($pdo, int $id){
        $sql = "SELECT * FROM hotels WHERE manager = :manager";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':manager', $id);
        try {
            $stmt->execute();
            $hotels = $stmt->fetchAll();
            if (!is_bool($hotels)){
                return $hotels;
            }else{
                $response = "Aucun hotel ne vous est assigné.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findAll($pdo){
        $sql = "SELECT * FROM hotels";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute();
            $hotels = $stmt->fetchAll();
            if (!is_bool($hotels)){
                return $hotels;
            }else{
                $response = "Aucun hotel trouvé.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function create($pdo){
        $sql = "INSERT INTO hotels (name, city, zipcode, street, streetnumber, description, manager)".
        " VALUES (?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, htmlspecialchars($this->name));
        $stmt->bindValue(2, htmlspecialchars($this->city));
        $stmt->bindValue(3, $this->zipcode);
        $stmt->bindValue(4, htmlspecialchars($this->street));
        $stmt->bindValue(5, $this->streetnumber);
        $stmt->bindValue(6, htmlspecialchars($this->description));
        $stmt->bindValue(7, $this->manager);
        try {
            $stmt->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function update($pdo, int $id){
        $sqlSet = 'UPDATE hotels SET name = :name, city = :city, zipcode = :zipcode, street = :street, 
        streetnumber = :streetnumber, description = :description, manager = :manager ';
        $sqlWhere = 'WHERE id = :id ';
        $sql = $sqlSet . $sqlWhere;     
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', htmlspecialchars($this->name));
        $stmt->bindValue(':city', htmlspecialchars($this->city));
        $stmt->bindValue(':zipcode', htmlspecialchars($this->zipcode));
        $stmt->bindValue(':street', htmlspecialchars($this->street));
        $stmt->bindValue(':streetnumber', htmlspecialchars($this->streetnumber));
        $stmt->bindValue(':description', htmlspecialchars($this->description));
        $stmt->bindValue(':manager', htmlspecialchars($this->manager));
        try {
            $stmt->execute();
            return $this;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function delete($pdo, $id){
        $sql = "DELETE from hotels WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function hydrate(array $donnees) {
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
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of zipcode
     */ 
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set the value of zipcode
     *
     * @return  self
     */ 
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return  self
     */ 
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of streetnumber
     */ 
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * Set the value of streetnumber
     *
     * @return  self
     */ 
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of manager
     */ 
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set the value of manager
     *
     * @return  self
     */ 
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }
}