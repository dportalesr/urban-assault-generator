<?php
/***************************
*	Urban Assault Level Generator – Script to generate levels for Microsoft's Urban Assault Game
*	Copyright © 2014 Daniel Portales Rosado
*
*	This program is free software: you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation, either version 3 of the License, or
*	(at your option) any later version.
*
*	This program is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*	GNU General Public License for more details.
*
*	You should have received a copy of the GNU General Public License
*	along with this program. If not, see <http://www.gnu.org/licenses/>.
***************************/

class Urbanassault {
	var $fh;
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

	var $sizex = 0, $sizey = 0;
	var $races = array('sul','myk','tae','bla','gho');

	var $n_hosts;
	var $h_xpos;
	var $h_ypos;

	function __construct(){
		$this->fh = fopen('level.txt', 'a');
		$this->n_hosts = array_fill_keys($this->races, 0);
		$this->h_xpos = array_fill_keys($this->races, array());
		$this->h_ypos = array_fill_keys($this->races, array());
	}

	function level($mode){
		do {
			$this->sizex = rand(0,29) + 3;// Calculo de tamaño del mapa (mínimo 3, máximo 32)
			$this->sizey = rand(0,29) + 3;
		} while($this->sizex * $this->sizey < 64);//Verifica que el área total no sea demasiado pequeña. Mínima de 64 u2)

		################################### Main Level Info
		$this->set = rand(0,5) + 1; //st = set (tipo de mapa)
		echo "\n".'begin_level'."\n\t".'set = '.$this->set."\r\n";
		echo "\t".'sky = objects/'.$this->sky[array_rand($this->sky)].'.base'."\n\t"; //se selecciona el mapa de bits para el cielo
		echo	'slot0 = palette/standard.pal'."\n\t".
				'slot1 = palette/red.pal'."\n\t".
				'slot2 = palette/blau.pal'."\n\t".
				'slot3 = palette/gruen.pal'."\n\t".
				'slot4 = palette/inverse.pal'."\n\t".
				'slot5 = palette/invdark.pal'."\n\t".
				'slot6 = palette/sw.pal'."\n\t".
				'slot7 = palette/invtuerk.pal'."\n".
				'end'."\n";

		################################### Mission Briefing Maps

		echo	'begin_mbmap'."\n\t".
			'name = MB_15.IFF'."\n".
			'end'."\n".
			'begin_dbmap'."\n\t".
			'name = DB_15.IFF'."\n".
			'end'."\n";

		################################### Beam Gates

		echo	'begin_gate'."\n\t".
			'sec_x = '.(rand(0,$this->sizex-2)+1)."\n". //Se calculan las coordenadas para al menos 2 sectores
			'sec_y = '.(rand(0,$this->sizey-2)+1)."\n\t".
			'closed_bp = 5'."\n\t".
			'opened_bp = 6'."\n\t".
			'target_level = 1'."\n"; //Pend: Hacer lista de los Target Levels para escoger..

		#Se establecen otras coordenadas (min 2, max 28)
		for($c=0;$c<6;$c++){
			if(rand(0,1))
				echo "\t".'keysec_x = '.(rand(0,$this->sizex-2)+1)."\n\t".'keysec_y = '.(rand(0,$this->sizey-2)+1)."\n".'mb_status = unknown;'."\n";
		}

		echo	'end'."\n".
			'begin_robo'."\n\t".
			'owner = 1 ;'."\n\t".
			'vehicle = 56'."\n";

		$res_xpos = $this->h_xpos['res'][0] = rand(0,$this->sizex-2)+1; # Origen X (min 2)
		$res_ypos = $this->h_ypos['res'][0] = rand(0,$this->sizey-2)+1; # Origen Y (min 2)
		$egy = 600 + rand(0,600);# 1500 - 3000

	echo 
		'pos_x = '.((12*$res_xpos)+6).'00'."\n".
		'pos_y = -'.(20+rand(0,25)).'0'."\n".
		'pos_z = -'.((12*$res_ypos)+6).'00'."\n".
		'energy = '.$egy.'000'."\n".
		'reload_const = '.(17*$egy).'0'."\n".
		'end'."\n";

		$this->addHost(); # Coloca una HostStation nueva

		$ideal_nhosts = $this->sizex * $this->sizey * 3/144; # Se calcula el número máximo ideal de HostStations para el mapa
		
		# agregar HostStations mientras las HS sean menor a 6 y no mayor que el número máximo ideal
		for($c = 0; $c < $ideal_nhosts && array_sum($this->n_hosts) < 6; $c++){
			if(rand(0,1)) # 50% posibilidades
				$this->addHost();
		}


		################################### Super Item

		for ($c=0;$c<2;$c++){ # 2 superitems max
			if(rand(0,1)){
				echo	'begin_item'."\n\t".
						'sec_x = '.(rand(0,$this->sizex-2)+1)."\n\t".
						'sec_y = '.(rand(0,$this->sizey-2)+1)."\n\t";

				if ($this->set==6)
					echo	'inactive_bp = 68'."\n\t".
							'active_bp = 69'."\n\t".
							'trigger_bp = 70'."\n\t";
				else
					echo	'inactive_bp = 35'."\n\t".
							'active_bp = 36'."\n\t".
							'trigger_bp = 37'."\n\t";

				echo 'type = 1'."\n\t";
				echo 'countdown = '.(rand(0,1280)+20).'000'."\n"; //tiempo pa Explotar

				#10 posibles pares de sectores
				for ($c2=0;$c2<10;$c2++)
					if (rand(0,1))
						echo "\t".'keysec_x = '.(rand(0,$this->sizex-2)+1)."\n\t".'keysec_y = '.(rand(0,$this->sizey-2)+1)."\n";

				echo 'end'."\n";
			}
		}

		////////////////////////// Predefined Squads

		# 3 squads posibles como máximo x raza
		for ($c=0;$c< 3 * array_sum($this->n_hosts);$c++)
			if (rand(0,1))
				$this->addSquad(); //Creación de Squad

		////////////////////////// Prototype Modifications

		echo 'include data:scripts/startup2.scr'."\n";

		////////////////////////// Prototype Enabling

		if ($this->n_hosts['sul']){
			echo	'begin_enable 2'."\n\t".
					'vehicle = 71'."\n\t".
					'vehicle = 72'."\n\t".
					'vehicle = 73'."\n\t".
					'vehicle = 74'."\n".
					'end'."\n";
		}

		if ($this->n_hosts['myk']){
		echo	'begin_enable 3'."\n\t".
				'vehicle = 63'."\n\t".
				'vehicle = 64'."\n\t".
				'vehicle = 65'."\n\t".
				'vehicle = 66'."\n\t".
				'vehicle = 67'."\n\t".
				'vehicle = 68'."\n\t".
				'vehicle = 69'."\n\t".
				'vehicle = 70'."\n\t".
				'building = 10'."\n\t".
				'building = 13'."\n\t".
				'building = 33'."\n\t".
				'building = 34'."\n\t".
				'building = 72'."\n\t".
				'end'."\n";
		}

		if ($this->n_hosts['tae']){
		echo	'begin_enable 4'."\n\t".
				'vehicle = 8'."\n\t".
				'vehicle = 32'."\n\t".
				'vehicle = 33'."\n\t".
				'vehicle = 34'."\n\t".
				'vehicle = 35'."\n\t".
				'vehicle = 36'."\n\t".
				'vehicle = 37'."\n\t".
				'vehicle = 38'."\n\t".
				'vehicle = 131'."\n\t".
				'building = 53'."\n\t".
				'building = 17'."\n\t".
				'building = 31'."\n\t".
				'building = 20'."\n\t".
				'building = 21'."\n\t".
				'building = 73'."\n\t".
				'end'."\n";
		}

		if ($this->n_hosts['bla']){
		echo	'begin_enable 5'."\n\t".
				'vehicle = 1'."\n\t".
				'vehicle = 2'."\n\t".
				'vehicle = 3'."\n\t".
				'vehicle = 4'."\n\t".
				'vehicle = 5'."\n\t".
				'vehicle = 6'."\n\t".
				'vehicle = 7'."\n\t".
				'vehicle = 9'."\n\t".
				'vehicle = 10'."\n\t".
				'vehicle = 12'."\n\t".
				'vehicle = 14'."\n\t".
				'vehicle = 15'."\n\t".
				'vehicle = 22'."\n\t".
				'vehicle = 23'."\n\t".
				'vehicle = 24'."\n\t".
				'vehicle = 25'."\n\t".
				'vehicle = 26'."\n\t".
				'vehicle = 27'."\n\t".
				'vehicle = 28'."\n\t".
				'vehicle = 29'."\n\t".
				'vehicle = 30'."\n\t".
				'vehicle = 31'."\n\t".
				'vehicle = 8'."\n\t".
				'vehicle = 32'."\n\t".
				'vehicle = 33'."\n\t".
				'vehicle = 34'."\n\t".
				'vehicle = 35'."\n\t".
				'vehicle = 36'."\n\t".
				'vehicle = 37'."\n\t".
				'vehicle = 38'."\n\t".
				'vehicle = 64'."\n\t".
				'vehicle = 65'."\n\t".
				'vehicle = 66'."\n\t".
				'vehicle = 67'."\n\t".
				'vehicle = 69'."\n\t".
				'vehicle = 70'."\n\t".
				'vehicle = 71'."\n\t".
				'vehicle = 72'."\n\t".
				'vehicle = 73'."\n\t".
				'vehicle = 74'."\n\t".
				'vehicle = 131'."\n\t".
				'building = 63'."\n\t".
				'building = 1'."\n\t".
				'building = 18'."\n\t".
				'building = 3'."\n\t".
				'building = 30'."\n\t".
				'building = 52'."\n\t".
				'building = 8'."\n\t".
				'building = 12'."\n\t".
				'building = 60'."\n\t".
				'building = 22'."\n\t".
				'building = 71'."\n\t".
				'building = 53'."\n\t".
				'building = 17'."\n\t".
				'building = 31'."\n\t".
				'building = 20'."\n\t".
				'building = 21'."\n\t".
				'building = 73'."\n\t".
				'building = 10'."\n\t".
				'building = 13'."\n\t".
				'building = 33'."\n\t".
				'building = 34'."\n\t".
				'building = 72'."\n\t".
				'end'."\n";
		}

		if ($this->n_hosts['gho']){
		echo	'begin_enable 6'."\n\t".
				'vehicle = 22'."\n\t".
				'vehicle = 23'."\n\t".
				'vehicle = 24'."\n\t".
				'vehicle = 25'."\n\t".
				'vehicle = 26'."\n\t".
				'vehicle = 27'."\n\t".
				'vehicle = 28'."\n\t".
				'vehicle = 29'."\n\t".
				'vehicle = 30'."\n\t".
				'vehicle = 31'."\n\t".
				'vehicle = 130'."\n\t".
				'building = 30'."\n\t".
				'building = 52'."\n\t".
				'building = 8'."\n\t".
				'building = 12'."\n\t".
				'building = 60'."\n\t".
				'building = 22'."\n\t".
				'building = 71'."\n\t".
				'end'."\n";
		}

		################################### Tech
		################################### Map Dumps
		################################### Machine generated map dumps 

		echo 'begin_maps'."\n";

		$this->maps();

		echo 'end'."\n";
		fwrite($this->fh, ob_get_contents());
		fclose($this->fh); //Cierre de archivo
		ob_end_clean();
	}

	//////////////////////////////////////////
	function addHost(){
		do {
			$hst = $this->races[array_rand($this->races)]; # se selecciona la raza de la HostStation a colocar
			$vhst = 0; # vehículo de la HostStation se inicializa a 0
			
			if($this->n_hosts[$hst] < 2) { # si aún no hay 2 hosts
				$this->n_hosts[$hst]++; # la agregamos

				switch($hst){ # asignamos el vehículo de acuerdo a la raza...
					case 'sul': $vhst = 61;break;
					case 'myk': $vhst = 58;break;
					case 'tae': $vhst = 60;break;
					case 'bla': $vhst = 62;break;
					case 'gho': $vhst = rand(0,1)?59:57;break;
				}

				list($x_pos,$y_pos) = $this->distribute_host($hst); #se verifican las distancias entre HostStations (X)
				$this->h_xpos[$hst][] = $x_pos;
				$this->h_ypos[$hst][] = $y_pos;
				$egy = 800+rand(0,600); #se calcula la energía inicial (min 2000, max 3500)

				echo	'begin_robo'."\n\t".
						'owner	= '.(array_search($hst,$this->races)+1)."\n\t".
						'vehicle	= '.$vhst."\n\t".

				'pos_x        = '.((12*$x_pos)+6).'00'."\n\t". #Posición X
				'pos_y        = -'.(20+rand(0,25)).'0'."\n\t". #Posición Z
				'pos_z        = -'.((12*$y_pos)+6).'00'."\n\t". #Posición Y
				'energy       = '.$egy.'000'."\n\t".
				'reload_const = '.(21*$egy).'0'."\n\t". #ReloadConst = Energy * .3
				'con_budget   = '.(rand(0,50)+50)."\n\t".
				'con_delay    = '.(rand(0,75)).'000'."\n\t".
				'def_budget   = '.(rand(0,40)+60)."\n\t".
				'def_delay    = '.(rand(0,75)).'000'."\n\t".
				'rec_budget   = '.(rand(0,50)+50)."\n\t".
				'rec_delay    = '.(rand(0,75)).'000'."\n\t".
				'rob_budget   = '.(rand(0,50)+50)."\n\t".
				'rob_delay    = '.(rand(0,75)).'000'."\n\t".
				'pow_budget   = '.(rand(0,60)+40)."\n\t".
				'pow_delay    = '.(rand(0,75)).'000'."\n\t".
				'rad_budget   = '.(rand(0,20)+10)."\n\t".
				'rad_delay    = '.(rand(0,75)).'000'."\n\t".
				'saf_budget   = '.(rand(0,50)+50)."\n\t".
				'saf_delay    = '.(rand(0,75)).'000'."\n\t".
				'cpl_budget   = '.(rand(0,70)+30)."\n\t".
				'cpl_delay    = '.(rand(0,75)).'000'."\n".
				'end'."\n";
			}
		}while (!$vhst); //Intentar crear de nuevo una HostStation
	}

	////////////////////// Función para Verificar distancias entre HostStations

	function distribute_host($loc_race){
		do {
			$test_x = rand(0,$this->sizex-2)+1;
			$test_y = rand(0,$this->sizey-2)+1;
			$invalid_pos = false;

			foreach($this->races as $enemyrace){
				if($enemyrace != $loc_race){ # Verifica la distancia únicamente de Hosts enemigas
					for($ene = 0; $ene < $this->n_hosts[$enemyrace]; $ene++){
						if(sqrt(pow($this->h_xpos[$enemyrace][$ene] - $test_x,2) + pow($this->h_ypos[$enemyrace][$ene] - $test_y,2)) < 4){
							$invalid_pos = true;
							break;
						}
					}
					
					if($invalid_pos) break;
				}
			}
		} while($invalid_pos);

		return array($test_x,$test_y);
	}

	/////////////////// Función para Posicionar Escuadrones iniciales 

	function addSquad(){
		echo 'begin_squad'."\n";
		
		do {
			$race = $this->races[array_rand($this->races)];
			$own = array_search($race,$this->races)+1;
		} while(!$this->n_hosts[$race]);	# Si la raza del squad no está jugando, se reintenta.

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
					if ($pos==$this->h_xpos[$cc][$cc2]) //Se verifica que no sean de ninguna hostStation
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
					if ($pos==$this->h_ypos[$cc][$cc2]) //Se verifica que no sean de ninguna hostStation
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
		echo "\t".'typ_map ='."\n\t".$this->sizex.' '.$this->sizey."\n";

		# 1era fila
		echo "\t\t".'f8 '; for($c=0;$c<$this->sizex-2;$c++) echo 'fc ';echo 'f9'."\n";

		# body
		for($c=0;$c<$this->sizey-2;$c++){
			echo "\t\tff";
			for($c2=0;$c2<$this->sizex-2;$c2++)
				printf(" %02x",$this->slots[array_rand($this->slots[$st-1])]);
			echo " fd\n";
		}

		# ultima fila
		echo "\t\t".'fb';for ($c=0;$c<$this->sizex-2;$c++) echo ' fe';echo ' fa'."\n";
		
		///////////////////// own

		# definition
		echo "\t".'own_map ='."\n\t".$this->sizex.' '.$this->sizey."\n";

		# inicializado en 0
		$map = array_fill(0, $this->sizex-1, array_fill(0, $this->sizey-1, 0));
		$idealnumsects = ($this->sizex-2) * ($this->sizey-2) * 3 / 2 * array_sum($this->n_hosts); // i (número ideal de sectores para cada raza) = área total de sectores / número total de HostStations + 30%

		# Mapear colores
		$this->color_race(1,1);
		$this->color_race(2,$this->n_hosts['sul']);
		$this->color_race(3,$this->n_hosts['myk']);
		$this->color_race(4,$this->n_hosts['tae']);
		$this->color_race(5,$this->n_hosts['bla']);
		$this->color_race(6,$this->n_hosts['gho']);

		# Imprimir mapa
		for($c = 0; $c < $this->sizey; $c++){
			echo "\t\t";

			for($c2 = 0; $c2 < $this->sizex; $c2++){
				printf("%02d ",$map[$c2][$c]);
			}

			echo "\n";
		}
		
		///////////////////// hgt

		echo "\t".'hgt_map ='."\n\t".$this->sizex.' '.$this->sizey."\n";
		$x = $y = 1;
		$alturabase = 50 + (rand(0,50)-25);

		for ($c=1;$c<$this->sizey-1;$c++){
			for ($c2=1;$c2<$this->sizex-1;$c2++){
				$map[$c2][$c] = $alturabase;
				$this->altura_arnd($alturabase, $c2,$c);
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

		for ($c = 0; $c < $this->sizey; $c++){
			for ($c2 = 0; $c2 < $this->sizex; $c2++){
				for($c3 = 0; $c3 < 3; $c3++){
					if ($c2 == $this->h_xpos[2][$c3] && $c == $this->h_ypos[2][$c3])
						$blg[$c2][$c] = 10;
					if ($c2 == $this->h_xpos[3][$c3] && $c == $this->h_ypos[3][$c3])
						$blg[$c2][$c] = 10;
					if ($c2 == $this->h_xpos[4][$c3] && $c == $this->h_ypos[4][$c3])
						$blg[$c2][$c] = 17;
					if ($c2 == $this->h_xpos[5][$c3] && $c == $this->h_ypos[5][$c3])
						$blg[$c2][$c] = 14;
					if ($c2 == $this->h_xpos[6][$c3] && $c == $this->h_ypos[6][$c3])
						$blg[$c2][$c] = 12;
				}
			}
		}

		for ($c = 0; $c < $this->sizey; $c++){
			echo "\t\t";
			for($c2 = 0; $c2 < $this->sizex; $c2++)
				printf("%02x ", $blg[$c2][$c]);
			echo "\n";
		}
	}

	////////////////////////

	function color_race($raceidx, $racehostnum){ //nr = número identificador de raza, cr = cantidad de HostStations de esa raza
		if(!$racehostnum) return;
		
		do {
			# Coordenadas de la HostStation
			$x = $this->h_xpos[$raceidx][$racehostnum-1];
			$y = $this->h_ypos[$raceidx][$racehostnum-1];
			
			$this->arnd($raceidx,$x,$y); 

			for($c=0;$c<$idealnumsects;$c++){
				if (rand(0,1)){
					# Elige nuevo pibote
					$x = $x+(rand(0,3)-1);
					$y = $y+(rand(0,3)-1);
					$this->arnd($raceidx,$x,$y);
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

ob_start();
$ua = new Urbanassault(); 
$ua->level('single');
?>