<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta author="Alessandro Russo">
    <title>Risultato</title>
    <link rel="shortcut icon" href="https://digilander.libero.it/Detective_mistery/icon_site.ico">
    <style type="text/css">
    .container{
        margin:30px auto;
        overflow: hidden;
      }
    .sinistro, .destro {
        margin:0;
        padding:0;
        height: auto;
        text-align:right;
      }
    .sinistro{float:left;}

    .destro{float:right;}
    </style>
  </head>
  <body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
    <h1 align='center'>Risultato</h1>
    <h5 align='center'>(© Alessandro Russo - 2019)</h5>
    <?php
      $valore1_bin =  $_POST["valore1"];
      $valore2_bin =  $_POST["valore2"];
      $operatore =  $_POST["operatore"];

      $valore1_dec = bindec($valore1_bin);
      $valore2_dec = bindec($valore2_bin);

      switch ($operatore)
      {
        case 'somma':
          $risultato_dec = $valore1_dec + $valore2_dec;
          $op = "+";
          break;
        case 'sottrazione':
          if($valore2_dec > $valore1_dec)
          {
            $risultato_dec = $valore2_dec + $valore1_dec;
            $tipo = "negativo";
          }
          else
          {
            $risultato_dec = $valore1_dec - $valore2_dec;
            $tipo = "positivo";
          }
          $op = "-";
          break;
        case 'moltiplicazione':
          $risultato_dec = $valore1_dec * $valore2_dec;
          $op = "*";
          break;
        case 'divisione':
          $risultato_dec = $valore1_dec / $valore2_dec;
          $risultato_dec = round($risultato_dec, 1);
          $op = "/";
          break;
        default:
          $risultato_dec = NULL;
          break;
      }

      $risultato_bin = decbin($risultato_dec);

      function passprodotto_bin($moltiplicando, $moltiplicatore)
      {
        $lengthmoltiplicatore = strlen($moltiplicatore);
        $lengthmoltiplicando = strlen($moltiplicando);
        $zeri = "";
        for($x = 0; $x<$lengthmoltiplicando; $x++)
        {
          $zeri = $zeri . "0";
        }
        $vettore = [];

        for($j = 0; $j<$lengthmoltiplicatore; $j++)
        {
          $livello = substr($moltiplicatore,$j,1);

          if($livello == "1")
          {
            $vettore[] = $moltiplicando;
          }
          else if($livello == "0")
          {
            $vettore[] = $zeri;
          }
        }

        $rvettore = array_reverse($vettore);

       return ($rvettore);
      }

      function polinomio($numero)
      {
        $lengthnumero = strlen($numero);

        $esponente_ris = $lengthnumero;

        $stringa = "";
        for($i = 0; $i<$lengthnumero-1; $i++)
        {
          $cifra = $numero[$i];

          $esponente_ris = $esponente_ris-1;
          $esponente_use = $esponente_ris;
          $esponente_use = strval($esponente_use);

          $stringa = $stringa . "<strong>" . $cifra . "</strong>" . " * 2 <sup><strong>" . $esponente_use . "</sup></strong> + ";
        }

        $stringa = $stringa . "<strong>" . $numero[$lengthnumero-1] . "</strong>" . " * 2 <sup><strong>0</strong></sup> ";

        return $stringa;
      }

      function passprodotto_dec($moltiplicando_dec, $moltiplicatore_dec)
      {
          $smoltiplicatore_dec = strval($moltiplicatore_dec);
          $lengthmoltiplicatore_dec = strlen($smoltiplicatore_dec);

          $vector = [];
          for($b = 0; $b<$lengthmoltiplicatore_dec; $b++)
          {
            $livello5 = substr($moltiplicatore_dec,$b,1);

            $intlivello5 = intval($livello5);

            $prodotto = $intlivello5 * $moltiplicando_dec;
            $vector[] = $prodotto;
          }
          $rvector = array_reverse($vector);

          return $rvector;
      }

      function complemento($tocomplemento)
      {
        $lengthtocomplemento = strlen($tocomplemento);
        $tocomplemento = strval($tocomplemento);

        $svalore2_bin = "";
        for($d=0; $d<$lengthtocomplemento; $d++)
        {
          $indice = substr($tocomplemento,$d,1);

          if($indice == "1")
          {
            $svalore2_bin = $svalore2_bin . "0";
          }
          else if($indice == "0")
          {
            $svalore2_bin = $svalore2_bin . "1";
          }
        }
        $svalore2_bin = intval($svalore2_bin);
        $svalore2_dec = bindec($svalore2_bin);
        $svalore2_dec = $svalore2_dec + 1;
        $complementare = decbin($svalore2_dec);
        $complementare = strval($complementare);

        return $complementare;
      }

      function sommacomplemento($addendo1, $addendo2)
      {
        $addendo1 = intval($addendo1);
        $addendo2 = intval($addendo2);
        $addendo1 = bindec($addendo1);
        $addendo2 = bindec($addendo2);

        $sommac = $addendo1 + $addendo2;

        $sommac = decbin($sommac);
        $sommac = strval($sommac);

        $lengthsommac = strlen($sommac);

        $sommac = substr($sommac,1,$lengthsommac-1);

        return $sommac;
      }

      if($operatore == 'somma')
      {
        $openfrase = "<p>La <strong>somma</strong> tra <strong>" . $valore1_bin . "</strong> e <strong>" . $valore2_bin . "</strong> è: <strong>" . $risultato_bin . "</strong>.</p>";
      }
      else if($operatore == 'sottrazione')
      {
        if($tipo == "positivo")
        {
          $vcomplemento = complemento($valore2_bin);
          $sommacomplemento = sommacomplemento($valore1_bin, $vcomplemento);
          $openfrase = "<p>La <strong>differenza</strong> tra <strong>" . $valore1_bin . "</strong> e <strong>" . $valore2_bin . "</strong> è: <strong>" . $risultato_bin . "</strong>.</p>
          <p>Il <strong>complemento</strong> a <strong>2</strong> di <strong>" . $valore2_bin . "</strong> è: <strong>" . $vcomplemento . "</strong>.</p>
          <p>La <strong>somma</strong> tra <strong>" . $valore1_bin . "</strong> e il <strong>complemento</strong> a <strong>2</strong> di <strong>" . $valore2_bin . "</strong> (<strong>" . $vcomplemento . "</strong>) è: <strong>" . $sommacomplemento . "</strong>. </p>";
        }
        else if($tipo == "negativo")
        {
          $openfrase = "<p>La <strong>differenza</strong> tra <strong>" . $valore1_bin . "</strong> e <strong>" . $valore2_bin . "</strong> è: <strong>− " . $risultato_bin . "</strong>.</p>";
        }
      }
      else if($operatore == 'moltiplicazione')
      {
        $openfrase = "<p>Il <strong>prodotto</strong> tra <strong>" . $valore1_bin . "</strong> e <strong>" . $valore2_bin . "</strong> è: <strong>" . $risultato_bin . "</strong>.</p>";
      }
      else if($operatore == 'divisione')
      {
        $openfrase = "<p>La <strong>divisione</strong> di <strong>" . $valore1_bin . "</strong> per <strong>" . $valore2_bin . "</strong> è: <strong>" . $risultato_bin . "</strong>.</p>";

      }

      if($operatore == 'moltiplicazione')
      {
        echo ($openfrase);
        echo ("<div class='container'>");
        echo ("<div class='sinistro' style='width: 13%' float: left'>");
        echo ("<p align='right'><strong>" . $valore1_bin . "</strong> " . $op . "</p>");
        echo ("<p align='right'><strong>" . $valore2_bin . "</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        $step = passprodotto_bin($valore1_bin, $valore2_bin);
        $lengthvalore2_bin = strlen($valore2_bin);
        for($t=0; $t<$lengthvalore2_bin-1; $t++)
        {
          $azzeraggio = "";
          for($h=0; $h<$t; $h++)
          {
            $azzeraggio = $azzeraggio . "-";
          }
          echo ("<p align='right'><strong>" . $step[$t] . $azzeraggio . "</strong> +</p>");
        }
        echo ("<p align='right'><strong>" . $step[$lengthvalore2_bin-1] . $azzeraggio . "-</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        echo ("<p align='right'><strong>" . $risultato_bin . "</strong>&ensp;&nbsp;</p>");
        echo ("</div>");
        echo ("<div class='sinistro' style='width: 13%; float: left'>");
        echo ("<p align='right'><strong>" . $valore1_dec . "</strong> " . $op . "</p>");
        echo ("<p align='right'><strong>" . $valore2_dec . "</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        if($valore2_dec > 9)
        {
          $step2 = passprodotto_dec($valore1_dec, $valore2_dec);
          $lengthvalore2_dec = strlen($valore2_dec);
          for($c=0; $c<$lengthvalore2_dec-1; $c++)
          {
            $azzeraggio = "";
            for($f=0; $f<$c; $f++)
            {
              $azzeraggio = $azzeraggio . "-";
            }
            echo ("<p align='right'><strong>" . $step2[$c] . $azzeraggio . "</strong> +</p>");
          }
          echo ("<p align='right'><strong>" . $step2[$lengthvalore2_dec-1] . $azzeraggio . "-</strong> =</p>");
          echo ("<p align='right'>" . "__________" . "</p>");
        }
        echo ("<p align='right'><strong>" . $risultato_dec . "</strong>&ensp;&nbsp;</p>");
        echo ("</div>");
        echo ("</div>");
        echo ("<br/>");
        echo ("<br/>");
        echo ("<div>");
        echo ("<p><strong>" . $valore1_bin . "</strong> ==> " . polinomio($valore1_bin) . " ==> <strong>" . $valore1_dec . "</strong></p>");
        echo ("<p><strong>" . $valore2_bin . "</strong> ==> " . polinomio($valore2_bin) . " ==> <strong>" . $valore2_dec . "</strong></p>");
        $rvalore2_bin = strrev($valore2_bin);
        for($z=0; $z<$lengthvalore2_bin; $z++)
        {
          $livello3 = substr($rvalore2_bin,$z,1);
          if($livello3 == "0")
          {
            $risdec = "0";
          }
          else if($livello3 == "1")
          {
            $risdec = $valore1_dec;
          }
          echo ("<p><strong>" . $step[$z] . "</strong> ==> " . polinomio($step[$z]) . " ==> <strong>" . $risdec . "</strong></p>");
        }
        echo ("<p><strong>" . $risultato_bin . "</strong> ==> " . polinomio($risultato_bin) . " ==> <strong>" . $risultato_dec . "</strong></p>");
        echo ("</div>");
      }
      else if ($operatore == 'sottrazione')
      {
        echo ($openfrase);
        echo ("<div class='container'>");
        echo ("<div class='destro' style='width: 13%; float: left'>");
        echo ("<p align='right'><strong>" . $valore1_bin . "</strong> " . $op . "</p>");
        echo ("<p align='right'><strong>" . $valore2_bin . "</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        if($tipo == "negativo")
        {
          echo ("<p align='right'><strong>− " . $risultato_bin . "</strong>&ensp;&nbsp;</p>");
        }
        else if($tipo == "positivo")
        {
          echo ("<p align='right'><strong>" . $risultato_bin . "</strong>&ensp;&nbsp;</p>");
        }
        echo ("</div>");
        echo ("<div class='sinistro' style='width: 13%; float: left'>");
        echo ("<p align='right'><strong>" . $valore1_dec . "</strong> " . $op . "</p>");
        echo ("<p align='right'><strong>" . $valore2_dec . "</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        if($tipo == "negativo")
        {
          echo ("<p align='right'><strong>− " . $risultato_dec . "</strong>&ensp;&nbsp;</p>");
        }
        else if($tipo == "positivo")
        {
          echo ("<p align='right'><strong>" . $risultato_dec . "</strong>&ensp;&nbsp;</p>");
        }
        echo ("</div>");
        if($tipo == "positivo")
        {
          echo ("<div class='sinistro' style='width: 13%; float: left'>");
          echo ("<p align='right'><strong>" . $valore1_bin . "</strong> +</p>");
          echo ("<p align='right'><strong>" . $vcomplemento . "</strong> =</p>");
          echo ("<p align='right'>" . "__________" . "</p>");
          echo ("<p align='right'><strong>" . $sommacomplemento . "</strong>&ensp;&nbsp;</p>");
          echo ("</div>");
        }
        echo ("</div>");
        echo ("<br/>");
        echo ("<br/>");
        echo ("<div>");
        echo ("<p><strong>" . $valore1_bin . "</strong> ==> " . polinomio($valore1_bin) . " ==> <strong>" . $valore1_dec . "</strong></p>");
        echo ("<p><strong>" . $valore2_bin . "</strong> ==> " . polinomio($valore2_bin) . " ==> <strong>" . $valore2_dec . "</strong></p>");
        if($tipo == "negativo")
        {
          echo ("<p><strong>− " . $risultato_bin . "</strong> ==> " . polinomio($risultato_bin) . " ==> <strong>− " . $risultato_dec . "</strong></p>");
        }
        else if($tipo == "positivo")
        {
          echo ("<p><strong>" . $risultato_bin . "</strong> ==> " . polinomio($risultato_bin) . " ==> <strong>" . $risultato_dec . "</strong></p>");
        }
        echo ("</div>");
      }
      else
      {
        echo ($openfrase);
        echo ("<div class='container'>");
        echo ("<div class='destro' style='width: 13%; float: left'>");
        echo ("<p align='right'><strong>" . $valore1_bin . "</strong> " . $op . "</p>");
        echo ("<p align='right'><strong>" . $valore2_bin . "</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        echo ("<p align='right'><strong>" . $risultato_bin . "</strong>&ensp;&nbsp;</p>");
        echo ("</div>");
        echo ("<div class='sinistro' style='width: 13%; float: left'>");
        echo ("<p align='right'><strong>" . $valore1_dec . "</strong> " . $op . "</p>");
        echo ("<p align='right'><strong>" . $valore2_dec . "</strong> =</p>");
        echo ("<p align='right'>" . "__________" . "</p>");
        echo ("<p align='right'><strong>" . $risultato_dec . "</strong>&ensp;&nbsp;</p>");
        echo ("</div>");
        echo ("</div>");
        echo ("<br/>");
        echo ("<br/>");
        echo ("<div>");
        echo ("<p><strong>" . $valore1_bin . "</strong> ==> " . polinomio($valore1_bin) . " ==> <strong>" . $valore1_dec . "</strong></p>");
        echo ("<p><strong>" . $valore2_bin . "</strong> ==> " . polinomio($valore2_bin) . " ==> <strong>" . $valore2_dec . "</strong></p>");
        echo ("<p><strong>" . $risultato_bin . "</strong> ==> " . polinomio($risultato_bin) . " ==> <strong>" . $risultato_dec . "</strong></p>");
        echo ("</div>");
      }
    ?>
  </body>
</html>
