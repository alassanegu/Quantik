<?php 

    namespace quantik\metier;
    
    require_once("../Classes/PieceQuantik.php");
    
    use quantik\metier\PieceQuantik;
    use Exception;
    
    /**
      * Classe PlateauQuantik
      *
      *
     */
    class PlateauQuantik {
    
        /**
         * self::NB_ROWS nombre de ligne du plateau
         * @access public
         * @const int
         */
        public const NB_ROWS = 4;
        /**
         * self::NB_COLS nombre de colonnes du plateau
         * @access public
         * @const int
         */
        public const NB_COLS = 4;
        /**
         * self::NW valeur numérique du coin nord-ouest
         * @access public
         * @const int
         */
        public const NW = 0;
        /**
         * self::NE valeur numérique du coin nord-est
         * @access public
         * @const int
         */
        public const NE = 1;
        /**
         * self::SW valeur numérique du coin sud-ouest
         * @access public
         * @const int
         */
        public const SW = 2;
        /**
         * self::SE valeur numérique du coin sud-est
         * @access public
         * @const int
         */
        public const SE = 3;
        
        /**
          * $cases : tableau multidimensionnel de PieceQuantik ∈ [0;3][0;3] référant le plateau.
          * @access protected
          * @var PieceQuantik[][]
          */ 
        protected $cases;
        
        /**
         * Constructeur, initialise $this->cases avec des pièces de type VOID.
         * @access public
         */
        public function __construct() 
        {
            $this->cases = array(array());
            for ( $i = 0; $i < self::NB_ROWS; $i++ ) 
                for ( $y = 0; $y < self::NB_COLS; $y++ )
                    $this->cases[$i][$y] = PieceQuantik::initVoid();
        }
       
        /**
         * méthode getPiece
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @param $colNum entier représentant une colonne du plateau
         * @return PieceQuantik contenu dans $this->cases[$rowNum][$colNum].
         */
        public function getPiece(int $rowNum, int $colNum): PieceQuantik 
        {
            self::checkBounds($rowNum, $colNum);
            return $this->cases[$rowNum][$colNum];
        }
        
        /**
         * méthode setPiece
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @param $colNum entier représentant une colonne du plateau
         * @param $p PieceQuantik à placer à la position donnée par $rowNum et $colNum
         */
        public function setPiece(int $rowNum, int $colNum, PieceQuantik $p) 
        {
            self::checkBounds($rowNum, $colNum);
            $this->cases[$rowNum][$colNum] = $p;
        }
        
        /**
         * méthode getRow
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @return les PieceQuantik de la ligne $rowNum.
         */
        public function getRow(int $rowNum): array
        {
            self::checkBounds($rowNum, 0);
            return $this->cases[$rowNum];
        }
        
        /**
         * méthode getCol
         * @access public
         * @param $colNum entier représentant une colonne du plateau
         * @return les PieceQuantik de la colonne $colNum.
         */
        public function getCol(int $colNum): array
        {
             self::checkBounds(0, $colNum);
             $col = array();
             for($i = 0; $i < self::NB_COLS; $i++)
                $col[$i] = $this->cases[$i][$colNum];
             return $col;
        }
        
        /**
         * méthode getCorner
         * @access public
         * @param $dir entier ∈ [0;3] représentant un coin du tableau (NW, NE, SW, SE).
         * @return les PieceQuantik du coin demandé en paramètre.
         */
        public function getCorner(int $dir): array 
        {
            self::checkDir($dir);
            switch($dir) 
            {
                case self::NW:
                    return [ $this->cases[0][0], $this->cases[0][1], $this->cases[1][0], $this->cases[1][1] ]; 
                    
                case self::NE: 
                    return [ $this->cases[0][2], $this->cases[0][3], $this->cases[1][2], $this->cases[1][3] ];
                    
                case self::SW:
                    return [ $this->cases[2][0], $this->cases[2][1], $this->cases[3][0], $this->cases[3][1] ];
                    
                case self::SE: 
                    return [ $this->cases[2][2], $this->cases[2][3], $this->cases[3][2], $this->cases[3][3] ];
            }

        }
        
        /**
         * méthode __toString()
         * @access public
         * @return une représentation textuel du plateau dans l'état.
         */
        public function __toString(): string 
        {
            $res = "";
            for ( $i = 0; $i < self::NB_ROWS; $i++ )
                $res .= "|-----------------|";
                
            $res .= "\n";
            
            for ( $i = 0; $i < self::NB_ROWS; $i++ ) {
                for ( $y = 0; $y < self::NB_COLS; $y++ ) {
                    $piece = $this->cases[$i][$y];
                    $res .= "|" . sprintf(" %-16s",$piece) . "|";
                }
                $res .= "\n";
            }
            
            for ( $i = 0; $i < self::NB_ROWS; $i++ )
                $res .= "|-----------------|";
                
            return $res;
        }
        
        /**
         * @static
         * Donne une direction par rapport à la case du tableau donné.
         * @access public
         * @param $rowNum entier représentant une ligne du plateau
         * @param $colNum entier représentant une colonne du plateau
         * @return un entier ∈ [0;3] représentant une direction (NW, NE, SW, SE).
         */
        public static function getCornerFromCoord(int $rowNum, int $colNum): int {
            self::checkBounds($rowNum, $colNum);
            
            if ( $rowNum <  self::NB_ROWS/2 && $colNum <  self::NB_COLS/2 ) return self::NW;
            if ( $rowNum <  self::NB_ROWS/2 && $colNum >= self::NB_COLS/2 ) return self::NE;
            if ( $rowNum >= self::NB_ROWS/2 && $colNum <  self::NB_COLS/2 ) return self::SW;
            if ( $rowNum >= self::NB_ROWS/2 && $colNum >= self::NB_COLS/2 ) return self::SE;
        }
        
        /**
         * @static
         * Vérifie que la ligne et la colonne donné pointe bien vers une case du plateau.
         * @access public
         */
        private static function checkBounds(int $rowNum, int $colNum): void {
            if ( $rowNum < 0 || $rowNum >= self::NB_ROWS ||
                 $colNum < 0 || $colNum >= self::NB_COLS   ) throw new \Exception("Coordonnées hors du plateau\n");
        }
        
        /**
         * @static
         * Vérifie que la direction donné fait bien partie de nos 4 valeurs possibles (NW, NE, SW, SE).
         * @access public
         */
        private static function checkDir(int $dir) {
            if ( $dir < 0 && $dir > self::SE ) throw new \Exception("Direction non valide\n");
        }
    }
?>
