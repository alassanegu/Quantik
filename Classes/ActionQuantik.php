<?php

require "PlateauQuantik.php";

class ActionQuantik
{
    protected PlateauQuantik $plateau;

    public function __construct(PlateauQuantik $plateau)
    {
        $this->plateau = $plateau;
    }

    public function getPlateau() : PlateauQuantik
    {
        return $this->plateau;
    }

    public function isRowWin(int $numRow) : bool
    {
        $temp = ($this->plateau)->getRow($numRow);
        return ActionQuantik::isComboValide($temp);
    }

    public function isColWin(int $numCol) : bool
    {
        $temp = ($this->plateau)->getCol($numCol);
        return ActionQuantik::isComboValide($temp);
    }

    public function isCornerWin(int $dir) : bool
    {
        $temp = ($this->plateau)->getCorner($dir);
        return ActionQuantik::isComboValide($temp);
    }

//    public function isValidePose(int $rowNum, int $colNum, PieceQuantik $piece) : bool
//    {
//        $result = false;
//        if($this->plateau[$rowNum][$colNum] == null)
//            $result true;
//        else
//            return false;
//
//        if(!$this->isPoseValide(, $piece)){
//
//        }
//    return true;
//    }

//    public function posePiece(int $rowNum, int $colNum, PieceQuantik $piece) : void
//    {
//
//    }
//
    public function __toString() : string
    {
        return $this->plateau;
    }

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

    private static function isPieceValide(ArrayPieceQuantik $pieces, PlateauQuantik $p) : bool
    {

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