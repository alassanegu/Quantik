<?php

require_once "../Classes/PlateauQuantik.php";
require_once "../Classes/ArrayPieceQuantik.php";

 use quantik\metier\PieceQuantik;
 use quantik\metier\PlateauQuantik;
 use quantik\metier\ActionQuantik;
 use quantik\metier\ArrayPieceQuantik;

/**
 * Class QuantikUIGenerator
 */
class QuantikUIGenerator
{

    /**
     * @param string $title
     * @return string
     */
    public static function getDebutHTML(string $title = "Quantik"): string
    {
        return "<!doctype html>
<html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <title>$title</title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"quantik.css\" />
    </head>
    <body>
        <h1 class=\"quantik-title\">$title</h1>
        <div class='quantik'>\n";
    }

    /**
     * @return string
     */
    public static function getFinHTML(): string
    {
        return " </div><footer style=\"text-align: center;\">@Alassane-GUEYE & Khadim-FAll</footer></body>\n</html>";
    }

    /**
     * @param string $message
     * @return string
     */
    public static function getPageErreur(string $message): string
    {
        header("HTTP/1.1 400 Bad Request");
        $resultat = self::getDebutHTML("400 Bad Request");
        $resultat .= "<h2>$message</h2>";
        $resultat .= "<p><br /><br /><br /><a href='quantik.php?reset'>Retour à l'accueil...</a></p>";
        $resultat .= self::getFinHTML();
        return $resultat;
    }

    /**
     * @param PieceQuantik $pq
     * @return string
     */
    public static function getButtonClass(PieceQuantik $pq) {
        if ($pq->getForme()==PieceQuantik::VOID)
            return "vide";
        $ch = $pq->__toString();
        return substr($ch,1,2).substr($ch,4,1);
    }

    /**
     * production d'un bloc HTML pour présenter l'état du plateau de jeu,
     * l'attribution de classes en vue d'une utilisation avec les est un bon investissement...
     * @param PlateauQuantik $p
     * @return string
     */
    public static function getDivPlateauQuantik(PlateauQuantik $p): string
    {
        $resultat = "<div class=\"quantikDivPlateau\">\n";
        $resultat .= "<table>\n";
        for ( $i = 0; $i < PlateauQuantik::NB_ROWS; $i++ ) {
            $resultat .= "<tr>\n";
            for ($y = 0; $y < PlateauQuantik::NB_COLS; $y++ ) {
                $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" disabled>(".$p->getPiece($i, $y).")</button></td>\n";
            }
            $resultat .= "</tr>\n";
        }
        $resultat .= "</table>\n";
        return $resultat;
    }

    /**
     * @param ArrayPieceQuantik $apq
     * @param int $pos permet d'identifier la pièce qui a été sélectionnée par l'utilisateur avant de la poser (si != -1)
     * @return string
     */
    public static function getDivPiecesDisponibles(ArrayPieceQuantik $apq, int $pos = -1): string {
        $resultat = "";
        $resultat = "<div class=\"quantikDispo\">\n";
        for($i = 0; $i < $apq->getTaille(); $i++) {
            $class = "quantik-btn";
            if ( $pos != -1 && $pos == $i ) $class .= " quantik-btn-selected";
            $resultat .= "<button class=\"$class\" type=\"submit\" name=\"active\" disabled>". $apq->getPieceQuantik($i) ."</button>\n";
        }
        $resultat .= "</div>\n";
        return $resultat;
    }

    /**
     * @param ArrayPieceQuantik $apq
     * @return string
     */
    public static function getFormSelectionPiece(ArrayPieceQuantik $apq): string {
        $resultat = "<div class=\"quantikSelect\">\n";
        $resultat .= "<form>";
        for($i = 0; $i < $apq->getTaille(); $i++)
            $resultat .= "<button class=\"quantik-btn\" type=\"submit\" value=\"$i\" name=\"active\">". $apq->getPieceQuantik($i) ."</button>";
        $resultat .= "<input type=\"hidden\" name=\"action\" value=\"choisirPiece\" />";
        $resultat .= "</form>";
        $resultat .= "</div>\n";
        return $resultat;
    }

    /**
     * @param PlateauQuantik $plateau
     * @param PieceQuantik $piece
     * @param int $position position de la pièce qui sera posée en vue de la transmettre via un champ caché du formulaire
     * @return string
     */
    public static function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece, int $position): string {
        $resultat = "";
        $action = new ActionQuantik($plateau);
        $resultat .= "<div class=\"quantik-Plateau\">\n";
        $resultat .= "<form>";
        $resultat .= "<table>";
        for ( $i = 0; $i < PlateauQuantik::NB_ROWS; $i++ ) {
            $resultat .= "<tr>";
            for ($y = 0; $y < PlateauQuantik::NB_COLS; $y++ ) {
                if ( $action->isValidePose($i, $y, $piece) )
                    $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" value=\"$i-$y\">(".$plateau->getPiece($i, $y).")</button></td>";
                else
                    $resultat .= "<td><button style=\"color : red;\" class=\"quantik-btn\" type=\"submit\" name=\"active\" disabled>(".$plateau->getPiece($i, $y).")</button></td>";
            }
            $resultat .= "</tr>";
        }
        unset($action);
        $resultat .= "</table>";
        $resultat .= "</div>\n";
        $resultat .= "<input type=\"hidden\" name=\"action\" value=\"poserPiece\" />";
        $resultat .= "<input type=\"hidden\" name=\"positionPiece\" value=\"$position\" />";
        $resultat .="</form>";
        $resultat .= self::getFormBoutonAnnuler();
        return $resultat;
    }

    /**
     * @return string
     */
    public static function getFormBoutonAnnuler() : string {
        return "<form style=\"text-align: center;\"><button class=\"quantik-btn quantik-btn-undo\" type=\"submit\" name=\"action\" value=\"annulerChoix\">Annuler choix</button></form>";
    }

    /**
     * @param int $couleur
     * @return string
     */
    public static function getDivMessageVictoire(int $couleur): string {   
        $couleurGagnant = ($couleur == PieceQuantik::WHITE)?'BLANC':'NOIR';
        $resultat = "<h1 class=\"quantik-end-msg\">FIN DE PARTIE, GAGNANT : " . $couleurGagnant . "</h1>";
        return $resultat;
    }

    /**
     * @return string
     */
    public static function getLienRecommencer(): string {
        return "<p class=\"quantik-reset\"><a href='?reset'> Recommencer ?</a></p>";
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageSelectionPiece(array $lesPiecesDispos, int $couleurActive, PlateauQuantik $plateau): string {
        $pageHTML = self::getDebutHTML();
        
        $piecesActives = $lesPiecesDispos[$couleurActive];
        unset($lesPiecesDispos[$couleurActive]);
        $pieceNonActive = array_shift($lesPiecesDispos);
//        $pageHTML .= "<div class ='block-piece'>";
        $pageHTML .= self::getDivPiecesDisponibles($pieceNonActive);
        $pageHTML .= self::getFormSelectionPiece($piecesActives);
//        $pageHTML .= "</div>";
//        $pageHTML .= "<div class ='block-plateau'>";
        $pageHTML .= self::getDivPlateauQuantik($plateau);
//        $pageHTML .= "</div>";
        return $pageHTML. self::getFinHTML();
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param int $posSelection position de la pièce sélectionnée dans la couleur active
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPagePosePiece(array $lesPiecesDispos, int $couleurActive, int $posSelection, PlateauQuantik $plateau): string {
        $pageHTML = self::getDebutHTML();

        $piecesActives = $lesPiecesDispos[$couleurActive];
        array_splice($lesPiecesDispos, $couleurActive, 1);
        $pieceNonActive = array_shift($lesPiecesDispos);
        
        $pieceAPoser = $piecesActives->getPieceQuantik($posSelection);
//        $pageHTML .= "<div class ='block-piece'>";
        $pageHTML .= self::getDivPiecesDisponibles($pieceNonActive);
        $pageHTML .= self::getDivPiecesDisponibles($piecesActives, $posSelection);
//        $pageHTML .= "</div>";
//        $pageHTML .= "<div class ='block-plateau'>";
        $pageHTML .= self::getFormPlateauQuantik($plateau, $pieceAPoser, $posSelection);
//        $pageHTML .= "</div>";
        return $pageHTML . self::getFinHTML();
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param int $posSelection
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageVictoire(array $lesPiecesDispos, int $couleurActive, PlateauQuantik $plateau): string {
        $pageHTML = self::getDebutHTML();

        $pageHTML .= self::getDivMessageVictoire($couleurActive);
        $pageHTML .= self::getLienRecommencer();

        $piecesActives = $lesPiecesDispos[$couleurActive];
        unset($lesPiecesDispos[$couleurActive]);
        $pieceNonActive = array_shift($lesPiecesDispos);
//        $pageHTML .= "<div class ='block-piece'>";
        $pageHTML .= self::getDivPiecesDisponibles($pieceNonActive);
        $pageHTML .= self::getDivPiecesDisponibles($piecesActives);
//        $pageHTML .= "</div>";
//        $pageHTML .= "<div class ='block-plateau'>";
        $pageHTML .= self::getDivPlateauQuantik($plateau);
//        $pageHTML .= "</div>";
        return $pageHTML . self::getFinHTML();

    }

}
