<?php
    class ManagerAnnonce extends Annonce{
        /*------------------------------ METHODES ------------------------------*/
        /**
         * Fonction qui permet d'ajouter une annonce
         */
        public function addAnnonce($bdd)
        {
            try{
                // on stock les attributs de l'objet dans des variables
                $titre = $this->getTitreAnn();
                $descr = $this->getDescrAnn();
                $prix = $this->getPrixAnn();
                $date = $this->getDateAnn();
                $negociable = $this->getNegociable();
                $livraison = $this->getLivraison();
                $util = $this->getIdUtil();
                $cat = $this->getIdCat();
                $dep = $this->getIdDep();
                // on prépare la requête
                $req = $bdd->prepare('INSERT INTO annonce(titre_ann, descr_ann, prix_ann, 
                date_ann, negociable, livraison, id_util, id_cat, id_dep)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);');
                // on bind les variables
                $req->bindparam(1, $titre, PDO::PARAM_STR);
                $req->bindparam(2, $descr, PDO::PARAM_STR);
                $req->bindparam(3, $prix, PDO::PARAM_STR);
                $req->bindparam(4, $date, PDO::PARAM_STR);
                $req->bindparam(5, $negociable, PDO::PARAM_BOOL);
                $req->bindparam(6, $livraison, PDO::PARAM_BOOL);
                $req->bindparam(7, $util, PDO::PARAM_INT);
                $req->bindparam(8, $cat, PDO::PARAM_INT);
                $req->bindparam(9, $dep, PDO::PARAM_INT);
                // On execute la requête
                $req->execute();                
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }

        /**
         * Fonction qui permet de modifier une annonce
         */
        public function updateAnnonce($bdd)
        {
            try{
                // on stock les attributs de l'objet dans des variables
                $id = $this->getIdAnn();
                $titre = $this->getTitreAnn();
                $descr = $this->getDescrAnn();
                $prix = $this->getPrixAnn();
                $negociable = $this->getNegociable();
                $livraison = $this->getLivraison();
                $vendu = $this->getVendu();
                $cat = $this->getIdCat();
                $dep = $this->getIdDep();
                // on prépare la requête
                $req = $bdd->prepare('UPDATE annonce 
                SET titre_ann = ?, descr_ann = ?, prix_ann = ?, negociable = ?, 
                livraison = ?, vendu = ?, id_cat = ?, id_dep = ?
                WHERE id_ann = ?;');
                // on bind les variables
                $req->bindparam(1, $titre, PDO::PARAM_STR);
                $req->bindparam(2, $descr, PDO::PARAM_STR);
                $req->bindparam(3, $prix, PDO::PARAM_STR);
                $req->bindparam(4, $negociable, PDO::PARAM_BOOL);
                $req->bindparam(5, $livraison, PDO::PARAM_BOOL);
                $req->bindparam(6, $vendu, PDO::PARAM_BOOL);
                $req->bindparam(7, $cat, PDO::PARAM_INT);
                $req->bindparam(8, $dep, PDO::PARAM_INT);
                $req->bindparam(9, $id, PDO::PARAM_INT);
                // On execute la requête
                $req->execute();                
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }


        /**
         * Fonction qui permet de recuperer une annonce visible en fonction son identifiant
         */
        public function findAnnonceById($bdd)
        {
            try{
                // on stock l'attributs id_ann de l'objet dans une variable
                $id = $this->getIdAnn();
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_ann, titre_ann, prix_ann, descr_ann, date_ann,
                negociable, livraison, vendu, id_util, id_cat, id_dep
                FROM annonce 
                WHERE visible_ann = 1
                AND id_ann = ?;');
                // on bind les paramètres
                $req->bindparam(1, $id, PDO::PARAM_INT);
                // on execute la requête
                $req->execute();
                // on renvoie le resultat de la requête sous forme d'un tableau d'objets 
                return $req->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }

        
        /**
         * Fonction qui permet de recuperer la liste des annonce visible en fonction de l'id_util
         * Afficher la liste des annonces d'un utilisateur 
         */
        public function findAnnonceByUtil($bdd)
        {
            try{
                // on stock l'attributs id_util de l'objet dans une variable
                $util = $this->getIdUtil();
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_ann, titre_ann, prix_ann, descr_ann, date_ann,
                negociable, livraison, vendu, id_util, id_cat, id_dep
                FROM annonce 
                WHERE visible_ann = 1
                AND id_util = ?;');
                // on bind les paramètres
                $req->bindparam(1, $util, PDO::PARAM_INT);
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
        

        /**
         * Fonction qui permet de recuperer une annonce par son titre_ann, date_ann et id_util  
         */
        public function findAnnonceByCriteres($bdd):?object
        {
            try{
                // on stock le titre_ann, la date_ann et l'id_util de l'objet dans des variables
                $titre = $this->getTitreAnn();
                $date = $this->getDateAnn();
                $util = $this->getIdUtil();
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_ann FROM annonce
                WHERE titre_ann = ? AND  date_ann = ? AND id_util = ?;');
                // on bind les paramètres
                $req->bindparam(1, $titre, PDO::PARAM_STR);
                $req->bindparam(2, $date, PDO::PARAM_STR);
                $req->bindparam(3, $util, PDO::PARAM_INT);
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
          * Fonction qui permet de rendre une annonce non visible en fonction de son identifiant
          * Utilisateur supprime une annonce de sa liste
          */
        public function setAnnonceToNotVisible($bdd):void
        {
            try{
                // on stock l'attribut id_ann de l'objet dans une variable
                $id = $this->getIdAnn();
                // on prépare la requête
                $req = $bdd->prepare('UPDATE annonce 
                SET visible_ann = 0 WHERE id_ann = ?;');
                // on bind les variables
                $req->bindparam(1, $id, PDO::PARAM_INT);
                // On execute la requête
                $req->execute();            
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }

    }
?>