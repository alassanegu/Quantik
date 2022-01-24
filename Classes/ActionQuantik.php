<?php 

    namespace quantik\metier;
    
    require_once("../Classes/PlateauQuantik.php");
    require_once("../Classes/PieceQuantik.php"); //require facultatif.
    
     use quantik\metier\PlateauQuantik;
     use quantik\metier\PieceQuantik;
    

    class ActionQuantik {
    
        /**
          * $plateauQuantik : objet PlateauQuantik permettant l'accès et la modification du plateau de jeu.
          * @access protected
          * @var PlateauQuantik
          */ 
        protected $plateauQuantik;
        
        /**
         * Constructeur
         * @access public
         */
        public function __construct(PlateauQuantik $plateau) 
        {
            $this->plateauQuantik = $plateau;
        }
        
        /**
         * méthode getPiece
         * @access public
         * @return $this->plateauQuantik
         */
        public function getPlateau(): PlateauQuantik { return $this->plateauQuantik; }
       
       /**
         * méthode isRowWin
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @return vrai si la ligne contient 4 pièces de formes différentes, faux sinon.
         */
        public function isRowWin(int $rowNum): bool {
            return self::isComboWin($this->plateauQuantik->getRow($rowNum)); 
        }
        
        /**
         * méthode isColWin
         * @access public
         * @param $colNum entier représentant une colonne du plateau
         * @return vrai si la colonne contient 4 pièces de formes différentes, faux sinon.
         */
        public function isColWin(int $colNum): bool { 
            return self::isComboWin($this->plateauQuantik->getCol($colNum)); 
        }
        
        /**
         * méthode isRowWin
         * @access public
         * @param $dir entier représentant la direction du tableau (NW, NE, SW, SE)
         * @return vrai si le coin contient 4 pièces de formes différentes, faux sinon.
         */
        public function isCornerWin(int $dir): bool {
            return self::isComboWin($this->plateauQuantik->getCorner($dir)); 
        }
        
        /**
         * méthode isValidePose
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @param $colNum entier représentant une colonne du plateau
         * @param $piece PieceQuantik à poser à la ligne et colonne donnée du plateau.
         * @return vrai si la pièce se place dans sur une case dont la ligne/colonne/coin ne contient pas une pièce adverse de même forme, faux sinon.
         */
        public function isValidePose(int $rowNum, int $colNum, PieceQuantik $piece): bool 
        {
            if ( $piece->getForme() == PieceQuantik::VOID ) return false;
            $piecePlateau = $this->plateauQuantik->getPiece($rowNum, $colNum);
            if ( $piecePlateau->getForme() != PieceQuantik::VOID ) return false;
                
            $dir = $this->plateauQuantik->getCornerFromCoord($rowNum, $colNum);
               
            return self::isPieceValide($this->plateauQuantik->getRow($rowNum), $piece) &&
                   self::isPieceValide($this->plateauQuantik->getCol($colNum), $piece) &&
                   self::isPieceValide($this->plateauQuantik->getCorner($dir), $piece);
                       
        }
        
        /**
         * méthode posePiece
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @param $colNum entier représentant une colonne du plateau
         * @param $piece PieceQuantik à poser à la ligne et colonne donnée du plateau.
         */
        public function posePiece(int $rowNum, int $colNum, PieceQuantik $piece) 
        {
            if ( $this->isValidePose($rowNum, $colNum, $piece) )
                $this->plateauQuantik->setPiece($rowNum, $colNum, $piece);
        }
        
        /**
         * méthode __toString
         * @access public
         * @return le tableau sous forme textuel
         */
        public function __toString(): string 
        {
            return strval($this->plateauQuantik); 
        }
        
        /**
         * @static
         * Factorise le code de isRowWin, isColWin, isCornerWin
         * @access private
         * @return vrai si la ligne/colonne/coin contient 4 pièces de formes différentes, faux sinon.
         */
        private static function isComboWin(array $pieces): bool 
        {
            $pPassees = array();
            $color = $pieces[0]->getCouleur();
            $array = [PieceQuantik::CUBE => 0, PieceQuantik::CONE => 0, PieceQuantik::SPHERE => 0, PieceQuantik::CYLINDRE => 0];
            foreach( $pieces as $p ) {
                $forme = $p->getForme();
                if ( $forme == PieceQuantik::VOID ) return false;
                if ( $array[$forme] > 0 ) return false;
                $array[$forme]++;
            }
            return true;
        }
        
        /**
         * @static
         * @access private
         * @return vrai si la ligne/colonne/coin ne contient pas une pièce adverse de la même forme que la pièce donnée en paramètre.
         */
        private static function isPieceValide(array $pieces, PieceQuantik $piece): bool 
        {
            foreach( $pieces as $p2 ) {
                if ( $p2->getForme() == $piece->getForme() && 
                     $p2->getCouleur() != $piece->getCouleur() ) return false;
            }
            return true;
        }
    }
?>
