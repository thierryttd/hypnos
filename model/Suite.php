<?php
class Suite
{
    protected int $id;
    protected string $title;
    protected string $featured;
    protected string $description;
    protected string $price;
    protected string $linkbooking;
    protected string $hotel;
    protected int $manager;
    
    public function findId($pdo, int $id){
        $sql = "SELECT * FROM suites WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            $suites = $stmt->fetch();
            return $this->hydrate($suites);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findByHotel($pdo, int $id){
        $sql = "SELECT * FROM suites WHERE hotel = :hotel";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':hotel', $id);
        try {
            $stmt->execute();
            $hotels = $stmt->fetchAll();
            if (!is_bool($hotels)){
                return $hotels;
            }else{
                $response = "Aucune suite dans cet hotel.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findGalleries($pdo, int $id){
        $sql = "SELECT * FROM suites INNER JOIN galleries ON suites.id = galleries.suite WHERE suite = :suite";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':suite', $id);
        try {
            $stmt->execute();
            $galleries = $stmt->fetchAll();
            if (!is_bool($galleries)){
                return $galleries;
            }else{
                $response = "Aucune image trouvée.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findAll($pdo){
        $sql = "SELECT * FROM suites";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute();
            $hotels = $stmt->fetchAll();
            if (!is_bool($hotels)){
                return $hotels;
            }else{
                $response = "Aucune suite trouvée.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function create($pdo){
        $sql = "INSERT INTO suites (title, featured, description, price, linkbooking, hotel)".
        " VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, htmlspecialchars($this->title));
        $stmt->bindValue(2, htmlspecialchars($this->featured));
        $stmt->bindValue(3, htmlspecialchars($this->description));
        $stmt->bindValue(4, $this->price);
        $stmt->bindValue(5, htmlspecialchars($this->linkbooking));
        $stmt->bindValue(6, $this->hotel);
        try {
            $stmt->execute();
            return $pdo->lastInsertId();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function update($pdo, int $id){
        $sqlSet = 'UPDATE suites SET title = :title, featured = :featured, description = :description, price = :price, 
        linkbooking = :linkbooking, hotel = :hotel ';
        $sqlWhere = 'WHERE id = :id ';
        $sql = $sqlSet . $sqlWhere;     
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':title', htmlspecialchars($this->title));
        $stmt->bindValue(':featured', htmlspecialchars($this->featured));
        $stmt->bindValue(':description', htmlspecialchars($this->description));
        $stmt->bindValue(':price', $this->price);
        $stmt->bindValue(':linkbooking', htmlspecialchars($this->linkbooking));
        $stmt->bindValue(':hotel', $this->hotel);
        try {
            $stmt->execute();
            return $this;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function delete($pdo, $id){
        $sql = "DELETE from suites WHERE id = :id";
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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of featured
     */ 
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set the value of featured
     *
     * @return  self
     */ 
    public function setFeatured($featured)
    {
        $this->featured = $featured;

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
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of linkbooking
     */ 
    public function getLinkbooking()
    {
        return $this->linkbooking;
    }

    /**
     * Set the value of linkbooking
     *
     * @return  self
     */ 
    public function setLinkbooking($linkbooking)
    {
        $this->linkbooking = $linkbooking;

        return $this;
    }

    /**
     * Get the value of hotel
     */ 
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set the value of hotel
     *
     * @return  self
     */ 
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;

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