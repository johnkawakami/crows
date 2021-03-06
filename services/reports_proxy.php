<?
/*
 * Crows - Crowd Syndication 1.0
 * Copyright 2009
 * contact@crowsne.st
 */


/*
 * This file is part of Crows.
 *
 * Crows is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Crows is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Crows.  If not, see <http://www.gnu.org/licenses/>.
 *  */



include_once('../config.php');
header("Content-type: text/json");

//php<5.2 json_encode  compatibility function

if (!function_exists('json_encode'))
{
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}

	switch($database_type) {

		case "csv":
			$handle = fopen("../reports.csv", "r");
			
			while(($data = fgetcsv($handle, 0, "|"))!== FALSE) {
				$reports['id']=$i;
				$reports['date']=$data[0].'';
				$reports['title']=$data[1].'';
				$reports['name']=$data[2].'';
				$reports['location']=$data[3].'';
				$reports['lat']=$data[4].'';
				$reports['long']=$data[5].'';
				$reports['report']=$data[6].'';
				$reports['link']=$data[7].'';
				$reports['photo']=$data[8].'';
				$reports['embed']=$data[9].'';
				$array[]=$reports;
			}
		 
			
			break;
		case "db":
			$dbhandle = new PDO($database_dsn, $database_user, $database_password);
			$result = $dbhandle->query('SELECT id, date, title, name, location, lat, `long`, report, link, photo, embed FROM reports');
			if(!$result) print_r($dbhandle->errorInfo());	
			foreach($result->fetchAll() as $data) {
				$reports['id']=$data['id'];
				$reports['date']=$data['date'].'';
				$reports['title']=$data['title'].'';
				$reports['name']=$data['name'].'';
				$reports['location']=$data['location'].'';
				$reports['lat']=$data['lat'].'';
				$reports['long']=$data['long'].'';
				$reports['report']=$data['report'].'';
				$reports['link']=$data['link'].'';
				$reports['photo']=$data['photo'].'';
				$reports['embed']=$data['embed'].'';
				$array[]=$reports;
			}
			break;

	}
	if(count($array) == 0) {
	  $array[]=array('id'=>1,'title'=>'No reports yet. Make the first!'); 
	} 
	
	$array=array_reverse($array);

	$reportdata=json_encode($array);
	$reportdata=str_replace('\\\\\\"','\\"',$reportdata);

	$reportdata=str_replace("\\'","'",$reportdata);
	
	print($reportdata);
	
?>
