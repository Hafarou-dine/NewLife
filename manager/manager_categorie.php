<?php
    class ManagerCategorie extends Categorie{
        /*------------------------------ METHODES ------------------------------*/
        /**
         * Fonction qui renvoi la liste de tous les enregistrements de la table categorie
         */
        public function findAllCategorie($bdd)
        {
            try{
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_cat, nom_cat FROM categorie
                ORDER BY nom_cat ASC;');
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