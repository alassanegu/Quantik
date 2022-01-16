<?php
require "PieceQuantik.php";

class ArrayPieceQuantik
{
    protected $piecesQuantiks ;
    protected $taille;

    public function __construct()
    {
        $this->taille = 0;
        $this->piecesQuantiks = array();
    }
    public function __toString():string {
        $s = "";
        foreach ($this->piecesQuantiks as $val){
            $s = " ".$val;
        }
        return $s;
    }

    public function getPiecesQuantiks(int $pos): PieceQuantik
    {
        return $this->piecesQuantiks[$pos];
    }
    public function setPiecesQuantiks(int $pos,PieceQuantik $piecesQuantiks): void
    {
        $this->piecesQuantiks[$pos] = $piecesQuantiks;
    }
    public function getTaille(): int
    {
        return $this->taille;
    }
    public function setTaille(int $taille): void
    {
        $this->taille = $taille;
    }

    public function addPieceQuantik(PieceQuantik $piece):void{
        $this->piecesQuantiks[$this->taille]=$piece;
        $this->taille++;
    }

    public function removePieceQuantik(int $pos):void{
        //Cette fonction peut supprimer une valeur à la fois.
        // Le nom du tableau avec l’index de l’élément ($tab[1]) est passé en paramètre.
        // Cette fonction ne modifie pas les valeurs d’index. Les valeurs d’index restent les mêmes qu’avant.
        if (in_array($this->piecesQuantiks[$pos],$this->piecesQuantiks)){
            unset($this->piecesQuantiks[$pos]);
            $this->taille --;
        }else{
            echo "indices non Trouve"."</br>";
        }

    }

    public static function initPiecesNoires():ArrayPieceQuantik{
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

    public static function initPiecesBlanches():ArrayPieceQuantik{
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
$arayPiece = new ArrayPieceQuantik();

$arayPiece->addPieceQuantik(PieceQuantik::initBlackCube());
$arayPiece->addPieceQuantik(PieceQuantik::initWhiteCone());
$arayPiece->addPieceQuantik(PieceQuantik::initWhiteSphere());
$arayPiece->removePieceQuantik(4);

//print_r(ArrayPieceQuantik::initPiecesNoires());
//echo $arayPiece;

print_r($arayPiece) ;

?>