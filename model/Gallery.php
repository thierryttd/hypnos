<?php
class Gallery
{
    protected int $id;
    protected string $source;
    protected string $suite;
    
    public function findId($pdo, int $id){
        $sql = "SELECT * FROM galleries WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        try {
            $stmt->execute();
            $galleries = $stmt->fetch();
            return $this->hydrate($galleries);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findIn($pdo, $in){
        $sql = "SELECT * FROM galleries WHERE id in " . $in;
        $stmt = $pdo->prepare($sql);
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
        $sql = "SELECT * FROM galleries";
        $stmt = $pdo->prepare($sql);
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

    public function findBySuite($pdo, int $id){
        $sql = "SELECT * FROM galleries WHERE suite = :suite";
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

    public function create($pdo){
        $sql = "INSERT INTO galleries (source, suite)".
        " VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $this->source);
        $stmt->bindValue(2, $this->suite);
        try {
            $stmt->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function delete($pdo, $in){
        $sql = "DELETE FROM galleries WHERE id in " . $in;
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function deleteBySuite($pdo, $suite){
        $sql = "DELETE FROM galleries WHERE suite = :suite";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':suite', $suite);
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
     * Get the value of source
     */ 
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set the value of source
     *
     * @return  self
     */ 
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get the value of suite
     */ 
    public function getSuite()
    {
        return $this->suite;
    }

    /**
     * Set the value of suite
     *
     * @return  self
     */ 
    public function setSuite($suite)
    {
        $this->suite = $suite;

        return $this;
    }
}