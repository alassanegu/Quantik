<?php

require "PlateauQuantik.php";

// Cette classe gère les méthodes gérant les règles du jeu.
class ActionQuantik
{
    protected $plateau;

    // Le constructeur prend en parametre un plateau et l'initialise a la variable plateau
    public function __construct(PlateauQuantik $plateau)
    {
        $this->plateau = $plateau;
    }

    // Le getteur getPlateau returne le plateau
    public function getPlateau() : PlateauQuantik
    {
        return $this->plateau;
    }

    // La fonction isRowWin prend en parametre un numero de ligne et returne true si cette ligne est gagnant et false sinon.
    // Elle utilise la fonction isComboValide pour les verifications
    public function isRowWin(int $numRow) : bool
    {
        $temp = ($this->plateau)->getRow($numRow);
        return ActionQuantik::isComboValide($temp);
    }

    // La fonction isColWin prend en parametre un numero de colonne et returne true si cette colonne est gagnant et false sinon.
    // Elle utilise la fonction isComboValide pour les verifications
    public function isColWin(int $numCol) : bool
    {
        $temp = ($this->plateau)->getCol($numCol);
        return ActionQuantik::isComboValide($temp);
    }

    // La fonction isCornerWin prend en parametre un numero corner et returne true si cette corner est gagnant et false sinon.
    // Elle utilise la fonction isComboValide pour les verifications
    public function isCornerWin(int $dir) : bool
    {
        $temp = ($this->plateau)->getCorner($dir);
        return ActionQuantik::isComboValide($temp);
    }

    // La fonction isValidePose prend en parametre  un numero de ligne, un numero de colonne et ume piece quantik.
    // Elle verifie si la position qu'on veut ajouter la piece est vide ou pas.
    // Et ensuite si c'est vide, utilise la fonction isPieceValide pour verifier si la forme est posable.
    // returne true si les 2 verification sont vrai et false sinon.
    public function isValidePose(int $rowNum, int $colNum, PieceQuantik $piece) : bool
    {
        $row = $this->plateau->getRow($rowNum);
        $col = $this->plateau->getCol($colNum);
        $dir = $this->plateau->getCornerFromCoord($rowNum,$colNum);
        $corner = $this->plateau->getCorner($dir);
        if($this->isPieceValide($row, $piece) && $this->isPieceValide($col, $piece) && $this->isPieceValide($corner, $piece)) {
            return false;
        }
        return true;
    }

    // La fonction posePiece prend en parametre  un numero de ligne, un numero de colonne et ume piece quantik.
    // Elle utilise la fonction isValidePose pour verifie si la piece est posable ou pas.
    // Si oui elle pose sinon elle pose pas
    public function posePiece(int $rowNum, int $colNum, PieceQuantik $piece) : void
    {
        if($this->isValidePose($rowNum,$colNum,$piece) == true){
            $this->plateau->setPiece($rowNum,$colNum,$piece);
        }
    }

    // La fonction __toString() qui est redefini permet d'avoir un affichage plus parlant.
    // Ainsi comme la classe a une seul attribut qui est un PlateauQuantik,
    // il faut retourner ce plateau et la methode __toString redefini dans la classe Plateau va se charger de l'affichage.
    public function __toString() : string
    {
        return $this->plateau;
    }

    // La fonction static isComboValide prend en parametre un ArrayPieceQuantik et verifie si cette array est gagnant ou pas.
    // Elle renvoie true or false
    // Elle renvoie false s'il y a une case vide
    // Vu que chaque forme a un numero,
    // si tous les cases sont pleines alors le combo sera valide lorsque la somme des valeurs des formes des 4 cases donnent 10.
    private static function isComboValide(ArrayPieceQuantik $pieces) : bool
    {
        $comp = 0;
        for($i = 0; $i < 4; $i++){
            if($pieces->getPiecesQuantiks($i)->getForme() == PieceQuantik::VOID) {
                return false;
            }
            $comp += $pieces->getPiecesQuantiks($i)->getForme();
        }
        if($comp == 10)
            return true;
        else
            return false;
    }

    // La fonction isPieceValide prend en parametre  un ArrayPieceQuantik.
    // Elle verifie si la forme est posable sur ce ArrayPieces ou pas.
    // returne true si c'est posable et false sinon.
    private static function isPieceValide(ArrayPieceQuantik $pieces, PlateauQuantik $p) : bool
    {
        for($i = 0; $i < $pieces->getTaille() ; $i++){
            if($pieces->getPieceQuantik($i)->getForme() == $p->getForme() ) {
                return false;
            }
        }
        return true;
    }
}

$platPiece = new PlateauQuantik();
$arrNoire = ArrayPieceQuantik::initPiecesNoires();
$arrBlanche = ArrayPieceQuantik::initPiecesBlanches();
$platPiece->setPiece(0,0, $arrNoire->getPiecesQuantiks(0));
$platPiece->setPiece(0,1, $arrNoire->getPiecesQuantiks(1));
$platPiece->setPiece(0,2, $arrNoire->getPiecesQuantiks(2));
$platPiece->setPiece(0,3, $arrNoire->getPiecesQuantiks(3));
$platPiece->setPiece(1,0, $arrBlanche->getPiecesQuantiks(0));
$platPiece->setPiece(1,1, $arrBlanche->getPiecesQuantiks(1));
$platPiece->setPiece(1,2, $arrBlanche->getPiecesQuantiks(2));
$platPiece->setPiece(1,3, $arrBlanche->getPiecesQuantiks(3));
$platPiece->setPiece(2,0, $arrNoire->getPiecesQuantiks(4));
$platPiece->setPiece(2,1, $arrNoire->getPiecesQuantiks(5));
$platPiece->setPiece(2,2, $arrNoire->getPiecesQuantiks(6));
$platPiece->setPiece(2,3, $arrNoire->getPiecesQuantiks(7));
$platPiece->setPiece(3,0, $arrBlanche->getPiecesQuantiks(4));
$platPiece->setPiece(3,1, $arrBlanche->getPiecesQuantiks(5));
$platPiece->setPiece(3,2, $arrBlanche->getPiecesQuantiks(6));
$platPiece->setPiece(3,3, $arrBlanche->getPiecesQuantiks(7));

$actionQuantik = new ActionQuantik($platPiece);
echo $actionQuantik;

?>