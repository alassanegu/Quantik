<?php

require "ActionQuantik.php";
require "../SkelQuantik/QuantikUIGenerator.php";
//$plateau = new PlateauQuantik();
//$p = new ArrayPieceQuantik();
//$pieces = array();
//$pieces[1] = 1;
//$couleur = PieceQuantik::WHITE;
//$quantik = QuantikUIGenerator::getPageSelectionPiece($pieces,$couleur,$plateau);

//
//echo "</br>"."-----------------------------Test du classe PieceQuantik--------------------"."</br>";
//echo PieceQuantik::initBlackCube();
//echo PieceQuantik::initVoid();
//
//
//echo "</br>"."-----------------------------Test du classe ArrayQuantik--------------------"."</br>";
//$arayPiece = new ArrayPieceQuantik();
//$arayPiece->addPieceQuantik(PieceQuantik::initBlackCube());
//$arayPiece->addPieceQuantik(PieceQuantik::initWhiteCone());
//$arayPiece->addPieceQuantik(PieceQuantik::initWhiteSphere());
//echo $arayPiece;
//$arayPiece->removePieceQuantik(1);
//echo $arayPiece;
//
////Pour afficher les 8 pieces Noires
//echo $arayPiece::initPiecesNoires();
//
//
//echo "</br>"."-----------------------------Test du classe PlateauQuantik--------------------"."</br>";
//$platPiece = new PlateauQuantik();
//$arrNoire = ArrayPieceQuantik::initPiecesNoires();
//$arrBlanche = ArrayPieceQuantik::initPiecesBlanches();
//$platPiece->setPiece(0,0, $arrNoire->getPiecesQuantiks(0));
//$platPiece->setPiece(0,1, $arrNoire->getPiecesQuantiks(1));
//$platPiece->setPiece(0,2, $arrNoire->getPiecesQuantiks(2));
//$platPiece->setPiece(0,3, $arrNoire->getPiecesQuantiks(3));
//$platPiece->setPiece(1,0, $arrBlanche->getPiecesQuantiks(0));
//$platPiece->setPiece(1,1, $arrBlanche->getPiecesQuantiks(1));
//$platPiece->setPiece(1,2, $arrBlanche->getPiecesQuantiks(2));
//$platPiece->setPiece(1,3, $arrBlanche->getPiecesQuantiks(3));
//$platPiece->setPiece(2,0, $arrNoire->getPiecesQuantiks(4));
//$platPiece->setPiece(2,1, $arrNoire->getPiecesQuantiks(5));
//$platPiece->setPiece(2,2, $arrNoire->getPiecesQuantiks(6));
//$platPiece->setPiece(2,3, $arrNoire->getPiecesQuantiks(7));
//$platPiece->setPiece(3,0, $arrBlanche->getPiecesQuantiks(4));
//$platPiece->setPiece(3,1, $arrBlanche->getPiecesQuantiks(5));
//$platPiece->setPiece(3,2, $arrBlanche->getPiecesQuantiks(6));
//$platPiece->setPiece(3,3, $arrBlanche->getPiecesQuantiks(7));
//echo $platPiece;
//echo PlateauQuantik::getCornerFromCoord(2,2);
//
//
//echo "</br>"."-----------------------------Test du classe ActionQuantik--------------------"."</br>";
//$platPiece = new PlateauQuantik();
//$arrNoire = ArrayPieceQuantik::initPiecesNoires();
//$arrBlanche = ArrayPieceQuantik::initPiecesBlanches();
//$platPiece->setPiece(0,0, $arrNoire->getPiecesQuantiks(0));
//$platPiece->setPiece(0,1, $arrNoire->getPiecesQuantiks(1));
//$platPiece->setPiece(0,2, $arrNoire->getPiecesQuantiks(2));
//$platPiece->setPiece(0,3, $arrNoire->getPiecesQuantiks(3));
//$platPiece->setPiece(1,0, $arrBlanche->getPiecesQuantiks(0));
//$platPiece->setPiece(1,1, $arrBlanche->getPiecesQuantiks(1));
//$platPiece->setPiece(1,2, $arrBlanche->getPiecesQuantiks(2));
//$platPiece->setPiece(1,3, $arrBlanche->getPiecesQuantiks(3));
//$platPiece->setPiece(2,0, $arrNoire->getPiecesQuantiks(4));
//$platPiece->setPiece(2,1, $arrNoire->getPiecesQuantiks(5));
//$platPiece->setPiece(2,2, $arrNoire->getPiecesQuantiks(6));
//$platPiece->setPiece(2,3, $arrNoire->getPiecesQuantiks(7));
//$platPiece->setPiece(3,0, $arrBlanche->getPiecesQuantiks(4));
//$platPiece->setPiece(3,1, $arrBlanche->getPiecesQuantiks(5));
//$platPiece->setPiece(3,2, $arrBlanche->getPiecesQuantiks(6));
//$platPiece->setPiece(3,3, $arrBlanche->getPiecesQuantiks(7));
//
//
//echo "</br>"."-----------------------------Test du classe PlateauQuantik--------------------"."</br>";
//$platPiece = new PlateauQuantik();
//$arrNoire = ArrayPieceQuantik::initPiecesNoires();
//$arrBlanche = ArrayPieceQuantik::initPiecesBlanches();
//$platPiece->setPiece(0,0, $arrNoire->getPiecesQuantiks(0));
//$platPiece->setPiece(0,1, $arrNoire->getPiecesQuantiks(1));
//$platPiece->setPiece(0,2, $arrNoire->getPiecesQuantiks(2));
//$platPiece->setPiece(0,3, $arrNoire->getPiecesQuantiks(3));
//$platPiece->setPiece(1,0, $arrBlanche->getPiecesQuantiks(0));
//$platPiece->setPiece(1,1, $arrBlanche->getPiecesQuantiks(1));
//$platPiece->setPiece(1,2, $arrBlanche->getPiecesQuantiks(2));
//$platPiece->setPiece(1,3, $arrBlanche->getPiecesQuantiks(3));
//$platPiece->setPiece(2,0, $arrNoire->getPiecesQuantiks(4));
//$platPiece->setPiece(2,1, $arrNoire->getPiecesQuantiks(5));
//$platPiece->setPiece(2,2, $arrNoire->getPiecesQuantiks(6));
//$platPiece->setPiece(2,3, $arrNoire->getPiecesQuantiks(7));
//$platPiece->setPiece(3,0, $arrBlanche->getPiecesQuantiks(4));
//$platPiece->setPiece(3,1, $arrBlanche->getPiecesQuantiks(5));
//$platPiece->setPiece(3,2, $arrBlanche->getPiecesQuantiks(6));
//$platPiece->setPiece(3,3, $arrBlanche->getPiecesQuantiks(7));
//echo $platPiece;
//echo PlateauQuantik::getCornerFromCoord(2,2);
//
//
//echo "</br>"."-----------------------------Test du classe ActionQuantik--------------------"."</br>";
//$platPiece = new PlateauQuantik();
//$arrNoire = ArrayPieceQuantik::initPiecesNoires();
//$arrBlanche = ArrayPieceQuantik::initPiecesBlanches();
//$platPiece->setPiece(0,0, $arrNoire->getPiecesQuantiks(0));
//$platPiece->setPiece(0,1, $arrNoire->getPiecesQuantiks(1));
//$platPiece->setPiece(0,2, $arrNoire->getPiecesQuantiks(2));
//$platPiece->setPiece(0,3, $arrNoire->getPiecesQuantiks(3));
//$platPiece->setPiece(1,0, $arrBlanche->getPiecesQuantiks(0));
//$platPiece->setPiece(1,1, $arrBlanche->getPiecesQuantiks(1));
//$platPiece->setPiece(1,2, $arrBlanche->getPiecesQuantiks(2));
//$platPiece->setPiece(1,3, $arrBlanche->getPiecesQuantiks(3));
//$platPiece->setPiece(2,0, $arrNoire->getPiecesQuantiks(4));
//$platPiece->setPiece(2,1, $arrNoire->getPiecesQuantiks(5));
//$platPiece->setPiece(2,2, $arrNoire->getPiecesQuantiks(6));
//$platPiece->setPiece(2,3, $arrNoire->getPiecesQuantiks(7));
//$platPiece->setPiece(3,0, $arrBlanche->getPiecesQuantiks(4));
//$platPiece->setPiece(3,1, $arrBlanche->getPiecesQuantiks(5));
//$platPiece->setPiece(3,2, $arrBlanche->getPiecesQuantiks(6));
//$platPiece->setPiece(3,3, $arrBlanche->getPiecesQuantiks(7));
//
//$actionQuantik = new ActionQuantik($platPiece);
//echo $actionQuantik;