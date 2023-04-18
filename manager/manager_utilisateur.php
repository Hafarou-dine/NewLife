<?php
    class ManagerUtilisateur extends Utilisateur{
        /*------------------------------ METHODES ------------------------------*/
        /**
         * Fonction qui permet d'ajouter un utilisateur
         */
        public function addUtil($bdd)
        {
            try{
                // on stock les attributs de l'objet dans des variables
                $nom  = $this->getNomUtil();
                $mail = $this->getMailUtil();
                $mdp = $this->getMdpUtil();
                $token = $this->getTokenUtil();
                // on prépare la requête
                $req = $bdd->prepare('INSERT INTO utilisateur(nom_util, mail_util, mdp_util, 
                token_util) VALUES(?, ?, ?, ?);');
                // on bind les paramètres
                $req->bindParam(1, $nom, PDO::PARAM_STR);
                $req->bindParam(2, $mail, PDO::PARAM_STR);
                $req->bindParam(3, $mdp, PDO::PARAM_STR);
                $req->bindParam(4, $token, PDO::PARAM_STR);
                // on execute la requête
                $req->execute();
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }


        /**
         * Fonction qui recupère un utilisateur en fonction de son identifiant
         * Sur les compte actifs
         */
        public function findUtilById($bdd)
        {
            try{
                // on stock l'attibut id_util de l'objet dans une variable
                $id = $this->getIdUtil();
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_util, nom_util, mail_util, mdp_util, 
                token_util, valide_util, id_droit FROM utilisateur 
                WHERE id_util = ? AND active_util = 1;');
                // on bind les paramètres
                $req->bindParam(1, $id, PDO::PARAM_INT);
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
         * Fonction qui recupère un utilisateur en fonction de son mail
         * Sur les compte actifs
         */
        public function findUtilByMail($bdd)
        {
            try{
                // on stock l'attibut mail_util de l'objet dans une variable
                $mail = $this->getMailUtil();
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_util, nom_util, mail_util, mdp_util, 
                token_util, valide_util, id_droit FROM utilisateur 
                WHERE mail_util = ? AND active_util = 1;');
                // on bind les paramètres
                $req->bindParam(1, $mail, PDO::PARAM_STR);
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
         * Fonction qui recupère un utilisateur en fonction de son token
         * Sur les compte actifs
         */
        public function findUtilByToken($bdd)
        {
            try{
                // on stock l'attibut token_util de l'objet dans une variable
                $token = $this->getTokenUtil();
                // on prépare la requête
                $req = $bdd->prepare('SELECT id_util, nom_util, mail_util, mdp_util, 
                token_util, valide_util, id_droit FROM utilisateur 
                WHERE token_util = ? AND active_util = 1;');
                // on bind les paramètres
                $req->bindParam(1, $token, PDO::PARAM_STR);
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
         * Fonction  qui permet de verifier un mail
         */
        public function checkMailUtil($bdd)
        {
            try{
                // on stock l'attribut token_util de l'objet dans une variable
                $token = $this->getTokenUtil();
                // on préapre la requête
                $req = $bdd->prepare('UPDATE utilisateur SET valide_util = 1
                WHERE token_util = ?;');
                // on bind les paramètres
                $req->bindParam(1, $token, PDO::PARAM_STR);
                // on execute la requête
                $req->execute();
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }

        
        /**
         * Fonction qui permet de modifier son mot de passe
         */
        public function updatePwdUtil($bdd)
        {
            try{
                // on stock les attributs mdp_util et id_util de l'objet dans des variable
                $mdp = $this->getMdpUtil();
                $id = $this->getIdUtil();
                // on préapre la requête
                $req = $bdd->prepare('UPDATE utilisateur SET mdp_util = ? 
                WHERE id_util = ?;');
                // on bind les paramètres
                $req->bindParam(1, $mdp, PDO::PARAM_STR);
                $req->bindParam(2, $id, PDO::PARAM_INT);
                // on execute la requête
                $req->execute();
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }

        
        /**
         * Fonction qui permet de modifier le profil d'utilisateur
         */
        public function updateUtil($bdd)
        {
            try{
                // on stock les attributs de l'objet dans des variable
                $nom = $this->getNomUtil();
                $mail = $this->getMailUtil();
                $token = $this->getTokenUtil();
                $id = $this->getIdUtil();
                // on préapre la requête
                $req = $bdd->prepare('UPDATE utilisateur 
                SET nom_util = ?, mail_util = ?, token_util = ?
                WHERE id_util = ?;');
                // on bind les paramètres
                $req->bindParam(1, $nom, PDO::PARAM_STR);
                $req->bindParam(2, $mail, PDO::PARAM_STR);
                $req->bindParam(3, $token, PDO::PARAM_STR);
                $req->bindParam(4, $id, PDO::PARAM_INT);
                // on execute la requête
                $req->execute();
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }


        /**
         * Fonction qui permet de résilier un compte utilisateur
         * Mise à jour de l'attribut active_util
         */
        public function resilierUtil($bdd)
        {
            try{
                // on stock l'id_util de l'objet dans une variable
                $id = $this->getIdUtil();
                // on prépare la requête
                $req = $bdd->prepare('UPDATE utilisateur SET active_util = 0
                WHERE id_util = ?;');
                // on bind les paramètres
                $req->bindParam(1, $id, PDO::PARAM_INT);
                // on execute la requête
                $req->execute();
            }
            catch(Exception $e){
                // on affiche le message de l'exception
                die('Erreur : '.$e->getMessage());
            }
        }

    }
?>