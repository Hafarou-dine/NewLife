<?php
    class Departement{
        /*------------------------------ ATTRIBUTS ------------------------------*/
        private int $id_dep;
        private string $numero_dep;
        private string $nom_dep;
        


        /*------------------------------ CONSTRUCTEUR ------------------------------*/
        public function __construct(){}


        /*------------------------------ GETTERS & SETTERS ------------------------------*/
        /**
         * Get the value of id_dep
         */ 
        public function getIdDep():?int
        {
            return $this->id_dep;
        }

        /**
         * Set the value of id_dep
         *
         * @return  self
         */ 
        public function setIdDep(?int $id_dep):self
        {
            $this->id_dep = $id_dep;
            return $this;
        }

        /**
         * Get the value of numero_dep
         */ 
        public function getNumeroDep():?string
        {
            return $this->numero_dep;
        }

        /**
         * Set the value of numero_dep
         *
         * @return  self
         */ 
        public function setNumeroDep(?string $numero_dep):self
        {
            $this->numero_dep = $numero_dep;
            return $this;
        }

        /**
         * Get the value of nom_dep
         */ 
        public function getNomDep():?string
        {
            return $this->nom_dep;
        }

        /**
         * Set the value of nom_dep
         *
         * @return  self
         */ 
        public function setNomDep(?string $nom_dep):self
        {
            $this->nom_dep = $nom_dep;
            return $this;
        }
    }
?>