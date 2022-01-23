<?php
//require "ActionQuantik.php";
//require "ArrayPieceQuantik.php";
//require "PieceQuantik.php";
class Poker
{

    public function getDebutHTML(): string{
        return " 
            <!doctype html>
            <html lang='fr'>
            <head>
                <meta charset='UTF-8''>
                <title>Jeu de Quantik</title>
                <link rel='stylesheet' href='../Style/Quantik.css' >
            </head>
            <body>
            <div class='corps'></div>
            <h1>Quantik</h1>
           
        ";
    }
    public function getFinHTML(): string{

        return
            "</div>
            </body>
            </html>";
    }
    public function getDivPiecesDisponibles(ArrayPieceQuantik $piece):string{
      //  $piece = ArrayPieceQuantik::initPiecesBlanches();
        $result = "
            <form action='".$_SERVER['PHP_SELF']."' method='get'>
            <div class='pieceB'>
                <fieldset>
                    <legend>Formulaire des Pieces Blanches</legend>";
        for ($i = 0; $i< $piece->getTaille();$i++){
            if ($i == 0) $result.="<button type='submit' name='active' value='".$i."' disabled >(Co:B)</button>";
            if ($i == 1) $result.="<button type='submit' name='active' value='".$i."' disabled >(Co:B)</button>";
            if ($i == 2) $result.="<button type='submit' name='active' value='".$i."' disabled >(Cu:B)</button>";
            if ($i == 3) $result.="<button type='submit' name='active' value='".$i."' disabled >(Cu:B)</button>";
            if ($i == 4) $result.="<button type='submit' name='active' value='".$i."' disabled >(Cy:B)</button>";
            if ($i == 5) $result.="<button type='submit' name='active' value='".$i."' disabled >(Cy:B)</button>";
            if ($i == 6) $result.="<button type='submit' name='active' value='".$i."' disabled >(Sp:B)</button>";
            if ($i == 7) $result.="<button type='submit' name='active' value='".$i."' disabled >(Sp:B)</button>";
        }
        $result.= "</fieldset></div></form>" ;
        return $result;
    }
    public function  getFormSelectionPiece(ArrayPieceQuantik $piece):string{
        $piece =  ArrayPieceQuantik::initPiecesBlanches();
        $result = "
            <form action='".$_SERVER['PHP_SELF']."' method='get'>
            <div class='pieceW'>
                <fieldset>
                    <legend>Formulaire des Pieces Blanches</legend>";
                    for ($i = 0; $i< $piece->getTaille();$i++){
                        if ($i == 0) $result.="<button type='submit' name='active' value='".$i."' >(Co:W)</button>";
                        if ($i == 1) $result.="<button type='submit' name='active' value='".$i."' >(Co:W)</button>";
                        if ($i == 2) $result.="<button type='submit' name='active' value='".$i."' >(Cu:W)</button>";
                        if ($i == 3) $result.="<button type='submit' name='active' value='".$i."' >(Cu:W)</button>";
                        if ($i == 4) $result.="<button type='submit' name='active' value='".$i."' >(Cy:W)</button>";
                        if ($i == 5) $result.="<button type='submit' name='active' value='".$i."' >(Cy:W)</button>";
                        if ($i == 6) $result.="<button type='submit' name='active' value='".$i."' >(Sp:W)</button>";
                        if ($i == 7) $result.="<button type='submit' name='active' value='".$i."' >(Sp:W)</button>";
                    }
               $result.= "</fieldset></div></form>" ;
                return $result;
    }
    public function getDivPlateauQuantik(PlateauQuantik $p): string{

        $resultat = "<div class='plateau'> <table>\n";
        for ( $i = 0; $i < PlateauQuantik::NBROWS; $i++ ) {
            $resultat .= "<tr>\n";
            for ($y = 0; $y < PlateauQuantik::NBCOLS; $y++ ) {
                $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" disabled>(".$i.','.$y.")</button></td>\n";
            }
            $resultat .= "</tr>\n";
        }
        $resultat .= "</table></div>";
        return $resultat;
    }
//    public function getFormPlateauQuantik(PlateauQuantik $p, PieceQuantik $pieceQuantik): string{
//        $resultat ="";
//        $action = new ActionQuantik($p);
//        $resultat = "<form>";
//        $resultat .= "<table>";
//        for ( $i = 0; $i < PlateauQuantik::NBROWS; $i++ ) {
//            $resultat .= "<tr>";
//            for ($y = 0; $y < PlateauQuantik::NBCOLS; $y++ ) {
//                if ( $action->isValidePose($i, $y, $pieceQuantik) == true )
//                    $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" value=\"$i-$y\">(".$p->getPiece($i, $y).")</button></td>";
//                else
//                    $resultat .= "<td><button class=\"quantik-btn\" type=\"submit\" name=\"active\" disabled>(".$p->getPiece($i, $y).")</button></td>";
//            }
//            $resultat .= "</tr>";
//        }
//        return $resultat;
//    }


    public static function getPageAccueil(ArrayPieceQuantik $a,PieceQuantik $piece, PlateauQuantik $plateau): string {
        $pageHTML = self::getDebutHTML();

        ?>
        <div class="clock-piece">
            <?php
            $pageHTML .= self::getDivPiecesDisponibles($a::initPiecesBlanches());
            $pageHTML .= self::getFormSelectionPiece($a::initPiecesNoires());
            ?>
        </div>
        <div class="clock-plateau">
            <?php
            $pageHTML .= self::getDivPlateauQuantik($plateau);
            //$pageHTML .=self::getFormPlateauQuantik();
            ?>

        </div>
        <?php
        return $pageHTML.self::getFinHTML();
    }

}

