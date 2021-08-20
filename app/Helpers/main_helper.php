<?php 

if (!function_exists('settings')) {
	
  function settings(string $key, bool $decode = false)
  {
    $settings = session()->get('settings');

    if (!isset($settings)) {
      $settingsModel = new \App\Models\SettingsModel();
      $settings = $settingsModel->findAll();
    }

    foreach ($settings as $setting) {
      if ($setting->key == $key) {
        $value = ($decode)?json_decode($setting->value):$setting->value;
        return $value;
      }
    }

    return null;
  }

}

if (!function_exists('extracty')) {
	
  function extracty(array $dataSource, $vAttributes): array
  {
    $rs = [];
    if (is_string($vAttributes)) $vAttributes = [$vAttributes];

    foreach ($dataSource as $record) {
      foreach ($vAttributes as $vAttribute) {
        $record->$vAttribute = $record->$vAttribute;
      }
      $rs []= $record;  
    }
    
    return $rs;
  }

}