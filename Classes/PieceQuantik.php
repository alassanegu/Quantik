<?php 

    namespace quantik\metier;
    
    /**
     * Classe PieceQuantik
     *
     */
    class PieceQuantik {
    
        /**
         * self::WHITE valeur numérique de la couleur blanche
         * @access public
         * @const int
         */
        public const WHITE = 0;
        
        /**
         * self::BLACK valeur numérique de la couleur noire
         * @access public
         * @const int
         */
        public const BLACK = 1;
        
        /**
         * self::VOID valeur numérique d'une pièce vide (case vide)
         * @access public
         * @const int
         */
        public const VOID = 0;
        
        /**
         * self::CUBE valeur numérique de la forme cube
         * @access public
         * @const int
         */
        public const CUBE = 1;
        
        /**
         * self::CONE valeur numérique de la forme cone
         * @access public
         * @const int
         */
        public const CONE = 2;
        
        /**
         * self::CYLINDRE valeur numérique de la forme cylindre
         * @access public
         * @const int
         */
        public const CYLINDRE = 3;
        
        /**
         * self::SPHERE valeur numérique de la forme sphère
         * @access public
         * @const int
         */
        public const SPHERE = 4;
        
        /**
         * self::TAB_AFFICHE_PIECE : tableau mutlidimensionnel stockant les affichages textuels de pièces.
         * @access public
         * @const array(array())
         */
        private const TAB_AFFICHE_PIECE = 
        [
            self::VOID     => "    ",
            self::CUBE     => [self::WHITE => "<img style='width: 30px' src='../icone/cube-blanc.png'>", self::BLACK => "<img style='width: 30px' src='../icone/cube-noire.png'>"],
            self::CONE     => [self::WHITE => "<img style='width: 30px' src='../icone/cone-blanc.png'>", self::BLACK => "<img style='width: 30px' src='../icone/cone-noire.png'>"],
            self::CYLINDRE => [self::WHITE => "<img style='width: 30px' src='../icone/cylindre-blanc.png'>", self::BLACK => "<img style='width: 30px' src='../icone/cylindre-noire.png'>"],
            self::SPHERE   => [self::WHITE => "<img style='width: 30px' src='../icone/sphere-blanc.png'>", self::BLACK => "<img style='width: 30px' src='../icone/sphere-noire.png'>"],
        ];
        
        /**
         * $forme : entier ∈ [0;4] indiquant la forme de la pièce.
         * @access protected
         * @var int
         */ 
        protected $forme;
        
        /**
         * $couleur : entier ∈ [0;1] indiquant la couleur de la pièce.
         * @access protected
         * @var int
         */ 
        protected $couleur;
        
        
        /**
         * Constructeur
         * @access private
         * @param $forme la forme à donner à la pièce
         * @param $couleur la couleur, noire ou blanche, de la pièce.
         */
        private function __construct(int $forme, int $couleur) 
        {
            $this->forme   = $forme;
            $this->couleur = $couleur;
        }
        
        /**
         * méthode getForme
         * @access public
         * @return $this->forme
         */
        public function getForme(): int { return $this->forme;   }
        
        /**
         * méthode getCouleur
         * @access public
         * @return $this->couleur
         */
        public function getCouleur(): int { return $this->couleur; }
        
        /**
         * méthode __toString
         * @access public
         * @return un affichage textuel de la forme et la couleur de la pièce.
         */
        public function __toString(): string 
        { 
            $forme = $this->forme;
            if ( $forme == self::VOID ) return self::TAB_AFFICHE_PIECE[$forme];         
            return self::TAB_AFFICHE_PIECE[$forme][$this->couleur];
        }
        
        /**
         * @static
         * @access public
         * @return une case vide
         */
        public static function initVoid(): self { return new PieceQuantik(self::VOID, self::WHITE); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme cube et de couleur blanche
         */
        public static function initWhiteCube(): self { return new PieceQuantik(self::CUBE, self::WHITE); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme cube et de couleur noire
         */
        public static function initBlackCube(): self { return new PieceQuantik(self::CUBE, self::BLACK); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme cone et de couleur blanche
         */
        public static function initWhiteCone(): self { return new PieceQuantik(self::CONE, self::WHITE); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme cone et de couleur noire
         */
        public static function initBlackCone(): self { return new PieceQuantik(self::CONE, self::BLACK); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme cylindre et de couleur blanche
         */
        public static function initWhiteCylindre(): self { return new PieceQuantik(self::CYLINDRE, self::WHITE); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme cylindre et de couleur noire
         */
        public static function initBlackCylindre(): self { return new PieceQuantik(self::CYLINDRE, self::BLACK); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme sphere et de couleur blanche
         */
        public static function initWhiteSphere(): self { return new PieceQuantik(self::SPHERE, self::WHITE); }
        
        /**
         * @static
         * @access public
         * @return une pièce de forme sphere et de couleur noire
         */
        public static function initBlackSphere(): self { return new PieceQuantik(self::SPHERE, self::BLACK); }
    }
?>
