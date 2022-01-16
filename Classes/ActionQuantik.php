<?php

require "PlateauQuantik.php";

class ActionQuantik
{
    protected PlateauQuantik $plateau;

    public function __construct()
    {
        $this->plateau = new PlateauQuantik();
    }

    public function getPlateau() : PlateauQuantik
    {
        return $this->plateau;
    }

    public function isRowWin(int $numRow) : bool
    {
        $comp = 0;
        $temp = ($this->plateau)->getRow($numRow);
        for($i = 0; $i < 4; $i++){
            $comp += $temp->getPiecesQuantiks($i)->getForme();
        }
        if($comp == 10)
            return true;
        else
            return false;
    }

    public function isColWin(int $numCol) : bool
    {
        $comp = 0;
        $temp = ($this->plateau)->getCol($numCol);
        for($i = 0; $i < 4; $i++){
            $comp += $temp->getPiecesQuantiks($i)->getForme();
        }
        if($comp == 10)
            return true;
        else
            return false;
    }

    public function isCornerWin(int $dir) : bool
    {
        $comp = 0;
        $temp = ($this->plateau)->getCorner($dir);
        for($i = 0; $i < 4; $i++){
            $comp += $temp->getPiecesQuantiks($i)->getForme();
        }
        if($comp == 10)
            return true;
        else
            return false;
    }

//    public function isValidePose(int $rowNum, int $colNum, PieceQuantik $piece) : bool
//    {
//        $result = false;
//        if($this->plateau[$rowNum][$colNum] == null)
//            $result true;
//        else
//            return false;
//
//        if(!$this->isPoseValide(, $piece))
//
//
//    }
//
//    public function posePiece(int $rowNum, int $colNum, PieceQuantik $piece) : void
//    {
//
//    }
//
//    public function __toString() : string
//    {

//    }
//
//    private function isComboValide(ArrayPieceQuantik $pieces) : bool
//    {
//
//    }
//
//    private function isPoseValide(ArrayPieceQuantik $pieces, PlateauQuantik $p) : bool
//    {
//
//    }
}