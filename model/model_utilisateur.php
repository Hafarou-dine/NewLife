<?php
    class Utilisateur{
        /*------------------------------ ATTRIBUTS ------------------------------*/
        private int $id_util;
        private string $nom_util;
        private string $mail_util;
        private string $mdp_util;
        private string $token_util;
        private bool $valide_util;
        private bool $active_util;
        private int $id_droit;


        /*------------------------------ CONSTRUCTEUR ------------------------------*/
        public function __construct(){}


        /*------------------------------ GETTERS & SETTERS ------------------------------*/
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
         * Get the value of nom_util
         */ 
        public function getNomUtil():?string
        {
            return $this->nom_util;
        }

        /**
         * Set the value of nom_util
         *
         * @return  self
         */ 
        public function setNomUtil(?string $nom_util):self
        {
            $this->nom_util = $nom_util;
            return $this;
        }

        /**
         * Get the value of mail_util
         */ 
        public function getMailUtil():?string
        {
            return $this->mail_util;
        }

        /**
         * Set the value of mail_util
         *
         * @return  self
         */ 
        public function setMailUtil(?string $mail_util):self
        {
            $this->mail_util = $mail_util;
            return $this;
        }

        /**
         * Get the value of mdp_util
         */ 
        public function getMdpUtil():?string
        {
            return $this->mdp_util;
        }

        /**
         * Set the value of mdp_util
         *
         * @return  self
         */ 
        public function setMdpUtil(?string $mdp_util):self
        {
            $this->mdp_util = $mdp_util;
            return $this;
        }

        /**
         * Get the value of token_util
         */ 
        public function getTokenUtil():?string
        {
            return $this->token_util;
        }

        /**
         * Set the value of token_util
         *
         * @return  self
         */ 
        public function setTokenUtil(?string $token_util):self
        {
            $this->token_util = $token_util;
            return $this;
        }

        /**
         * Get the value of valide_util
         */ 
        public function getValideUtil():?bool
        {
            return $this->valide_util;
        }

        /**
         * Set the value of valide_util
         *
         * @return  self
         */ 
        public function setValideUtil(?bool $valide_util):self
        {
            $this->valide_util = $valide_util;
            return $this;
        }

        /**
         * Get the value of active_util
         */ 
        public function getActiveUtil():?bool
        {
            return $this->active_util;
        }

        /**
         * Set the value of active_util
         *
         * @return  self
         */ 
        public function setActiveUtil(?bool $active_util):self
        {
            $this->active_util = $active_util;
            return $this;
        }

        /**
         * Get the value of id_droit
         */ 
        public function getIdDroit():?int
        {
            return $this->id_droit;
        }

        /**
         * Set the value of id_droit
         *
         * @return  self
         */ 
        public function setIdDroit(?int $id_droit):self
        {
            $this->id_droit = $id_droit;
            return $this;
        }
    }
?>