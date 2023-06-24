<?php 
    function getPeriode($st)
    {
        switch (substr($st, 2,2))
        {
            case 1  : $bln = "Januari";   break;
            case 2  : $bln = "Februari";  break;
            case 3  : $bln = "Maret";     break;
            case 4  : $bln = "April";     break;
            case 5  : $bln = "Mei";       break;
            case 6  : $bln = "Juni";      break;
            case 7  : $bln = "Juli";      break;
            case 8  : $bln = "Agustus";   break;
            case 9  : $bln = "September"; break;
            case 10 : $bln = "Oktober";   break;
            case 11 : $bln = "November";  break;
            case 12 : $bln = "Desember";  break;
            default : $bln = "???";
        }
        
        return $bln . "20" . substr($st, 0,2);
    }

    function nextPrd($st)
    {
        $th = substr($st, 0, 2);
        $bl = substr($st, 2, 2) + 1;

        if ($bl > 12)
        {
            $bl = 1;
            $th++;
        }

        return $th . str_pad($bl, 2, "0", 0);
    }
?>