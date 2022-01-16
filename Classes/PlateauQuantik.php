<?php
require "ArrayPieceQuantik.php";

class PlateauQuantik
{
    public const NW = 0;
    public const NE = 1;
    public const SW = 2;
    public const SE = 3;

    public  const NBROWS = 4;
    public const NBCOLS = 4;

    protected $cases;

    public function __construct(){
        $this->cases = array();
    }

    public function getPiece(int $rowNum, int $colNum) : PieceQuantik
    {
        return $this->cases[$rowNum][$colNum];
    }

    public function setPiece(int $rowNum, int $colNum, PieceQuantik $p) : void
    {
        $this->cases[$rowNum][$colNum] = $p;
    }

    public function getRow(int $numRow) : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        for($i = 0; $i < self::NBCOLS; $i++) {
            $a->setPiecesQuantiks($i, $this->cases[$numRow][$i]);
        }
        return $a;
    }

    public function getCol(int $numCol) : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        for($i = 0; $i < self::NBROWS; $i++) {
            $a->setPiecesQuantiks($i, $this->cases[$i][$numCol]);
        }
        return $a;
    }

    public function getCorner(int $dir) : ArrayPieceQuantik
    {
        $a = new ArrayPieceQuantik();
        if($dir == 0){
            $a->setPiecesQuantiks(0, $this->cases[0][0]);
            $a->setPiecesQuantiks(1, $this->cases[0][1]);
            $a->setPiecesQuantiks(2, $this->cases[1][0]);
            $a->setPiecesQuantiks(3, $this->cases[1][1]);
        } else if($dir == 1){
            $a->setPiecesQuantiks(0, $this->cases[0][2]);
            $a->setPiecesQuantiks(1, $this->cases[0][3]);
            $a->setPiecesQuantiks(2, $this->cases[1][2]);
            $a->setPiecesQuantiks(3, $this->cases[1][3]);
        }else if($dir == 2){
            $a->setPiecesQuantiks(0, $this->cases[2][0]);
            $a->setPiecesQuantiks(1, $this->cases[2][1]);
            $a->setPiecesQuantiks(2, $this->cases[3][0]);
            $a->setPiecesQuantiks(3, $this->cases[3][1]);
        }else if($dir == 3){
            $a->setPiecesQuantiks(0, $this->cases[2][2]);
            $a->setPiecesQuantiks(1, $this->cases[2][3]);
            $a->setPiecesQuantiks(2, $this->cases[3][2]);
            $a->setPiecesQuantiks(3, $this->cases[3][3]);
        }
        return $a;
    }
    public function __toString():string{
        $s = "";
        $i = 0;
        $j = 0;
        foreach($this->cases as $lignes){
            $s = $s."Ligne [".$i."]</br>";
            foreach ($lignes as $val) {
                $s = $s."Colonne [".$j."] = ".$val."</br>";
                $j++;
            }
            $i++;
        }
        return $s;
    }
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
echo $platPiece;
//echo PlateauQuantik::getCornerFromCoord(2,2);
