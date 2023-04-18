<?php
    class ManagerImage extends Image{
        /*------------------------------ METHODES ------------------------------*/
        /**
         * Fonction qui permet d'ajouter une image
         */
        public function addImage($bdd)
        {
            try{
                // on stock les attributs de l'objet dans des variables
                $nom = $this->getNomImg();
                $url = $this->getUrlImg();
                $idAnn = $this->getIdAnn();
                // on prepare la requête
                $req = $bdd->prepare('INSERT INTO image(nom_img, url_img, id_ann) 
                VALUES(?, ?, ?);');
                // on bind les paramètres
                $req->bindparam(1, $nom, PDO::PARAM_STR);
                $req->bindparam(2, $url, PDO::PARAM_STR);
                $req->bindparam(3, $idAnn, PDO::PARAM_INT);
                // on execute la reqêute
                $req->execute();
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }


        /**
         * Fonction qui renvoie une image en fonction de son nom
         */
        public function findImageByName($bdd)
        {
            try{
                // on stock l'attribut nom_img de l'objet dans une variable
                $nom = $this->getNomImg();
                // on prepare la requête
                $req = $bdd->prepare('SELECT id_img, nom_img, url_img 
                FROM image WHERE nom_img = ?;');
                // on bind les paramètres
                $req->bindparam(1, $nom, PDO::PARAM_STR);
                // on execute la requête
                $req->execute();
                // on renvoie le resultat de la requête sous forme d'un objet
                return $req->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }


        /**
         * Fonction qui renvoie une liste d'image en fonction de l'identifiant de l'annonce 
         */
        public function findImageByAnnonce($bdd)
        {
            try{
                // on stock l'id_ann de l'objet dans une variable 
                $idAnn = $this->getIdAnn();
                // on prepare la requête
                $req = $bdd->prepare('SELECT id_img, nom_img, url_img
                FROM image WHERE id_ann = ?;');
                // on bind les paramètres
                $req->bindparam(1, $idAnn, PDO::PARAM_INT);
                // on execute la requête
                $req->execute();
                // on renvoie le resultat de la requête sous forme d'un tableau d'objets
                return $req->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }
        
    }
?>