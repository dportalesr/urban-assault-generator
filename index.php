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

// TODO
// - Crear array con factions presentes para no hacer verificaciones "Si faction está presente" después de seleccionar raza con rand

class Urbanassault {
	var $fh;
	var $debug = true;
	var $slots = array(
		1 => array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,50,51,59,67,70,71,72,74,75,76,77,78,80,81,82,95,96,97,98,99,100,130,131,132,133,134,135,136,137,138,139,150,151,153,154,155,157,159,160,161,162,163,164,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,198,232,233,234,235,236),
		array(0,1,2,5,6,7,8,9,11,12,13,16,17,18,19,20,21,22,23,24,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,65,66,67,68,69,70,71,72,75,76,77,78,80,81,82,83,87,89,90,92,93,94,95,97,99,100,120,121,122,123,124,125,126,127,128,129,130,131,133,150,151,152,153,155,158,159,160,161,162,163,167,168,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,198,199,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225),
		array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,59,67,69,70,71,72,74,75,76,77,78,80,81,82,100,130,131,132,133,134,135,136,137,138,139,150,151,152,153,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189),
		array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,59,60,66,67,69,70,71,72,74,75,76,77,78,80,81,82,130,131,132,133,134,135,136,137,138,139,140,141,150,151,153,155,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189),
		array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,57,58,59,62,63,65,66,67,68,69,70,71,72,75,76,78,79,82,84,87,92,93,94,95,97,98,99,105,106,107,108,109,113,114,120,121,122,123,124,125,126,127,128,129,130,131,133,134,135,150,151,152,153,155,157,158,159,161,160,162,163,166,167,168,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,190,191,198,199,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225),
		array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,59,66,67,68,70,71,72,74,75,76,77,78,79,80,81,82,95,96,97,98,99,130,131,132,133,134,135,136,137,138,139,140,141,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,188,189,228,229,230,231,232,233,234,235,248)
	);

	var $skies = array('1998_01', '1998_02', '1998_03', '1998_05', '1998_06', 'Am_1', 'Am_2', 'Am_3', 'Arz1', 'Asky2', 'Braun1', 'Ct6', 'H', 'H7', 'Haamitt1', 'Haamitt4', 'Mod2', 'Mod4', 'Mod5', 'Mod7', 'Mod8', 'Mod9', 'Moda', 'Modb', 'Nacht1', 'Nacht2', 'Newtry5', 'Nosky', 'Nt1', 'Nt2', 'Nt3', 'Nt5', 'Nt6', 'Nt7', 'Nt8', 'Nt9', 'Nta', 'S3_1', 'S3_4', 'Smod1', 'Smod2', 'Smod3', 'Smod4', 'Smod5', 'Smod6', 'Smod7', 'Smod8', 'Sterne', 'wow1', 'wow5', 'wow7', 'wow8', 'wow9', 'wowa', 'wowb', 'wowc', 'wowd', 'wowe', 'wowf', 'wowh', 'wowi', 'wowj', 'x1', 'x2', 'x4', 'x5', 'x7', 'x8', 'x9', 'xa', 'xb', 'xc');
	var $size_x = 0, $size_y = 0;
	var $factions = array(2 => 'sul','myk','tae','bla','gho');

	var $num_hosts;
	var $host_x;
	var $host_y;

	function __construct(){
		$this->fh = fopen('level.ldf', 'w');
		$this->num_hosts = array_fill_keys($this->factions, 0);
		$this->host_x = array_fill_keys($this->factions, array());
		$this->host_y = array_fill_keys($this->factions, array());
	}

	function make_level($mode){
		if($this->debug){
			echo '<pre>';
		} else {
			ob_start();
		}

		do {
			$this->size_x = rand(0, 29) + 3;// Calculo de tamaño del mapa (mínimo 3, máximo 32)
			$this->size_y = rand(0, 29) + 3;
		} while($this->size_x * $this->size_y < 64);//Verifica que el área total no sea demasiado pequeña. Mínima de 64 u2)

		################################### Main Level Info

		$this->set = rand(1,6); //st = set (tipo de mapa)

		echo "\n".'begin_level'."\n\t".'set = '.$this->set."\r\n";
		echo "\t".'sky = objects/'.$this->skies[array_rand($this->skies)].'.base'."\n\t"; //se selecciona el mapa de bits para el cielo
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
			'sec_x = '.(rand(0, $this->size_x - 2) + 1)."\n". //Se calculan las coordenadas para al menos 2 sectores
			'sec_y = '.(rand(0, $this->size_y - 2) + 1)."\n\t".
			'closed_bp = 5'."\n\t".
			'opened_bp = 6'."\n\t".
			'target_level = 1'."\n"; //Pend: Hacer lista de los Target Levels para escoger..

		#Se establecen otras coordenadas (min 2, max 28)
		for($c = 0; $c < 6; $c++){
			if(rand(0, 1))
				echo "\t".'keysec_x = '.(rand(0, $this->size_x - 2) + 1)."\n\t".'keysec_y = '.(rand(0, $this->size_y - 2) + 1)."\n".'mb_status = unknown;'."\n";
		}

		echo	'end'."\n".
			'begin_robo'."\n\t".
			'owner = 1 ;'."\n\t".
			'vehicle = 56'."\n";

		$resistance_x = $this->host_x['res'][0] = rand(0, $this->size_x-2) + 1; # Origen X (min 2)
		$resistance_y = $this->host_y['res'][0] = rand(0, $this->size_y-2) + 1; # Origen Y (min 2)
		$energy = 600 + rand(0, 600);# 1500 - 3000

	echo 
		'pos_x = '.((12 * $resistance_x) + 6).'00'."\n".
		'pos_y = -'.(20 + rand(0, 25)).'0'."\n".
		'pos_z = -'.((12 * $resistance_y) + 6).'00'."\n".
		'energy = '.$energy.'000'."\n".
		'reload_const = '.(17 * $energy).'0'."\n".
		'end'."\n";

		$this->add_host_station(); # Coloca una HostStation nueva

		$num_hosts_ideal = $this->size_x * $this->size_y * 3/144; # Se calcula el número máximo ideal de HostStations para el mapa
		
		# agregar HostStations mientras las HS sean menor a 6 y no mayor que el número máximo ideal
		for($c = 0; $c < $num_hosts_ideal && array_sum($this->num_hosts) < 6; $c++){
			if(rand(0,1)) # 50% posibilidades
				$this->add_host_station();
		}

		################################### Super Item

		for ($c = 0; $c < 2; $c++){ # 2 superitems max
			if(rand(0,1)){
				echo	'begin_item'."\n\t".
						'sec_x = '.(rand(0, $this->size_x-2)+1)."\n\t".
						'sec_y = '.(rand(0, $this->size_y-2)+1)."\n\t";

				if ($this->set == 6)
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
				for ($c2 = 0; $c2 < 10; $c2++)
					if (rand(0,1))
						echo "\t".'keysec_x = '.(rand(0, $this->size_x-2)+1)."\n\t".'keysec_y = '.(rand(0, $this->size_y-2)+1)."\n";

				echo 'end'."\n";
			}
		}

		////////////////////////// Predefined Squads

		# 3 squads posibles como máximo x raza
		for ($c = 0; $c <  3 * array_sum($this->num_hosts); $c++)
			if (rand(0,1))
				$this->add_squad(); //Creación de Squad

		////////////////////////// Prototype Modifications

		echo 'include data:scripts/startup2.scr'."\n";

		////////////////////////// Prototype Enabling

		if ($this->num_hosts['sul']){
			echo	'begin_enable 2'."\n\t".
					'vehicle = 71'."\n\t".
					'vehicle = 72'."\n\t".
					'vehicle = 73'."\n\t".
					'vehicle = 74'."\n".
					'end'."\n";
		}

		if ($this->num_hosts['myk']){
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

		if ($this->num_hosts['tae']){
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

		if ($this->num_hosts['bla']){
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

		if ($this->num_hosts['gho']){
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

		$this->build_maps();

		echo 'end'."\n";
		
		fwrite($this->fh, ob_get_contents());
		fclose($this->fh); //Cierre de archivo
		
		if(!$this->debug)
			ob_end_clean();
	}

	//////////////////////////////////////////
	function add_host_station(){
		do {
			$faction = $this->factions[array_rand($this->factions)]; # se selecciona la raza de la HostStation a colocar
			$host_vehicle = 0; # vehículo de la HostStation se inicializa a 0
			
			if($this->num_hosts[$faction] < 2) { # si aún no hay 2 hosts
				$this->num_hosts[$faction]++; # la agregamos

				switch($faction){ # asignamos el vehículo de acuerdo a la raza...
					case 'sul': $host_vehicle = 61; break;
					case 'myk': $host_vehicle = 58; break;
					case 'tae': $host_vehicle = 60; break;
					case 'bla': $host_vehicle = 62; break;
					case 'gho': $host_vehicle = rand(0, 1) ? 59 : 57; break;
				}

				list($x, $y) = $this->distribute_host($faction); #se verifican las distancias entre HostStations (X)
				$this->host_x[$faction][] = $x;
				$this->host_y[$faction][] = $y;
				$energy = 800 + rand(0, 600); #se calcula la energía inicial (min 2000, max 3500)

				echo	'begin_robo'."\n\t".
						'owner	= '.$this->fid($faction)."\n\t".
						'vehicle	= '.$host_vehicle."\n\t".

				'pos_x        = '.((12 * $x) + 6).'00'."\n\t". #Posición X
				'pos_y        = -'.(20 + rand(0, 25)).'0'."\n\t". #Posición Z
				'pos_z        = -'.((12 * $y) + 6).'00'."\n\t". #Posición Y
				'energy       = '.$energy.'000'."\n\t".
				'reload_const = '.(21 * $energy).'0'."\n\t". #ReloadConst = Energy * .3
				'con_budget   = '.(rand(0, 50) + 50)."\n\t".
				'con_delay    = '.(rand(0, 75)).'000'."\n\t".
				'def_budget   = '.(rand(0, 40) + 60)."\n\t".
				'def_delay    = '.(rand(0, 75)).'000'."\n\t".
				'rec_budget   = '.(rand(0, 50) + 50)."\n\t".
				'rec_delay    = '.(rand(0, 75)).'000'."\n\t".
				'rob_budget   = '.(rand(0, 50) + 50)."\n\t".
				'rob_delay    = '.(rand(0, 75)).'000'."\n\t".
				'pow_budget   = '.(rand(0, 60) + 40)."\n\t".
				'pow_delay    = '.(rand(0, 75)).'000'."\n\t".
				'rad_budget   = '.(rand(0, 20) + 10)."\n\t".
				'rad_delay    = '.(rand(0, 75)).'000'."\n\t".
				'saf_budget   = '.(rand(0, 50) + 50)."\n\t".
				'saf_delay    = '.(rand(0, 75)).'000'."\n\t".
				'cpl_budget   = '.(rand(0, 70) + 30)."\n\t".
				'cpl_delay    = '.(rand(0, 75)).'000'."\n".
				'end'."\n";
			}
		}while (!$host_vehicle); //Intentar crear de nuevo una HostStation
	}

	////////////////////// Función para Verificar distancias entre HostStations

	function distribute_host($added_faction){
		do {
			$test_x = rand(0, $this->size_x - 2) + 1;
			$test_y = rand(0, $this->size_y - 2) + 1;
			$invalid_position = false;

			foreach($this->factions as $faction){
				if($faction != $added_faction){ # Verifica la distancia únicamente de Hosts enemigas
					for($ene = 0; $ene < $this->num_hosts[$faction]; $ene++){
						if(sqrt(pow($this->host_x[$faction][$ene] - $test_x, 2) + pow($this->host_y[$faction][$ene] - $test_y, 2)) < 4){ // Demasiado cerca
							$invalid_position = true;
							break;
						}
					}
					
					if($invalid_position) break;
				}
			}
		} while($invalid_position);

		return array($test_x, $test_y);
	}

	/////////////////// Función para Posicionar Escuadrones iniciales 

	function add_squad(){
		echo 'begin_squad'."\n";

		do {
			$faction_id = array_rand($this->factions);
			$faction = $this->factions[$faction_id];
		} while(!$this->num_hosts[$faction] && false);	# Si la raza del squad no está jugando, se reintenta. # TODO

		echo	"\t".'owner     = '.$faction_id."\n"; //Ya escogida la raza..

		switch ($faction_id){
			case 1:
				do{
					$vehicle = rand(0,15) + 1;
					$squad_size = ($vehicle == 9) ? 1 : rand(0,10) + 1; # Si es un Scout sólo se asigna 1 unidad
				} while($vehicle == 13);
				break;
			case 2:
				$vehicle = rand(0,3) + 71;
				$squad_size = ($vehicle == 74) ? 1 : rand(0,9) + 1;
				break;
			case 3:
				$vehicle = rand(0,7) + 63;
				$squad_size = ($vehicle == 67) ? 1 : rand(0,9) + 1;
				break;
			case 4:
				$vehicle = rand(0,6)?rand(0,6) + 32:(rand(0,3)?8:131);
				$squad_size = ($vehicle == 35) ? 1 : rand(0,9) + 1;
				break;
			case 5:
				$vehicle = rand(0,1)?rand(0,15) + 1:(rand(0,1)?rand(0,9) + 22:(rand(0,5)?rand(0,11) + 63:rand(0,1) + 130));
				$squad_size = (array_search($vehicle,array(9,74,67,35,29))!== false) ? 1 : rand(0,10) + 1; # Si es cualquiera de los scouts..
				break;
			case 6:
				$vehicle = rand(0,7)?rand(0,10) + 22:130;
				$squad_size = ($vehicle == 29) ? 1 : rand(0,10) + 1;
				break;
		}
		echo "\t".'vehicle   = '.$vehicle."\n";
		echo "\t".'num       = '.$squad_size."\n";

		do {
			$band = 0;
			$pos = rand(0, $this->size_x - 2) + 1; //Se asignan unas coordenadas X

			for ($cc = 1; $cc < 7; $cc++){
				for ($cc2 = 0; $cc2 < 3; $cc2++){
					if ($pos == $this->host_x[$this->factions[$cc]][$cc2]) //Se verifica que no sean de ninguna hostStation #TODO
						$band++;
				}
			}
		} while($band > 0); //Se calcula de nuevo hasta no coincidir con ninguna ya existente
		echo "\t".'pos_x     = '.(12 * $pos + 6).'00'."\n"; //Se escribe la posición en X

		do {
			$band = 0;
			$pos = rand(0, $this->size_y - 2) + 1; //Se asignan unas coordenadas Y

			for ($cc = 1; $cc < 7; $cc++){
				for ($cc2 = 0; $cc2 < 3; $cc2++){
					if ($pos == $this->host_y[$cc][$cc2]) //Se verifica que no sean de ninguna hostStation
						$band++;
				}
			}
		} while($band > 0); //Se calcula de nuevo hasta no coincidir con ninguna ya existente

		echo "\t".'pos_z     = -'.(12 * $pos + 6).'00'."\n"; //Se escribe la posición en Y
		if(rand(0, 2))
			echo"\t".'mb_status =	unknown'."\n";

		echo 'end'."\n";
	}

	////////////////////////////////// Maps
	function build_maps(){

		///////////////////// typ

		# definition
		echo "\t".'typ_map ='."\n\t".$this->size_x.' '.$this->size_y."\n";

		# 1era fila
		echo "\t\t".'f8 ';
		for($c = 0; $c < $this->size_x - 2; $c++)
			echo 'fc ';
		echo 'f9'."\n";

		# body
		for($c = 0; $c < $this->size_y - 2; $c++){
			echo "\t\tff";
			for($c2 = 0; $c2 < $this->size_x - 2; $c2++)
				printf(" %02x", $this->slots[array_rand($this->slots[$this->set])]);
			echo " fd\n";
		}

		# ultima fila
		echo "\t\t".'fb';
		for ($c = 0; $c < $this->size_x-2; $c++)
			echo ' fe';
		echo ' fa'."\n";
		
		///////////////////// own

		# definition
		echo "\t".'own_map ='."\n\t".$this->size_x.' '.$this->size_y."\n";

		# inicializado en 0
		$map = array_fill(0, $this->size_x - 1, array_fill(0, $this->size_y - 1, 0));
		$ideal_territory = ($this->size_x - 2) * ($this->size_y - 2) * 3 / 2 * array_sum($this->num_hosts); // i (número ideal de sectores para cada raza) = área total de sectores / número total de HostStations + 30%

		# Mapear colores
		$this->make_territory('res');
		$this->make_territory('sul');
		$this->make_territory('myk');
		$this->make_territory('tae');
		$this->make_territory('bla');
		$this->make_territory('gho');

		# Imprimir mapa
		for($c = 0; $c < $this->size_y; $c++){
			echo "\t\t";

			for($c2 = 0; $c2 < $this->size_x; $c2++){
				printf("%02d ", $map[$c2][$c]);
			}

			echo "\n";
		}
		
		///////////////////// hgt 

		echo "\t".'hgt_map ='."\n\t".$this->size_x.' '.$this->size_y."\n";
		$x = $y = 1;
		$base_height = 50 + (rand(0, 50) - 25);

		for ($c = 1; $c < $this->size_y - 1; $c++){
			for ($c2 = 1; $c2 < $this->size_x - 1; $c2++){
				$map[$c2][$c] = $base_height;
				$this->calculate_adjacent_height($base_height, $c2, $c);

				if ($map[$c2 - 1][$c] != 0 && $map[$c2 - 1][$c] != 1)
					$height = $map[$c2-1][$c] + rand(0, 5) - 2;
			}
		}

		////// Igualar bordes horizontales
		for ($c = 0; $c < $this->size_x; $c++){
			$map[$c][0] = $map[$c][1];
			$map[$c][$this->size_y - 1] = $map[$c][$this->size_y - 2];
		}

		////// Igualar bordes verticales
		for ($c = 0; $c < $this->size_y; $c++){
			$map[0][$c] = $map[1][$c];
			$map[$this->size_x - 1][$c] = $map[$this->size_x - 2][$c];
		}

		for ($c = 0; $c < $this->size_y; $c++){
			echo "\t\t";
			for ($c2 = 0; $c2 < $this->size_x; $c2++)
				printf("%02x ", $map[$c2][$c]);
			echo "\n";
		}

		///////////////////// blg
		
		echo "\t".'blg_map ='."\n";
		echo "\t".$this->size_x.' '.$this->size_y."\n";

		// Giving PowerStation to EnemyStations
		for ($c = 0; $c < $this->size_y; $c++){
			for ($c2 = 0; $c2 < $this->size_x; $c2++){
				for($c3 = 0; $c3 < 3; $c3++){
					if ($c2 == $this->host_x['sul'][$c3] && $c == $this->host_y['sul'][$c3])
						$blg[$c2][$c] = 10;
					if ($c2 == $this->host_x['myk'][$c3] && $c == $this->host_y['myk'][$c3])
						$blg[$c2][$c] = 10;
					if ($c2 == $this->host_x['tae'][$c3] && $c == $this->host_y['tae'][$c3])
						$blg[$c2][$c] = 17;
					if ($c2 == $this->host_x['bla'][$c3] && $c == $this->host_y['bla'][$c3])
						$blg[$c2][$c] = 14;
					if ($c2 == $this->host_x['gho'][$c3] && $c == $this->host_y['gho'][$c3])
						$blg[$c2][$c] = 12;
				}
			}
		}

		for ($c = 0; $c < $this->size_y; $c++){
			echo "\t\t";
			for($c2 = 0; $c2 < $this->size_x; $c2++)
				printf("%02x ", $blg[$c2][$c]);
			echo "\n";
		}
	}

	////////////////////////

	function fid($faction){
		return array_search($faction, $this->factions);
	}

	function make_territory($faction){ //nr = número identificador de raza, cr = cantidad de HostStations de esa raza
		$faction_num_hosts = $this->num_hosts[$faction];
		if(!$faction_num_hosts) return;

		$faction_id = $this->fid($faction);
		
		do {
			# Coordenadas de la HostStation
			$x = $this->host_x[$faction][$faction_num_hosts - 1];
			$y = $this->host_y[$faction][$faction_num_hosts - 1];
			
			$this->adjacent_territory($faction_id, $x, $y); 

			for($c = 0; $c < $ideal_territory; $c++){
				if (rand(0, 1)){
					# Elige nuevo pivote
					$x = $x + (rand(0, 3) - 1);
					$y = $y + (rand(0, 3) - 1);
					$this->adjacent_territory($faction_id, $x, $y);
				}
			}

			$faction_num_hosts--;
		} while($faction_num_hosts > 0);
	}

	//////////////////////// Función que asinga el valor alrededor del punto inicial
	
	function adjacent_territory($faction_id, $x, $y){
		$map[$x-1][$y-1] = $faction_id;
		$map[$x-1][$y] = $faction_id;
		$map[$x][$y-1] = $faction_id;
		$map[$x+1][$y+1] = $faction_id;
		$map[$x+1][$y] = $faction_id;
		$map[$x][$y+1] = $faction_id;
		$map[$x+1][$y-1] = $faction_id;
		$map[$x-1][$y+1] = $faction_id;
	}

	/////////////////////////////////////

	function calculate_adjacent_height($height, $x2, $y2){
		$map[$x2-1][$y2] = $height + (rand(0, 6) - 3);
		$map[$x2][$y2-1] = $height + (rand(0, 6) - 3);
		$map[$x2+1][$y2+1] = $height + (rand(0, 6) - 3);
		$map[$x2+1][$y2] = $height + (rand(0, 6) - 3);
		$map[$x2][$y2+1] = $height + (rand(0, 6) - 3);
		$map[$x2+1][$y2-1] = $height + (rand(0, 6) - 3);
		$map[$x2-1][$y2+1] = $height + (rand(0, 6) - 3);
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

$ua = new Urbanassault(); 
$ua->make_level('single');
?>