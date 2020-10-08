<?php

?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Calendario Gerard Tinoco</title>
	<meta charset="utf-8">
	<style>
	</style>
</head>
 
<body>
	<?php

    $mes=date("n");
    $año=date("Y");
    $diaActual=date("j");
    $diaSemana=date("w",mktime(0,0,0,$mes,1,$año))+7;
    $ultimoDiaMes=date("d",(mktime(0,0,0,$mes+1,1,$año)-1));
 
    $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	
	echo "<td>$meses[$mes] $año</td>";
	echo'<table>';
    echo'<tr>';
    echo'<th>Lun</th>';
    echo'<th>Mar</th>';
    echo'<th>Mie</th>';
    echo'<th>Jue</th>';
    echo'<th>Vie</th>';
    echo'<th>Sab</th>';
    echo'<th>Dom</th>';

		$last_cell=$diaSemana+$ultimoDiaMes;

		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana)
			{
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				echo "<td></td>";
			}else{
				if($day==$diaActual)
					echo "<td bgcolor='grey'>$day</td>";
				else
					echo "<td>$day</td>";
				$day++;
			}
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
</body>
</html>