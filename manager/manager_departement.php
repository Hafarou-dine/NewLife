<?php
    class ManagerDepartement extends Departement{
        /*------------------------------ METHODES ------------------------------*/
        /**
         * Fonction qui renvoi la liste de tous les enregistrements de la table departements
         */
        public function findAllDepartement($bdd)
        {
            try{
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_dep, numero_dep, nom_dep
                FROM departement;');
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