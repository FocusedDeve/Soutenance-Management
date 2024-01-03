<?php

class Memoire
{
    private $id;
    private $titre;
    private $resume;
    private $etudiant_id;

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

    public function getTitre()
    {
        return $this->titre;
    }

    public function getResume()
    {
        return $this->resume;
    }

    public function getEtudiantId()
    {
        return $this->etudiant_id;
    }

    // Setters (si nécessaire)
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    public function setEtudiantId($etudiant_id)
    {
        $this->etudiant_id = $etudiant_id;
    }
}


?>
