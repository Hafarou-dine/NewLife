<?php
    class Categorie{
        /*------------------------------ ATTRIBUTS ------------------------------*/
        private int $id_cat;
        private string $nom_cat;


        /*------------------------------ CONSTRUCTEUR ------------------------------*/
        public function __construct(){}


        /*------------------------------ GETTERS & SETTERS ------------------------------*/
        /**
         * Get the value of id_cat
         */ 
        public function getIdCat():?int
        {
            return $this->id_cat;
        }

        /**
         * Set the value of id_cat
         *
         * @return  self
         */ 
        public function setIdCat(?int $id_cat):self
        {
            $this->id_cat = $id_cat;
            return $this;
        }

        /**
         * Get the value of nom_cat
         */ 
        public function getNomCat():?string
        {
            return $this->nom_cat;
        }

        /**
         * Set the value of nom_cat
         *
         * @return  self
         */ 
        public function setNomCat(?string $nom_cat):self
        {
            $this->nom_cat = $nom_cat;
            return $this;
        }
    }
?>