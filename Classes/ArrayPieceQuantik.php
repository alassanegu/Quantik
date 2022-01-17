<?php

require "PieceQuantik.php";

// Cette classe ArrayPieceQuantik permets de manipuler plus facilement les pièces du jeux
class ArrayPieceQuantik
{
    protected $piecesQuantiks ;
    protected $taille;

    // Le constructeur sans parametre initialise taille a 0 et piecesQuantik comme un tableau vide
    public function __construct()
    {
        $this->taille = 0;
        $this->piecesQuantiks = array();
    }

    // La fonction __toString() qui est redefini permet d'avoir un affichage plus parlant.
    // Ainsi elle va parcourir les pieces quantik qui sont dans l'attribut piecesQuantik et va stocker dans une chaine des valeurs permettant l'affichage
    // Apres elle retourne la chaine contenant la valeur a affiche.
    public function __toString() : string
    {
        $s = "";
        $j = 0;
        foreach ($this->piecesQuantiks as $val) {
            $s = $s."Element [".$j."] = ".$val."</br>";
            $j++;
        }
        return $s;
    }

    // Le getteur getPiecesQuantiks() prend en parametre une position et retounre la valeur un PieceQuantik.
    public function getPiecesQuantiks(int $pos) : PieceQuantik
    {
        return $this->piecesQuantiks[$pos];
    }

    // Le getteur setPiecesQuantiks() prend en parametre une position et une PieceQuantik.
    // Elle affecte a la position de piecesQuantiks la valeur du PieceQuantik passe en parametre.
    public function setPiecesQuantiks(int $pos, PieceQuantik $piecesQuantiks) : void
    {
        $this->piecesQuantiks[$pos] = $piecesQuantiks;
    }

    // Le getteur getTaille() retounre la valeur un taille.
    public function getTaille() : int
    {
        return $this->taille;
    }

    // Le getteur setTaille() prend en parametre une taille et l'affecte a la taille de la classe.
    public function setTaille(int $taille) : void
    {
        $this->taille = $taille;
    }

    // La fonction addPieceQuantik prend en parametre une piece quantik et ajoute une nouvelle piece dans le tableau piecesQuantiks et increment taille.
    public function addPieceQuantik(PieceQuantik $piece) : void
    {
        $this->piecesQuantiks[$this->taille]=$piece;
        $this->taille++;
    }

    // La fonction removePieceQuantik prend en parametre un eposition et la supprime dans le tableau piecesQuantiks et desincrement taille.
    // Elle la supprime en faisant appelle a la fonction unset
    public function removePieceQuantik(int $pos) : void
    {
        //Cette fonction peut supprimer une valeur à la fois.
        // Le nom du tableau avec l’index de l’élément ($tab[1]) est passé en paramètre.
        // Cette fonction ne modifie pas les valeurs d’index. Les valeurs d’index restent les mêmes qu’avant.
        if ($pos < $this->taille){
            unset($this->piecesQuantiks[$pos]);
            $this->taille--;
        }else{
            echo "indices non Trouve"."</br>";
        }

    }

    // La fonction initPiecesNoires cree et renvoie 8 pieces quantik noire 2 de chaque forme
    public static function initPiecesNoires() : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        $a->addPieceQuantik(PieceQuantik::initBlackCone());
        $a->addPieceQuantik(PieceQuantik::initBlackCube());
        $a->addPieceQuantik(PieceQuantik::initBlackCylindre());
        $a->addPieceQuantik(PieceQuantik::initBlackSphere());
        $a->addPieceQuantik(PieceQuantik::initBlackCone());
        $a->addPieceQuantik(PieceQuantik::initBlackCube());
        $a->addPieceQuantik(PieceQuantik::initBlackCylindre());
        $a->addPieceQuantik(PieceQuantik::initBlackSphere());
        return $a;
    }

    // La fonction initPiecesNoires cree et renvoie 8 pieces quantik blanche 2 de chaque forme
    public static function initPiecesBlanches() : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        $a->addPieceQuantik(PieceQuantik::initWhiteCone());
        $a->addPieceQuantik(PieceQuantik::initWhiteCone());
        $a->addPieceQuantik(PieceQuantik::initWhiteSphere());
        $a->addPieceQuantik(PieceQuantik::initWhiteSphere());
        $a->addPieceQuantik(PieceQuantik::initWhiteCube());
        $a->addPieceQuantik(PieceQuantik::initWhiteCube());
        $a->addPieceQuantik(PieceQuantik::initWhiteCylindre());
        $a->addPieceQuantik(PieceQuantik::initWhiteCylindre());
        return $a;
    }

}

?>