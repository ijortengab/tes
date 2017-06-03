<?php

namespace PedagangAmanah;

class StorageByBank
{
    public static $storage = [];

    protected static $columns = [
        'user_account' => 'Nomor Rekening (Bank)',
        'user_name' => 'Atas Nama',
        'desc' => 'Modus',
        'source' => 'Sumber',
    ];

    /**
     *
     */
    public static function save(array $array)
    {
        if ($array === []) {
            return;
        }
        foreach ($array as $each) {
            self::set($each);
        }
    }

    /**
     *
     */
    public static function getColumns()
    {
        return self::$columns;
    }

    /**
     *
     */
    protected function set(array $each)
    {
        $array = [];
        if (
            isset($each['bank']['name']) &&
            isset($each['bank']['user_account']) &&
            isset($each['bank']['user_name'])
        ) {
            $array['bank_user_name'] = (string) $each['bank']['user_name'];
            $array['bank_user_account'] = (string) $each['bank']['user_account'];
            $array['bank_name'] = (string) $each['bank']['name'];
            $array['reporter'] = isset($each['reporter']) ? (string) $each['reporter'] : "";
            $array['desc'] = isset($each['desc']) ? (string) $each['desc'] : "";
            $array['link'] = isset($each['link']) ? (string) $each['link'] : "";
            $array['user_account'] = $array['bank_user_account'] . ' (' . $array['bank_name'] . ')';
            $array['user_name'] = $array['bank_user_name'];
            $array['source'] = empty($array['link']) ? $array['reporter'] : '<a target="_blank" href="'.$array['link'].'">'.$array['reporter'].'</a>';
            $screenshot = array_key_exists('screenshot', $each) ? (array) $each['screenshot'] : [];
            $screenshots = array_key_exists('screenshots', $each) ? (array) $each['screenshots'] : [];
            $screenshots = array_merge($screenshots, $screenshot);            
            if (!empty($screenshots)) {
                while ($screenshot = array_shift($screenshots)) {
                    $array['source'] .= ' <a target="_blank" href="'.$screenshot.'"><i class="fa fa-camera fa-fw"></i></a>';
                }
            }
            // Rapihkan.
            self::$storage[] = array_values(array_merge(array_flip(array_keys(self::$columns)), $array));
        }
    }
}
