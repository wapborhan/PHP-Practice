<?php

namespace App\Http\Helpers;

class SpotConfigHelper{
    CONST CONFIG_FILE = 'spot_config.json';
    
	static public function setValue($key,$value)
	{
        $config_path = base_path(Self::CONFIG_FILE);
		$jsonString = file_get_contents($config_path);
		$data = json_decode($jsonString, true);
        $data[$key] = $value;
		$newJsonString = json_encode($data,JSON_PRETTY_PRINT);
		file_put_contents($config_path, $newJsonString);
	}

    static public function getValue($key)
	{
        $config_path = base_path(Self::CONFIG_FILE);
		$jsonString = file_get_contents($config_path);
		$data = json_decode($jsonString, true);
        return $data[$key];
    }

}