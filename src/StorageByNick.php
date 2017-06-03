<?php

namespace PedagangAmanah;

class StorageByNick
{
    public static $storage = [];

    protected static $columns = [
        'nick' => 'Nama Character',
        'server' => 'Server',
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
        if (isset($each['nick'])) {
            $array['nick'] = $each['nick'];
            $array['server'] = isset($each['server']) ? (string) $each['server'] : '';
            $array['desc'] = isset($each['desc']) ? (string) $each['desc'] : '';
            $array['link'] = isset($each['link']) ? (string) $each['link'] : '';
            $array['reporter'] = isset($each['reporter']) ? (string) $each['reporter'] : '';
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
