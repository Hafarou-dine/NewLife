<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './model/model_annonce.php';
    include './model/model_categorie.php';
    include './model/model_departement.php';
    include './model/model_image.php';
    include './manager/manager_annonce.php';
    include './manager/manager_categorie.php';
    include './manager/manager_departement.php';
    include './manager/manager_image.php';
    include './view/view_modifier_annonce.html';


    /*---------------------------------- LOGIQUE ----------------------------------*/
    // on verifie si l'utilisateur est connecter
    if(isset($_SESSION['connecter'])){
        /**
         * Création des options du select categorie
         */
        // on instancie un nouvel objet ManagerCategorie
        $cat = new ManagerCategorie();
        // on recupère toutes les categories
        $all = $cat->findAllCategorie($bdd);
        // traitement pour chaque categorie de la liste
        foreach($all as $one){
            echo '<script>addOptionCategorie("'.$one->nom_cat.'", "'.$one->id_cat.'")</script>';
        }

        /**
         * Création des options du select localisation 
         */
        // on instancie un nouvel objet ManagerDepartement
        $dep = new ManagerDepartement();
        // on récupère la liste de tous les départements
        $all = $dep->findAllDepartement($bdd);
        // traitement pour chaque element de la liste
        foreach($all as $one){
            echo '<script>addOptionDepartement("'.$one->nom_dep.'", "'.$one->id_dep.'")</script>';
        }

        /**
         * Prereplissage des champs
         */
        // déclaration de l'id_ann
        $id = null;
        // on vérifie si l'attribut get annonce est definit
        if(isset($_GET['annonce'])){
            // on enregistre l'id dans une varible
            $id = cleanInput($_GET['annonce']);
        } 
        // on instancie un nouvel objet ManagerAnnonce
        $ann = new ManagerAnnonce();
        // on set l'id à l'objet
        $ann->setIdAnn($id);
        // on recherche une annonce avec cet id
        $find = $ann->findAnnonceById($bdd);
        if($find){
            // on peut preremplir les champs
            // $titre = $find->titre_ann;
            // $desc = $find->descr_ann;
            // $prix = $find->prix_ann;
            // // preRemplirAnnonce("'.$titre.'", "'.$desc.'", "'.$prix.'");
            // echo 
            // '<script>
            //     cases('.$find->negociable.', '.$find->livraison.', '.$find->vendu.');
            // </script>';
        }
        else{
            // on reviens à la page des annonces
            redirect("/newlife/mes-annonces", 0);
        }


        /**
         * Formulaire
         */
        if(isset($_POST['update'])){
            // on met les champs nettoyer dans des variable
            $titre = firstLetterToUpper(cleanInput($_POST['titre_ann']));
            $desc = cleanInput($_POST['desc_ann']);
            $prix = cleanInput($_POST['prix_ann']);
            // $util = $_SESSION['id'];
            $cat = $_POST['cat'];
            $dep = $_POST['dep'];
            $nego = false;
            $livraison = false;
            $vendu = false;
            // on vérifie les chaps ne sont pas vide
            if(!empty($titre) && !empty($desc) && !empty($prix) && $cat != "default" && $dep != "default"){
                // on verifie si les options sont définis
                if(isset($_POST['negociable'])){
                    $nego = true;
                }
                if(isset($_POST['livraison'])){
                    $livraison = true;
                }
                if(isset($_POST['vendue'])){
                    $vendu = true;
                }
                // on instancie un nouveal objet ManagerAnnonce
                $ann = new ManagerAnnonce();
                // on set les attributs à l'objet
                $ann->setIdAnn($id);
                $ann->setTitreAnn($titre);
                $ann->setDescrAnn($desc);
                $ann->setPrixAnn($prix);
                $ann->setNegociable($nego);
                $ann->setLivraison($livraison);
                $ann->setVendu($vendu);
                $ann->setIdCat($cat);
                $ann->setIdDep($dep);
                // on modifie l'annonce
                $ann->updateAnnonce($bdd);
                $msg = "Annonce modifier";
                $type = "success";
                
                /**
                 * Images
                 */
                // on test si il ya des images à importer
                if(isset($_FILES['image']) && (count($_FILES['image']['name']) != 0)){ 
                    $total = count($_FILES['image']['name']);
                    // on enregistre les noms des fichiers
                    // traitement pour chaque fichier
                    for($i=0; $i<$total; $i++){ 
                        // on recupére le nom temporaire du fichier
                        $tmpName = $_FILES['image']['tmp_name'][$i];
                        // on recupère le nom du fichier
                        $name = $_FILES['image']['name'][$i];
                        $ext = get_file_extension($name);
                        // on récupére le nom du fichier
                        $fileName = get_file_name($name, $ext);
                        // on copie le nom original
                        $nom = $fileName;
                        // on instancie un nouvel objet ManagerImage
                        $img = new ManagerImage();
                        // on set le nom du fichier à l'objet
                        $img->setNomImg($nom);
                        // on recherche l'image avec son nom
                        $uneImage = $img->findImageByName($bdd);
                        $cpt = 1;
                        // tant que l'on trouve une image avec le même nom
                        while($uneImage){
                            // on modifie le nom du fichier en lu ajoutant la valeur du compteur à la fin
                            $nom = "$fileName$cpt";
                            // on set le nom du fichier à l'objet
                            $img->setNomImg($nom);
                            // on recherche l'image avec son nom
                            $uneImage = $img->findImageByName($bdd);
                            $cpt++;
                        }
                        // on créer l'url du fichier
                        $url = "./asset/image/$nom.$ext";
                        // on importe l'image
                        move_uploaded_file($tmpName, $url);
                        // on recupère l'annonce ajouter ci-dessous
                        $annonce = $ann->findAnnonceById($bdd);
                        // on set l'url et du fichier et l'id_ann à l'objet
                        $img->setUrlImg($url);
                        $img->setIdAnn($annonce->id_ann);
                        // on ajoute l'image
                        $img->addImage($bdd);
                    }
                }
            }
            else{
                $msg = "Tous les champs doivent être remplis";
                $type = "warning";
            } 
            // affichage du message
            echo 
            '<script>
                ecrireMessage("'.$msg.'", "'.$type.'"); 
            </script>';
            // on redirige vers la page mes-annonces après 3s
            redirect("/newlife/mes-annonces", 3000);
        }
    }
    else{
        // on redirige vers la page d'accueil
        redirect("/newlife/", 0);
    }

?>