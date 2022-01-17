<?php

// Cette classe gère une pièce du jeu
class PieceQuantik {
    public const WHITE = 0;
    public const BLACK = 1;
    public const VOID = 0;
    public const CUBE = 1;
    public const CONE = 2;
    public const CYLINDRE = 3;
    public const SPHERE = 4;

    protected $forme;
    protected $couleur;

    // Le constructeur prend 2 parametres et initialise les attributs forme et couleur
    private function __construct($forme, $couleur)
    {
        $this->forme = $forme;
        $this->couleur = $couleur;
    }

    // Le getteur getForme() retounre la valeur de forme
    public function getForme()
    {
        return $this->forme;
    }

    // Le getteur getCouleur() retounre la valeur de couleur
    public function getCouleur(){
        return $this->couleur;
    }

    // La fonction __toString() qui est redefini permet d'avoir un affichage plus parlant. Ainsi elle retourne une chaine contenant la valeur a affiche
    public function __toString() : string
    {
        $s = "la forme est : ".$this->getForme()." et la couleur est : ".$this->getCouleur()."</br>";
        return $s;
    }

    // La fonction initVoid() cree et renvoiee une piece quantik avec des valeurs vide
    public static function initVoid() : PieceQuantik
    {
        return new PieceQuantik(self::VOID,self::VOID);
    }

    // La fonction initWhiteCube() cree et renvoie une piece quantik avec la forme d'un cube et la couleur blanche
    public static function initWhiteCube() : PieceQuantik
    {
        return new PieceQuantik(self::CUBE,self::WHITE);
    }

    // La fonction initBlackCube() cree et renvoie une piece quantik avec la forme d'un cube et la couleur noire
    public static function initBlackCube() : PieceQuantik
    {
        return new PieceQuantik(self::CUBE,self::BLACK);
    }

    // La fonction initWhiteCone() cree et renvoie une piece quantik avec la forme d'un cone et la couleur blanche
    public static function initWhiteCone() : PieceQuantik
    {
        return new PieceQuantik(self::CONE,self::WHITE);
    }

    // La fonction initBlackCone() cree et renvoie une piece quantik avec la forme d'un cube et la couleur noire
    public static function initBlackCone():PieceQuantik{
        return new PieceQuantik(self::CONE,self::BLACK);
    }

    // La fonction initWhiteCylindre() cree et renvoie une piece quantik avec la forme d'un cylindre et la couleur blanche
    public static function initWhiteCylindre() : PieceQuantik
    {
        return new PieceQuantik(self::CYLINDRE,self::WHITE);
    }

    // La fonction initBlackCylindre() cree et renvoie une piece quantik avec la forme d'un cylindre et la couleur noire
    public static function initBlackCylindre() : PieceQuantik
    {
        return new PieceQuantik(self::CYLINDRE,self::BLACK);
    }

    // La fonction initWhiteSphere() cree et renvoie une piece quantik avec la forme d'un sphere et la couleur blanche
    public static function initWhiteSphere() : PieceQuantik
    {
        return new PieceQuantik(self::SPHERE,self::WHITE);
    }

    // La fonction initBlackSphere() cree et renvoie une piece quantik avec la forme d'un sphere et la couleur noire
    public static function initBlackSphere() : PieceQuantik
    {
        return new PieceQuantik(self::SPHERE,self::BLACK);
    }
}
// //Test du classe PieceQuantik
//echo PieceQuantik::initBlackCube();
//echo PieceQuantik::initVoid();
?>