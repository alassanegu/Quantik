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
    public function getPiece(int $rowNum,int $colNum):PieceQuantik{
        $ap = new ArrayPieceQuantik();
        for ($rowNum=1;$rowNum<=self::NBROWS;$rowNum++){
            for ($colNum=1;$colNum<=self::NBCOLS;$colNum++){
                $this->cases[$colNum][$rowNum] = $ap->getPiecesQuantiks();
            }
        }
    }
    public function setPiece(int $rowNum,int $colNum,PieceQuantik $p): void
    {

    }
    public function getRow(int $numRow):ArrayPieceQuantik{
        $a = new ArrayPieceQuantik();


        return $a;
    }
    public function getCol(int $numCol):ArrayPieceQuantik{

    }
    public function getCorner(int $dir):ArrayPieceQuantik{

    }
    public function __toString():string{

    }
    public function getCornerFromCoord(int $rowNum,int $colNum):int{

    }

}