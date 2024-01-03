<?php

class Enseignant
{
    private $id;
    private $nom;
    private $prenom;
    private $contact;

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

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getContact()
    {
        return $this->contact;
    }

    // Setters (si nécessaire)
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
    }
}

?>
