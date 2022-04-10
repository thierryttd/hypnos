<?php
class Booking
{
    protected int $user_id;
    protected int $suite_id;
    protected $begin;
    protected $end;
    protected float $bill;
    
    public function findOccupied($pdo, $first, $last){
        $sql = "SELECT suite_id FROM bookings WHERE end >= :first AND  begin <= :last GROUP BY suite_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':first', $first);
        $stmt->bindValue(':last', $last);
        try {
            $stmt->execute();
            $bookings = $stmt->fetchAll();
            if (!is_bool($bookings)){
                return $bookings;
            }else{
                $response = "Aucune suite disponible trouvée.";
                return $response;
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function findUpcoming($pdo, $suite, $marker){
        $sql = "SELECT suite_id FROM bookings WHERE suite_id = :suite AND end >= :marker";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':suite', $suite);
        $stmt->bindValue(':marker', $marker);
        try {
            $stmt->execute();
            $bookings = $stmt->fetchAll();
            return $bookings;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function create($pdo){
        $sql = "INSERT INTO bookings (user_id, suite_id, begin, end, bill) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $this->user_id);
        $stmt->bindValue(2, $this->suite_id);
        $stmt->bindValue(3, $this->begin);
        $stmt->bindValue(4, $this->end);
        $stmt->bindValue(5, $this->bill);
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
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of suite_id
     */ 
    public function getSuite_id()
    {
        return $this->suite_id;
    }

    /**
     * Set the value of suite_id
     *
     * @return  self
     */ 
    public function setSuite_id($suite_id)
    {
        $this->suite_id = $suite_id;

        return $this;
    }

    /**
     * Get the value of begin
     */ 
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set the value of begin
     *
     * @return  self
     */ 
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get the value of end
     */ 
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @return  self
     */ 
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get the value of bill
     */ 
    public function getBill()
    {
        return $this->bill;
    }

    /**
     * Set the value of bill
     *
     * @return  self
     */ 
    public function setBill($bill)
    {
        $this->bill = $bill;

        return $this;
    }
}