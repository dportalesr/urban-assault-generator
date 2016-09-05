<?php
class urbanassault {
var $fh = fopen('level.txt', 'a');
var $slots = array(
	array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,50,51,59,67,70,71,72,74,75,76,77,78,80,81,82,95,96,97,98,99,100,130,131,132,133,134,135,136,137,138,139,150,151,153,154,155,157,159,160,161,162,163,164,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,198,232,233,234,235,236),
	array(0,1,2,5,6,7,8,9,11,12,13,16,17,18,19,20,21,22,23,24,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,65,66,67,68,69,70,71,72,75,76,77,78,80,81,82,83,87,89,90,92,93,94,95,97,99,100,120,121,122,123,124,125,126,127,128,129,130,131,133,150,151,152,153,155,158,159,160,161,162,163,167,168,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,198,199,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225),
	array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,59,67,69,70,71,72,74,75,76,77,78,80,81,82,100,130,131,132,133,134,135,136,137,138,139,150,151,152,153,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189),
	array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,59,60,66,67,69,70,71,72,74,75,76,77,78,80,81,82,130,131,132,133,134,135,136,137,138,139,140,141,150,151,153,155,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189),
	array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,57,58,59,62,63,65,66,67,68,69,70,71,72,75,76,78,79,82,84,87,92,93,94,95,97,98,99,105,106,107,108,109,113,114,120,121,122,123,124,125,126,127,128,129,130,131,133,134,135,150,151,152,153,155,157,158,159,161,160,162,163,166,167,168,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,190,191,198,199,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225),
	array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,59,66,67,68,70,71,72,74,75,76,77,78,79,80,81,82,95,96,97,98,99,130,131,132,133,134,135,136,137,138,139,140,141,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,188,189,228,229,230,231,232,233,234,235,248)
);

var $sky = array(
	'1998_01',
	'1998_02',
	'1998_03',
	'1998_05',
	'1998_06',
	'Am_1',
	'Am_2',
	'Am_3',
	'Arz1',
	'Asky2',
	'Braun1',
	'Ct6',
	'H',
	'H7',
	'Haamitt1',
	'Haamitt4',
	'Mod2',
	'Mod4',
	'Mod5',
	'Mod7',
	'Mod8',
	'Mod9',
	'Moda',
	'Modb',
	'Nacht1',
	'Nacht2',
	'Newtry5',
	'Nosky',
	'Nt1',
	'Nt2',
	'Nt3',
	'Nt5',
	'Nt6',
	'Nt7',
	'Nt8',
	'Nt9',
	'Nta',
	'S3_1',
	'S3_4',
	'Smod1',
	'Smod2',
	'Smod3',
	'Smod4',
	'Smod5',
	'Smod6',
	'Smod7',
	'Smod8',
	'Sterne',
	'wow1',
	'wow5',
	'wow7',
	'wow8',
	'wow9',
	'wowa',
	'wowb',
	'wowc',
	'wowd',
	'wowe',
	'wowf',
	'wowh',
	'wowi',
	'wowj',
	'x1',
	'x2',
	'x4',
	'x5',
	'x7',
	'x8',
	'x9',
	'xa',
	'xb',
	'xc');

var $sizex = $sizey = 0;
var $races = array('sul','myk','tae','bla','gho');

var $n_hosts = array_fill_keys($races, 0);
var $h_xpos = array_fill_keys($races, array());
var $h_ypos = array_fill_keys($races, array());

function level($mode){
	do {
		$this->sizex = rand(0,29) + 3;// Calculo de tamaño del mapa (mínimo 3, máximo 32)
		$this->sizey = rand(0,29) + 3;
	} while($this->sizex * $this->sizey < 64);//Verifica que el área total no sea demasiado pequeña. Mínima de 64 u2)

	################################### Main Level Info
	$set = rand(0,5) + 1; //st = set (tipo de mapa)
	echo "\nbegin_level",
				"\n\tset = ", $set,
				"\n\tsky = objects/", array_rand($sky), ".base", //se selecciona el mapa de bits para el cielo
				"\n\tslot0 = palette/standard.pal",
				"\n\tslot1 = palette/red.pal",
				"\n\tslot2 = palette/blau.pal",
				"\n\tslot3 = palette/gruen.pal",
				"\n\tslot4 = palette/inverse.pal",
				"\n\tslot5 = palette/invdark.pal",
				"\n\tslot6 = palette/sw.pal",
				"\n\tslot7 = palette/invtuerk.pal",
			"end";

	################################### Mission Briefing Maps

	echo "\nbegin_mbmap",
				"\n\tname = MB_15.IFF",
				"\nend",

				"\nbegin_dbmap",
				"\n\tname = DB_15.IFF",
				"\nend";

	################################### Beam Gates

	echo "\nbegin_gate".
				"\n\tsec_x = ", rand(0, $this->sizex - 2) + 1, //Se calculan las coordenadas para al menos 2 sectores
				"\n\tsec_y = ", rand(0, $this->sizey - 2) + 1,
				"\n\tclosed_bp =",
				"\n\topened_bp =",
				"\n\ttarget_level = 1\n"; //Pend: Hacer lista de los Target Levels para escoger..

	#Se establecen otras coordenadas (min 2, max 28)
	for($c=0;$c<6;$c++)
		if(rand(0,1))
			echo "\t".'keysec_x = '.(rand(0,$this->sizex-2)+1)",'keysec_y = '.(rand(0,$this->sizey-2)+1)."\n".'mb_status = unknown;'."\n";

	echo	'end'."\n".
			'begin_robo'",
			'owner = 1 ;'",
			'vehicle = 56'."\n";

	$res_xpos = $h_xpos['res'][0] = rand(0,$this->sizex-2)+1; # Origen X (min 2)
	$res_ypos = $h_ypos['res'][0] = rand(0,$this->sizey-2)+1; # Origen Y (min 2)
	$egy = 600 + rand(0,600);# 1500 - 3000

	'pos_x = '.((12*$res_xpos)+6).'00'."\n".
	'pos_y = -'.(20+rand(0,25)).'0'."\n".
	'pos_z = -'.((12*$res_ypos)+6).'00'."\n".
	'energy = '.$egy.'000'."\n".
	'reload_const = '.(17*$egy).'0'."\n".
	'end'."\n";

	addHost(); # Coloca una HostStation nueva

	$ideal_nhosts = $this->sizex * $this->sizey * 3/144; # Se calcula el número máximo ideal de HostStations para el mapa
	# agregar HostStations mientras las HS sean menor a 6 y no mayor que el número máximo ideal
	for($c=0;$c<$ideal_nhosts && array_sum($n_hosts) < 6;$c++)
		if(rand(0,1)) # 50% posibilidades
			addHost();

	################################### Super Item

	for ($c=0;$c<2;$c++){ # 2 superitems max
		if(rand(0,1)){
			echo	'begin_item'",
					'sec_x = '.(rand(0,$this->sizex-2)+1)",
					'sec_y = '.(rand(0,$this->sizey-2)+1)."\n\t";

			if ($set==6)
				echo	'inactive_bp = 68'",
						'active_bp = 69'",
						'trigger_bp = 70'."\n\t";
			else
				echo	'inactive_bp = 35'",
						'active_bp = 36'",
						'trigger_bp = 37'."\n\t";

			echo 'type = 1'."\n\t";
			echo 'countdown = '.(rand(0,1280)+20).'000'."\n"; //tiempo pa Explotar

			#10 posibles pares de sectores
			for ($c2=0;$c2<10;$c2++)
				if (rand(0,1))
					echo "\t".'keysec_x = '.(rand(0,$this->sizex-2)+1)",'keysec_y = '.(rand(0,$this->sizey-2)+1)."\n";

			echo 'end'."\n";
		}
	}

	////////////////////////// Predefined Squads

	# 3 squads posibles como máximo x raza
	for ($c=0;$c< 3 * array_sum($n_hosts);$c++)
		if (rand(0,1))
			addSquad(); //Creación de Squad

	////////////////////////// Prototype Modifications

	echo 'include data:scripts/startup2.scr'."\n";

	////////////////////////// Prototype Enabling

	if ($n_hosts['sul']){
		echo	'begin_enable 2'",
				'vehicle = 71'",
				'vehicle = 72'",
				'vehicle = 73'",
				'vehicle = 74'."\n".
				'end'."\n";
	}

	if ($n_hosts['myk']){
	echo	'begin_enable 3'",
			'vehicle = 63'",
			'vehicle = 64'",
			'vehicle = 65'",
			'vehicle = 66'",
			'vehicle = 67'",
			'vehicle = 68'",
			'vehicle = 69'",
			'vehicle = 70'",
			'building = 10'",
			'building = 13'",
			'building = 33'",
			'building = 34'",
			'building = 72'",
			'end'."\n";
	}

	if ($n_hosts['tae']){
	echo	'begin_enable 4'",
			'vehicle = 8'",
			'vehicle = 32'",
			'vehicle = 33'",
			'vehicle = 34'",
			'vehicle = 35'",
			'vehicle = 36'",
			'vehicle = 37'",
			'vehicle = 38'",
			'vehicle = 131'",
			'building = 53'",
			'building = 17'",
			'building = 31'",
			'building = 20'",
			'building = 21'",
			'building = 73'",
			'end'."\n";
	}

	if ($n_hosts['bla']){
	echo	'begin_enable 5'",
			'vehicle = 1'",
			'vehicle = 2'",
			'vehicle = 3'",
			'vehicle = 4'",
			'vehicle = 5'",
			'vehicle = 6'",
			'vehicle = 7'",
			'vehicle = 9'",
			'vehicle = 10'",
			'vehicle = 12'",
			'vehicle = 14'",
			'vehicle = 15'",
			'vehicle = 22'",
			'vehicle = 23'",
			'vehicle = 24'",
			'vehicle = 25'",
			'vehicle = 26'",
			'vehicle = 27'",
			'vehicle = 28'",
			'vehicle = 29'",
			'vehicle = 30'",
			'vehicle = 31'",
			'vehicle = 8'",
			'vehicle = 32'",
			'vehicle = 33'",
			'vehicle = 34'",
			'vehicle = 35'",
			'vehicle = 36'",
			'vehicle = 37'",
			'vehicle = 38'",
			'vehicle = 64'",
			'vehicle = 65'",
			'vehicle = 66'",
			'vehicle = 67'",
			'vehicle = 69'",
			'vehicle = 70'",
			'vehicle = 71'",
			'vehicle = 72'",
			'vehicle = 73'",
			'vehicle = 74'",
			'vehicle = 131'",
			'building = 63'",
			'building = 1'",
			'building = 18'",
			'building = 3'",
			'building = 30'",
			'building = 52'",
			'building = 8'",
			'building = 12'",
			'building = 60'",
			'building = 22'",
			'building = 71'",
			'building = 53'",
			'building = 17'",
			'building = 31'",
			'building = 20'",
			'building = 21'",
			'building = 73'",
			'building = 10'",
			'building = 13'",
			'building = 33'",
			'building = 34'",
			'building = 72'",
			'end'."\n";
	}

	if ($n_hosts['gho']){
	echo	'begin_enable 6'",
			'vehicle = 22'",
			'vehicle = 23'",
			'vehicle = 24'",
			'vehicle = 25'",
			'vehicle = 26'",
			'vehicle = 27'",
			'vehicle = 28'",
			'vehicle = 29'",
			'vehicle = 30'",
			'vehicle = 31'",
			'vehicle = 130'",
			'building = 30'",
			'building = 52'",
			'building = 8'",
			'building = 12'",
			'building = 60'",
			'building = 22'",
			'building = 71'",
			'end'."\n";
	}

	################################### Tech
	################################### Map Dumps
	################################### Machine generated map dumps

	echo 'begin_maps'."\n";

	maps();

	echo 'end'."\n";
	#fwrite($fh, ob_end_flush());
	fclose($fh); //Cierre de archivo
}

//////////////////////////////////////////
function addHost(){
	do{
		$hst = array_rand($races); # se selecciona la raza de la HostStation a colocar
		$vhst = 0; # vehículo de la HostStation se inicializa a 0

		if($n_hosts[$hst]<2) { # si aún no hay 2 hosts
			$n_hosts[$hst]++; # la agregamos

			switch($hst){ # asignamos el vehículo de acuerdo a la raza...
				case 'sul': $vhst = 61;break;
				case 'myk': $vhst = 58;break;
				case 'tae': $vhst = 60;break;
				case 'bla': $vhst = 62;break;
				case 'gho': $vhst = rand(0,1)?59:57;break;
			}

			list($x_pos,$y_pos) = distribute_host($hst); #se verifican las distancias entre HostStations (X)
			$h_xpos[$hst][] = $x_pos;
			$h_ypos[$hst][] = $y_pos;
			$egy = 800+rand(0,600); #se calcula la energía inicial (min 2000, max 3500)

			echo	'begin_robo'",
					'owner	= '.(array_search($hst,$races)+1)",
					'vehicle	= '.$vhst",

			'pos_x        = '.((12*$x_pos)+6).'00'", #Posición X
			'pos_y        = -'.(20+rand(0,25)).'0'", #Posición Z
			'pos_z        = -'.((12*$y_pos)+6).'00'", #Posición Y
			'energy       = '.$egy.'000'",
			'reload_const = '.(21*$egy).'0'", #ReloadConst = Energy * .3
			'con_budget   = '.(rand(0,50)+50)",
			'con_delay    = '.(rand(0,75)).'000'",
			'def_budget   = '.(rand(0,40)+60)",
			'def_delay    = '.(rand(0,75)).'000'",
			'rec_budget   = '.(rand(0,50)+50)",
			'rec_delay    = '.(rand(0,75)).'000'",
			'rob_budget   = '.(rand(0,50)+50)",
			'rob_delay    = '.(rand(0,75)).'000'",
			'pow_budget   = '.(rand(0,60)+40)",
			'pow_delay    = '.(rand(0,75)).'000'",
			'rad_budget   = '.(rand(0,20)+10)",
			'rad_delay    = '.(rand(0,75)).'000'",
			'saf_budget   = '.(rand(0,50)+50)",
			'saf_delay    = '.(rand(0,75)).'000'",
			'cpl_budget   = '.(rand(0,70)+30)",
			'cpl_delay    = '.(rand(0,75)).'000'."\n".
			'end'."\n";
		}
	}while (!$vhst); //Intentar crear de nuevo una HostStation
}

////////////////////// Función para Verificar distancias entre HostStations

function distribute_host($loc_race){
	do{
		$test_x = rand(0,$this->sizex-2)+1;
		$test_y = rand(0,$this->sizey-2)+1;
		$invalid_pos = false;

		foreach($races as $enemyrace){
			if($enemyrace != $loc_race){ # Verifica la distancia únicamente de Hosts enemigas
				for($ene=0;$ene<$n_hosts[$enemyrace];$ene++){
					if(sqrt(pow($h_xpos[$enemyrace][$ene] - $test_x,2) + pow($h_ypos[$enemyrace][$ene] - $test_y,2)) < 4){
						$invalid_pos = true;
						break;
					}
				}
				if($invalid_pos) break;
			}
		}
	}while($invalid_pos);
	return array($test_x,$test_y);
}

/////////////////// Función para Posicionar Escuadrones iniciales

function addSquad(){
	echo 'begin_squad'."\n";
	do{ $race = array_rand($races); $own = array_search($race,$races)+1; }while(!$n_hosts[$race]);	# Si la raza del squad no está jugando, se reintenta.

	echo	"\t".'owner     = '.$race."\n"; //Ya escogida la raza..
	switch ($own){
		case 1:
			do{
				$vhl = rand(0,15)+1;
				$nvhl = ($vhl==9)?1:rand(0,10)+1; # Si es un Scout sólo se asigna 1 unidad
			} while($vhl == 13);
			break;
		case 2:
			$vhl = rand(0,3)+71;
			$nvhl = ($vhl==74)?1:rand(0,9)+1;
			break;
		case 3:
			$vhl = rand(0,7)+63;
			$nvhl = ($vhl==67)?1:rand(0,9)+1;
			break;
		case 4:
			$vhl = rand(0,6)?rand(0,6)+32:(rand(0,3)?8:131);
			$nvhl = ($vhl==35)?1:rand(0,9)+1;
			break;
		case 5:
			$vhl = rand(0,1)?rand(0,15)+1:(rand(0,1)?rand(0,9)+22:(rand(0,5)?rand(0,11)+63:rand(0,1)+130));
			$nvhl = (array_search($vhl,array(9,74,67,35,29))!== false)?1:rand(0,10)+1; # Si es cualquiera de los scouts..
			break;
		case 6:
			$vhl = rand(0,7)?rand(0,10)+22:130;
			$nvhl = ($vhl==29)?1:rand(0,10)+1;
			break;
	}
	echo "\t".'vehicle   = '.$vhl."\n";
	echo "\t".'num       = '.$nvhl."\n";

	do {
		$band = 0;
		$pos = rand(0,$this->sizex-2)+1; //Se asignan unas coordenadas X

		for ($cc=1;$cc<7;$cc++){
			for ($cc2=0;$cc2<3;$cc2++){
				if ($pos==$h_xpos[$cc][$cc2]) //Se verifica que no sean de ninguna hostStation
					$band++;
			}
		}
	} while($band > 0); //Se calcula de nuevo hasta no coincidir con ninguna ya existente
	echo "\t".'pos_x     = '.(12*$pos+6).'00'."\n"; //Se escribe la posición en X

	do{
		$band=0;
		$pos = rand(0,$this->sizey-2)+1; //Se asignan unas coordenadas Y

		for ($cc=1;$cc<7;$cc++){
			for ($cc2=0;$cc2<3;$cc2++){
				if ($pos==$h_ypos[$cc][$cc2]) //Se verifica que no sean de ninguna hostStation
					$band++;
			}
		}
	} while($band > 0); //Se calcula de nuevo hasta no coincidir con ninguna ya existente

	echo "\t".'pos_z     = -'.(12*$pos+6).'00'."\n"; //Se escribe la posición en Y
	if(rand(0,2))
		echo"\t".'mb_status =	unknown'."\n";

	echo 'end'."\n";
}

////////////////////////////////// Maps
function maps(){

	///////////////////// typ

	# definition
	echo "\t".'typ_map ='."\n\t",$this->sizex.' '.$this->sizey."\n";

	# 1era fila
	echo "\t\t".'f8 '; for($c=0;$c<$this->sizex-2;$c++) echo 'fc ';echo 'f9'."\n";

	# body
	for($c=0;$c<$this->sizey-2;$c++){
		echo "\t\tff";
		for($c2=0;$c2<$this->sizex-2;$c2++)
			echo printf(" %02x",array_rand($slots[$st-1]));
		echo " fd\n";
	}

	# ultima fila
	echo "\t\t".'fb';for ($c=0;$c<$this->sizex-2;$c++) echo ' fe';echo ' fa'."\n";

	///////////////////// own

	# definition
	echo "\t".'own_map ='."\n\t",$this->sizex.' '.$this->sizey."\n";

	# inicializado en 0
	$map = array_fill(0, $this->sizex-1, array_fill(0, $this->sizey-1, 0));

	$idealnumsects = ($this->sizex-2) * ($this->sizey-2) * 3 / 2 * array_sum($n_hosts); // i (número ideal de sectores para cada raza) = área total de sectores / número total de HostStations + 30%

	# Mapear colores
	color_race(1,1);
	color_race(2,$n_hosts['sul']);
	color_race(3,$n_hosts['myk']);
	color_race(4,$n_hosts['tae']);
	color_race(5,$n_hosts['bla']);
	color_race(6,$n_hosts['gho']);

	# Imprimir mapa
	for ($c=0;$c<$this->sizey;$c++){ echo "\t\t"; for($c2=0;$c2<$this->sizex;$c2++) printf("%02d ",$map[$c2][$c]); echo "\n";}

	///////////////////// hgt

	echo "\t".'hgt_map ='."\n\t",$this->sizex.' '.$this->sizey."\n";
	$x = $y = 1;
	$alturabase = 50 + (rand(0,50)-25);

	for ($c=1;$c<$this->sizey-1;$c++){
		for ($c2=1;$c2<$this->sizex-1;$c2++){
			$map[$c2][$c] = $alturabase;
			altura_arnd($alturabase, $c2,$c);
			if ($map[$c2-1][$c]!=0 && $map[$c2-1][$c]!=1)
				$altura = $map[$c2-1][$c]+(rand(0,5)-2);
		}
	}

	////// Igualar bordes horizontales
	for ($c=0;$c<$this->sizex;$c++){
		$map[$c][0] = $map[$c][1];
		$map[$c][$this->sizey-1] = $map[$c][$this->sizey-2];
	}

	////// Igualar bordes verticales
	for ($c=0;$c<$this->sizey;$c++){
		$map[0][$c] = $map[1][$c];
		$map[$this->sizex-1][$c] = $map[$this->sizex-2][$c];
	}

	for ($c=0;$c<$this->sizey;$c++){
		echo "\t\t";
		for ($c2=0;$c2<$this->sizex;$c2++)
			printf("%02x ",$map[$c2][$c]);
		echo "\n";
	}

	///////////////////// blg

	echo "\t".'blg_map ='."\n";
	echo "\t".$this->sizex.' '.$this->sizey."\n";

	for ($c=0;$c<$this->sizey;$c++){
		for ($c2=0;$c2<$this->sizex;$c2++){
			for($c3=0;$c3<3;$c3++){
				if ($c2==$h_xpos[2][$c3]&&c==$h_ypos[2][$c3])
					$blg[$c2][$c]=10;
				if ($c2==$h_xpos[3][$c3]&&c==$h_ypos[3][$c3])
					$blg[$c2][$c]=10;
				if ($c2==$h_xpos[4][$c3]&&c==$h_ypos[4][$c3])
					$blg[$c2][$c]=17;
				if ($c2==$h_xpos[5][$c3]&&c==$h_ypos[5][$c3])
					$blg[$c2][$c]=14;
				if ($c2==$h_xpos[6][$c3]&&c==$h_ypos[6][$c3])
					$blg[$c2][$c]=12;
			}
		}
	}

	for ($c=0;c<$this->sizey;$c++){
		echo "\t\t";
		for($c2=0;$c2<$this->sizex;$c2++)
			printf("%02x ",$blg[$c2][$c]);
		echo "\n";
	}
}

////////////////////////

function color_race($raceidx, $racehostnum){ //nr = número identificador de raza, cr = cantidad de HostStations de esa raza
	if(!$racehostnum) return;

	do {
		# Coordenadas de la HostStation
		$x = $h_xpos[$raceidx][$racehostnum-1];
		$y = $h_ypos[$raceidx][$racehostnum-1];

		arnd($raceidx,$x,$y);

		for($c=0;$c<$idealnumsects;$c++){
			if (rand(0,1)){
				# Elige nuevo pibote
				$x = $x+(rand(0,3)-1);
				$y = $y+(rand(0,3)-1);
				arnd($raceidx,$x,$y);
			}
		}
	$racehostnum--;
	} while($racehostnum>0);
}

//////////////////////// Función que asinga el valor alrededor del punto inicial
function arnd($raceidx,$x1,$y1){
	$map[$x-1][$y-1] = $raceidx;
	$map[$x-1][$y] = $raceidx;
	$map[$x][$y-1] = $raceidx;
	$map[$x+1][$y+1] = $raceidx;
	$map[$x+1][$y] = $raceidx;
	$map[$x][$y+1] = $raceidx;
	$map[$x+1][$y-1] = $raceidx;
	$map[$x-1][$y+1] = $raceidx;
}

/////////////////////////////////////

function altura_arnd($altura,$x2, $y2){
	$map[$x2-1][$y2] = $altura+(rand(0,6)-3);
	$map[$x2][$y2-1] = $altura+(rand(0,6)-3);
	$map[$x2+1][$y2+1] = $altura+(rand(0,6)-3);
	$map[$x2+1][$y2] = $altura+(rand(0,6)-3);
	$map[$x2][$y2+1] = $altura+(rand(0,6)-3);
	$map[$x2+1][$y2-1] = $altura+(rand(0,6)-3);
	$map[$x2-1][$y2+1] = $altura+(rand(0,6)-3);
}

///////////////////////////////////////////////////////////////

function cmpg(){
/*
	char *nam;
	for(cg=1;cg<76;cg++){
		if((cg>9&&cg<13)||(cg>19&&cg<24)||(cg>24&&cg<27)||(cg>29&&cg<35)||(cg>39&&cg<45)||(cg>49&&cg<55)||(cg>59&&cg<65)||(cg>69&&cg<76)||(cg==15)||(cg==66)){
			itoa(cg,nam,10);
			lvlname=strcat(strcat(strcat("l",nam),nam),".ldf");
		}
		if(cg>0&&cg<6){
			itoa(cg,nam,10);
			lvlname=strcat(strcat(strcat(strcat("l0",nam),"0"),nam),".ldf");
		}
		qk();
	}
*/
}
}
#ob_start();
$obj = new urbanassault();
$obj->level('single');
?>
