<?php

class Thematique
{
    private $id;
    private $libelle;
    private $description;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Setters (si nécessaire)
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}

?>
