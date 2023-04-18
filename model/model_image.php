<?php
    class Image{
        /*------------------------------ ATTRIBUTS ------------------------------*/
        private int $id_img;
        private string $nom_img;
        private string $url_img;
        private int $id_ann;


        /*------------------------------ CONSTRUCTEUR ------------------------------*/
        public function __construct(){}


        /*------------------------------ GETTERS & SETTERS ------------------------------*/
        /**
         * Get the value of id_img
         */ 
        public function getIdImg():?int
        {
            return $this->id_img;
        }

        /**
         * Set the value of id_img
         *
         * @return  self
         */ 
        public function setIdImg(?int $id_img):self
        {
            $this->id_img = $id_img;
            return $this;
        }

        /**
         * Get the value of nom_img
         */ 
        public function getNomImg():?string
        {
            return $this->nom_img;
        }

        /**
         * Set the value of nom_img
         *
         * @return  self
         */ 
        public function setNomImg(?string $nom_img):self
        {
            $this->nom_img = $nom_img;
            return $this;
        }

        /**
         * Get the value of url_img
         */ 
        public function getUrlImg():?string
        {
            return $this->url_img;
        }

        /**
         * Set the value of url_img
         *
         * @return  self
         */ 
        public function setUrlImg(?string $url_img):self
        {
            $this->url_img = $url_img;
            return $this;
        }

        /**
         * Get the value of id_ann
         */ 
        public function getIdAnn():?int
        {
            return $this->id_ann;
        }

        /**
         * Set the value of id_ann
         *
         * @return  self
         */ 
        public function setIdAnn(?int $id_ann):self
        {
            $this->id_ann = $id_ann;
            return $this;
        }
    }
?>