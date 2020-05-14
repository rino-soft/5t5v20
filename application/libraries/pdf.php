<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//elaborado por Ruben Payrumani Ino necesitamos esto para funcionar y crear PDF
// Incluimos el archivo fpdf
require_once APPPATH . "helps/fpdf/fpdf.php";
include_once(APPPATH . 'helps/barcode/php-barcode.php');

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class pdf extends FPDF {

    var $widths;
    var $alings;
    var $fill;
    var $size;

    public function __construct() {
        parent::__construct();
    }

    // El encabezado del PDF
    public function Header() {
        /* /*$this->Image('imagenes/logo.png',10,8,22);
          $this->SetFont('Arial','B',13);
          $this->Cell(30);
          $this->Cell(120,10,'ESCUELA X',0,0,'C');
          $this->Ln('5');
          $this->SetFont('Arial','B',8);
          $this->Cell(30);
          $this->Cell(120,10,'INFORMACION DE CONTACTO',0,0,'C');
          $this->Ln(20); */
    }

    public function Header_logo_izq_sup($ahora) {
        $this->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');
        /* $this->Image('imagenes/logo.png',10,8,22); $this->SetFont('Arial','B',13);
          $this->Cell(30);
          $this->Cell(120,10,'ESCUELA X',0,0,'C');
          $this->Ln('5');
          $this->SetFont('Arial','B',8);
          $this->Cell(30);
          $this->Cell(120,10,'INFORMACION DE CONTACTO',0,0,'C');
          $this->Ln(20); */
    }

    // El pie del pdf
    public function Footer() {
        /*  $this->SetY(-15);
          $this->SetFont('Arial','I',8);
          $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C'); */
    }

    ////funcionde de extencion del FPDF/
    function SetWidths($w) {
        //Set the array of column widths 
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments 
        $this->aligns = $a;
    }

    function fill($f) {
        //juego de arreglos de relleno
        $this->fill = $f;
    }

    /* function fontSize($s) {
      $this->size = $s;
      } */

    function Row($data) {
        //Calculate the height of the row 
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 4 * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        $this->SetLineWidth(.1);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            //$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            //$this->Rect($x,$y,$w,$h,$style); 
            $this->Line($x, $y, $x, $y + $h);
            $this->Line($x + $w, $y, $x + $w, $y + $h);
            //Print the text 
            $this->MultiCell($w, 4, $data[$i], 0, $a, $fill);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.2);
        //Go to the next line 
        $this->Ln($h);
    }

    //***********************
    function Rowfinal($data) {
        //Calculate the height of the row 
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 4 * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        $this->SetLineWidth(.1);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            $this->Line($x, $y, $x, $y + $h);
            $this->Line($x + $w, $y, $x + $w, $y + $h);
            $this->Line($x, $y + $h, $x + $w, $y + $h);
            //Print the text 
            $this->MultiCell($w, 4, $data[$i], 0, $a, $fill);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.2);
        //Go to the next line 
        $this->Ln($h);
    }

    //************************


    function RowTitle($data, $f, $tc, $ln) {
        //echo 'entra';
        //Calculate the height of the row 
        //$this->SetFillColor($fill['r'],$fill['g'],$fill['b']);
        $this->SetFillColor($f[0], $f[1], $f[2]);
        $this->SetTextColor($tc[0], $tc[1], $tc[2]); //$fontC[0], $fontC[1], $fontC[2]);
        $this->SetDrawColor($ln[0], $ln[1], $ln[2]);
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 6 * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        //$this->SetLineWidth(.3);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            $this->Rect($x, $y, $w, $h, 'FD');
            // $this->Line($x, $y, $x, $y + $h);
            //  $this->Line($x + $w, $y, $x + $w, $y + $h);
            //Print the text 
            $this->MultiCell($w, 6, $data[$i], 0, 'C', false);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.2);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        //Go to the next line 
        $this->Ln($h);
    }

    function RowBody($data) {
        //Calculate the height of the row 
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 4.5 * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        //$this->SetLineWidth(.3);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //$s = isset($this->size[$i]) ? $this->size[$i] : '6.5';
            //$this->SetFont('Arial', '', $s);
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            //$this->Rect($x, $y, $w, $h, 'D');

            $this->Line($x, $y, $x, $y + $h);
            $this->Line($x + $w, $y, $x + $w, $y + $h);
            $this->SetDrawColor(200, 200, 200);
            $this->Line($x, $y + $h, $x + $w, $y + $h);
            $this->SetDrawColor(0, 0, 0);
//Print the text 

            $this->MultiCell($w, 4.5, $data[$i], 0, $a, false);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.2);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        //Go to the next line 
        $this->Ln($h);
    }

    function RowBodyFactura($data, $alto) {
        //Calculate the height of the row 
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $alto * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        //$this->SetLineWidth(.3);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //$s = isset($this->size[$i]) ? $this->size[$i] : '6.5';
            //$this->SetFont('Arial', '', $s);
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            //$this->Rect($x, $y, $w, $h, 'D');
            //    $this->Line($x, $y, $x, $y + $h);
            //    $this->Line($x + $w, $y, $x + $w, $y + $h);
            $this->SetDrawColor(200, 200, 200);
            $this->Line($x, $y + $h, $x + $w, $y + $h);
            $this->SetDrawColor(0, 0, 0);
//Print the text 

            $this->MultiCell($w, $alto, $data[$i], 0, $a, false);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.2);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        //Go to the next line 
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately 
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take 
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle = 0) {
        $font_angle+=90 + $txt_angle;
        $txt_angle*=M_PI / 180;
        $font_angle*=M_PI / 180;

        $txt_dx = cos($txt_angle);
        $txt_dy = sin($txt_angle);
        $font_dx = cos($font_angle);
        $font_dy = sin($font_angle);

        $s = sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', $txt_dx, $txt_dy, $font_dx, $font_dy, $x * $this->k, ($this->h - $y) * $this->k, $this->_escape($txt));
        if ($this->ColorFlag)
            $s = 'q ' . $this->TextColor . ' ' . $s . ' Q';
        $this->_out($s);
    }

    function RowBodyRendicion($data, $alto, $tam_font) {
        //Calculate the height of the row 
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $alto * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        //$this->SetLineWidth(.3);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //$s = isset($this->size[$i]) ? $this->size[$i] : '6.5';
            //$this->SetFont('Arial', '', $s);
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            //$this->Rect($x, $y, $w, $h, 'D');
            //  $this->Line($x, $y, $x, $y + $h);
            // $this->Line($x + $w, $y, $x + $w, $y + $h);
            $this->SetDrawColor(300, 300, 300); //(200,200,200)
            $this->Line($x, $y + $h, $x + $w, $y + $h);
            $this->SetDrawColor(0, 0, 0);
//Print the text 
            $this->SetFont('Arial', '', $tam_font[$i]);
            $this->MultiCell($w, $alto, $data[$i], 0, $a, false);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.1);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        //Go to the next line 
        $this->Ln($h);
    }

    function RowBodyResumen($data, $alto, $tam_font, $format, $line) {
        //Calculate the height of the row 
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.5);
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $alto * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        //$this->SetLineWidth(.3);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //$s = isset($this->size[$i]) ? $this->size[$i] : '6.5';
            //$this->SetFont('Arial', '', $s);
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            //$this->Rect($x, $y, $w, $h, 'D');
            //  $this->Line($x, $y, $x, $y + $h);
            // $this->Line($x + $w, $y, $x + $w, $y + $h);
            if ($line == 1) {
                $this->SetDrawColor(200, 90, 90); //(200,200,200)
                $this->Line($x, $y + $h, $x + $w, $y + $h);
                $this->SetDrawColor(0, 0, 0);
            }

//Print the text 
            $this->SetFont('Arial', $format[$i], $tam_font[$i]);
            $this->MultiCell($w, $alto, $data[$i], 0, $a, false);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.1);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        //Go to the next line 
        $this->Ln($h);
    }

    function RowBodyResumen2($data, $alto, $tam_font) {
        //Calculate the height of the row 
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $alto * $nb;
        //Issue a page break first if needed 
        $this->CheckPageBreak($h);
        //Draw the cells of the row 
        //$this->SetLineWidth(.3);
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //$s = isset($this->size[$i]) ? $this->size[$i] : '6.5';
            //$this->SetFont('Arial', '', $s);
            //Save the current position 
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border 
            //$this->Rect($x, $y, $w, $h, 'D');
            //  $this->Line($x, $y, $x, $y + $h);
            // $this->Line($x + $w, $y, $x + $w, $y + $h);
            $this->SetDrawColor(200, 200, 200); //(200,200,200)
            $this->Line($x, $y + $h, $x + $w, $y + $h);
            $this->SetDrawColor(0, 0, 0);
//Print the text 
            $this->SetFont('Arial', '', $tam_font[$i]);
            $this->MultiCell($w, $alto, $data[$i], 0, $a, false);
            //Put the position to the right of the cell 
            $this->SetXY($x + $w, $y);
        }
        $this->SetLineWidth(.1);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        //Go to the next line 
        $this->Ln($h);
    }

}

?>
