<?php

namespace Lumenx\Enum;

use Illuminate\Support\Str;

abstract class Enum
{
    protected static $excludeConstants = [];

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getConstants()
    {
        $constants = (new \ReflectionClass(get_called_class()))->getConstants();

        foreach ($constants as $k => $v) {
            if (in_array($k, self::$excludeConstants)) {
                unset($constants[$k]);
            }
        }

        return $constants;
    }

    /**
     * @param      $value
     * @param null $strto
     *
     * @return string
     * @throws \ReflectionException
     */
    public static function getKey($value, $strto = null)
    {
        $key = array_flip(self::getConstants())[$value];
        switch ($strto) {
            case 'upper':
                return Str::upper($key);
            case 'lower':
                return Str::lower($key);
        }
        return $key;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getKeys($strto = null)
    {
        $keys = array_keys(self::getConstants());
        switch ($strto) {
            case 'upper':
                return array_map([Str::class, 'upper'], $keys);
            case 'lower':
                return array_map([Str::class, 'lower'], $keys);
        }
        return $keys;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getUpperKeys()
    {
        return self::getKeys('upper');
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getLowerKeys()
    {
        return self::getKeys('lower');
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getValues()
    {
        return array_values(self::getConstants());
    }

    /**
     * @param $value
     *
     * @return bool
     * @throws \ReflectionException
     */
    public static function existsValue($value)
    {
        return in_array($value, self::getValues());
    }

    /**
     * @param $key
     *
     * @return bool
     * @throws \ReflectionException
     */
    public static function existsKey($key)
    {
        return in_array($key, self::getKeys());
    }
}