<?php

require_once "PlateauQuantik.php";
require_once "ArrayPieceQuantik.php";

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
        <h1 class=\"quantik\">$title</h1>
        <div class='quantik'>\n";
    }

    /**
     * @return string
     */
    public static function getFinHTML(): string
    {
        return "</div></body>\n</html>";
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

        $resultat ="";
        $resultat = "<table>\n";
        for ( $i = 0; $i < PlateauQuantik::NBROWS; $i++ ) {
            $resultat .= "<tr>\n";
            for ($y = 0; $y < PlateauQuantik::NBCOLS; $y++ ) {
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
        $resultat = "<form><div>";
        for($i = 0; $i < $apq->getTaille(); $i++)
            $resultat .= "<button class=\"quantik-btn\" type=\"submit\" value=\"$i\" name=\"active\">". $apq->getPieceQuantik($i) ."</button>";
        $resultat .= "<input type=\"hidden\" name=\"action\" value=\"choisirPiece\" />";
        $resultat .= "</div></form>";
        return $resultat;
    }

    /**
     * @param PlateauQuantik $plateau
     * @param PieceQuantik $piece
     * @param int $position position de la pièce qui sera posée en vue de la transmettre via un champ caché du formulaire
     * @return string
     */
    public static function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece, int $position): string {
        $resultat ="";
        /* TODO code du formaire de pose associé au plateau */
        $action = new ActionQuantik($plateau);
        $resultat = "<form>";
        $resultat .= "<table>";
        for ( $i = 0; $i < PlateauQuantik::NBROWS; $i++ ) {
            $resultat .= "<tr>";
            for ($y = 0; $y < PlateauQuantik::NBCOLS; $y++ ) {
                if ( $action->isValidePose($i, $y, $piece) )
                    $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" value=\"$i-$y\">(".$plateau->getPiece($i, $y).")</button></td>";
                else
                    $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" disabled>(".$plateau->getPiece($i, $y).")</button></td>";
            }
            $resultat .= "</tr>";
        }
        // ajout d'un formulaire pour modifier le choix de la pièce à poser
        unset($action);
        $resultat .= "</table>";
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
        /* TODO */
        return "<div>  formulaire pour changer de pièce</div>";
    }

    /**
     * @param int $couleur
     * @return string
     */
    public static function getDivMessageVictoire(int $couleur) : string {
        /* TODO div annonçant la couleur victorieuse et proposant un lien pour recommencer une nouvelle partie */
        $resultat ="";
        return $resultat;
    }

    /**
     * @return string
     */
    public static function getLienRecommencer():string {
        /* TODO production d'un lien pour recommencer une partie */
        return "<p><a href=''> Recommencer ?</a></p>";
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageSelectionPiece(array $lesPiecesDispos, int $couleurActive, PlateauQuantik $plateau): string {
        $pageHTML = QuantikUIGenerator::getDebutHTML();

        /* TODO production de la page permettant de sélectionner une pièce */

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
        $pageHTML = QuantikUIGenerator::getDebutHTML();

        /* TODO production de la page permettant de poser une pièce */

        return $pageHTML . self::getFinHTML();
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param int $posSelection
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageVictoire(array $lesPiecesDispos, int $couleurActive, int $posSelection, PlateauQuantik $plateau): string {
        $pageHTML = QuantikUIGenerator::getDebutHTML();

        /* TODO */

        return $pageHTML . self::getFinHTML();

    }

}