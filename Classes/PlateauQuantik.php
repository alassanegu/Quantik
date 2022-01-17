<?php

require "ArrayPieceQuantik.php";

// Cette classe gère un plateau de jeu.
class PlateauQuantik
{
    public const NW = 0;
    public const NE = 1;
    public const SW = 2;
    public const SE = 3;

    public  const NBROWS = 4;
    public const NBCOLS = 4;

    protected $cases;

    // Le constructeur sans parametre initialise la variable cases qui est une matrice de piece quantik avec des pieces quantik vide
    public function __construct()
    {
        $this->cases = array();
        for($i = 0; $i < self::NBROWS; $i++){
            for($j = 0; $j < self::NBCOLS; $j++){
                $this->setPiece($i, $j, PieceQuantik::initVoid());
            }
        }
    }

    // Le getteur getPiece prend en parametre un numero de ligne et un numero de colonne puis retounre la valeur du PieceQuantik a cette position.
    public function getPiece(int $rowNum, int $colNum) : PieceQuantik
    {
        return $this->cases[$rowNum][$colNum];
    }

    // Le setteur setPiece prend en parametre un numero de ligne, un numero de colonne et ume piece quantik puis affecte la piece a la position dans cases.
    public function setPiece(int $rowNum, int $colNum, PieceQuantik $p) : void
    {
        $this->cases[$rowNum][$colNum] = $p;
    }

    // Le getteur getRow prend en parametre un numero de ligne et retounre un ArrayPieceQuantik correspondant a ce ligne dans cases.
    public function getRow(int $numRow) : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        for($i = 0; $i < self::NBCOLS; $i++) {
            $a->setPiecesQuantiks($i, $this->cases[$numRow][$i]);
        }
        return $a;
    }

    // Le getteur getCol prend en parametre un numero de colonne et retounre un ArrayPieceQuantik correspondant a ce colonne dans cases.
    public function getCol(int $numCol) : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        for($i = 0; $i < self::NBROWS; $i++) {
            $a->setPiecesQuantiks($i, $this->cases[$i][$numCol]);
        }
        return $a;
    }

    // Le getteur getCorner prend en parametre un numero et verifie dabord de quelle corner s'agit il puis retounre un ArrayPieceQuantik correspondant a ce corner dans cases.
    public function getCorner(int $dir) : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        if($dir == self::NW){
            $a->setPiecesQuantiks(0, $this->cases[0][0]);
            $a->setPiecesQuantiks(1, $this->cases[0][1]);
            $a->setPiecesQuantiks(2, $this->cases[1][0]);
            $a->setPiecesQuantiks(3, $this->cases[1][1]);
        } else if($dir == self::NE){
            $a->setPiecesQuantiks(0, $this->cases[0][2]);
            $a->setPiecesQuantiks(1, $this->cases[0][3]);
            $a->setPiecesQuantiks(2, $this->cases[1][2]);
            $a->setPiecesQuantiks(3, $this->cases[1][3]);
        }else if($dir == self::SW){
            $a->setPiecesQuantiks(0, $this->cases[2][0]);
            $a->setPiecesQuantiks(1, $this->cases[2][1]);
            $a->setPiecesQuantiks(2, $this->cases[3][0]);
            $a->setPiecesQuantiks(3, $this->cases[3][1]);
        }else if($dir == self::SE){
            $a->setPiecesQuantiks(0, $this->cases[2][2]);
            $a->setPiecesQuantiks(1, $this->cases[2][3]);
            $a->setPiecesQuantiks(2, $this->cases[3][2]);
            $a->setPiecesQuantiks(3, $this->cases[3][3]);
        }
        return $a;
    }

    // La fonction __toString() qui est redefini permet d'avoir un affichage plus parlant.
    // Ainsi elle va parcourir les pieces quantik qui sont dans l'attribut cases et va stocker dans une chaine des valeurs permettant l'affichage.
    // Apres elle retourne la chaine contenant la valeur a affiche.
    public function __toString() : string
    {
        $s = "";
        $i = 0;
        $j = 0;
        foreach($this->cases as $lignes){
            $s = $s."Ligne [".$i."]</br>";
            foreach ($lignes as $val) {
                $s = $s."Colonne [".$j."] = ".$val."</br>";
                $j++;
            }
            $j = 0;
            $i++;
        }
        return $s;
    }

    // Le getteur getCornerFromCoord prend en parametre un numero de ligne et un numero de colonne puis retounre le coorner correspondant.
    public static function getCornerFromCoord(int $rowNum, int $colNum) : int{
        $retour = 0;
        if($rowNum == 0 || $rowNum == 1){
            if($colNum == 0 || $colNum == 1)
                $retour = PlateauQuantik::NW;
            else
                $retour = PlateauQuantik::NE;
        }else{
            if($colNum == 0 || $colNum == 1)
                $retour = PlateauQuantik::SW;
            else
                $retour = PlateauQuantik::SE;
        }
        return $retour;
    }
}

?>