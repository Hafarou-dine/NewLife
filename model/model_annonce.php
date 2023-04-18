<?php
    class Annonce{
        /*------------------------------ ATTRIBUTS ------------------------------*/
        private int $id_ann;
        private string $titre_ann;
        private string $descr_ann;
        private float $prix_ann;
        private string $date_ann;
        private bool $negociable;
        private bool $livraison;
        private bool $vendu;
        private bool $visible_ann;
        private int $id_util;
        private int $id_cat;
        private int $id_dep;

        
        /*------------------------------ CONSTRUCTEUR ------------------------------*/
        public function __construct(){}


        /*------------------------------ GETTERS & SETTERS ------------------------------*/
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

        /**
         * Get the value of titre_ann
         */ 
        public function getTitreAnn():?string
        {
            return $this->titre_ann;
        }

        /**
         * Set the value of titre_ann
         *
         * @return  self
         */ 
        public function setTitreAnn(?string $titre_ann):self
        {
            $this->titre_ann = $titre_ann;
            return $this;
        }

        /**
         * Get the value of descr_ann
         */ 
        public function getDescrAnn():?string
        {
            return $this->descr_ann;
        }

        /**
         * Set the value of descr_ann
         *
         * @return  self
         */ 
        public function setDescrAnn(?string $descr_ann):self
        {
            $this->descr_ann = $descr_ann;
            return $this;
        }

        /**
         * Get the value of prix_ann
         */ 
        public function getPrixAnn():?float
        {
            return $this->prix_ann;
        }

        /**
         * Set the value of prix_ann
         *
         * @return  self
         */ 
        public function setPrixAnn(?float $prix_ann):self
        {
            $this->prix_ann = $prix_ann;
            return $this;
        }

        /**
         * Get the value of date_ann
         */ 
        public function getDateAnn():?string
        {
            return $this->date_ann;
        }

        /**
         * Set the value of date_ann
         *
         * @return  self
         */ 
        public function setDateAnn(?string $date_ann):self
        {
            $this->date_ann = $date_ann;
            return $this;
        }

        /**
         * Get the value of negociable
         */ 
        public function getNegociable():?bool
        {
            return $this->negociable;
        }

        /**
         * Set the value of negociable
         *
         * @return  self
         */ 
        public function setNegociable(?bool $negociable):self
        {
            $this->negociable = $negociable;
            return $this;
        }

        /**
         * Get the value of livraison
         */ 
        public function getLivraison():?bool
        {
            return $this->livraison;
        }

        /**
         * Set the value of livraison
         *
         * @return  self
         */ 
        public function setLivraison(?bool $livraison):self
        {
            $this->livraison = $livraison;
            return $this;
        }

        /**
         * Get the value of vendu
         */ 
        public function getVendu():?bool
        {
            return $this->vendu;
        }

        /**
         * Set the value of vendu
         *
         * @return  self
         */ 
        public function setVendu(?bool $vendu):self
        {
            $this->vendu = $vendu;
            return $this;
        }

        /**
         * Get the value of visible_ann
         */ 
        public function getVisibleAnn():?bool
        {
            return $this->visible_ann;
        }

        /**
         * Set the value of visible_ann
         *
         * @return  self
         */ 
        public function setVisibleAnn(?bool $visible_ann):self
        {
            $this->visible_ann = $visible_ann;
            return $this;
        }

        /**
         * Get the value of id_util
         */ 
        public function getIdUtil():?int
        {
            return $this->id_util;
        }

        /**
         * Set the value of id_util
         *
         * @return  self
         */ 
        public function setIdUtil(?int $id_util):self
        {
            $this->id_util = $id_util;
            return $this;
        }

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
    }
?>