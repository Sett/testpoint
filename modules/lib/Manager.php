<?php
/**
 * For choosing which modules needs for the TestPoint
 */
class TestPoint_Manager
{
    /**
     * @param string $resultClassName
     * @param string $cfgPath
     * @param string $cfgType
     */
    public static function compile($resultClassName = '', $cfgPath = '', $cfgType = 'json')
    {
        $cfg           = self::getConfig($cfgPath, $cfgType);
        $traits        = self::getTraits($cfg);
        $traitBasePath = self::getPath('trait', $cfg);
        $classBasePath = self::getPath('class', $cfg);

        $use     = 'use ';
        $require = '';
        $count   = count($traits)-1;

        foreach($traits as $index => $trait)
        {
            $quot = ($count == $index) ? ';' : ', ' . "\n\t\t";
            $sub  = self::subTraits($trait, $traitBasePath, $classBasePath);

            $use     .= $sub['use'] . $quot;
            $require .= $sub['require'];
        }

        $result = "<?php\n\n" . $require . "\nclass " . $resultClassName . "\n{\n\t" . $use . "\n}";

        echo "\n\n" . $result . "\n\n";

        file_put_contents(__DIR__ . '/../../' . $resultClassName . '.php', $result);
    }
    
    /**
     * @param string $path
     * @param string $type
     * @return array
     */
    public static function getConfig($path = '', $type = 'json')
    {
        if($type == 'json')
            return json_decode(file_get_contents($path. '.' .$type), true);

        return require_once $path . '.' . $type;
    }

    /**
     * @param string|array $traits
     * @param string $traitBasePath
     * @param string $classBasePath
     * @return string
     */
    public static function subTraits($traits, $traitBasePath = '', $classBasePath = '')
    {
        $use     = '';
        $require = '';

        if(is_array($traits))
        {
            $name      = self::getName($traits);
            $subTraits = self::getTraits($traits);
            $require  .= self::getClasses($traits, $classBasePath);

            $out      = self::getOutTraits($traits);
            $use     .= $out['use'];
            $require .= $out['require'];

            foreach($subTraits as $trait)
            {
                $sub      = self::subTraits($trait, $traitBasePath . $name . '/');// send a parent in the path
                $use     .= $name . '_' . $sub['use'] . ', ' . "\n\t\t";// Name_SubTrait,
                $require .= $sub['require'];
            }

            $use     .= $name ? $name : '';
            $require .= $name ? "require_once '" . __DIR__ . '/../../' . $traitBasePath . self::convertName($name) . ".php';\n" : '';
        }
        elseif(is_string($traits))
        {
            $use     = $traits;
            $require = "require_once '" . __DIR__ . '/../../' . $traitBasePath . self::convertName($traits) . ".php';\n";
        }

        return ['use' => $use, 'require' => $require];
    }

    /**
     * @param array $data
     * @return array
     */
    public static function getOutTraits($data)
    {
        $outTraits = isset($data['outTraits']) ? $data['outTraits'] : [];

        $require = '';
        $use = '';

        foreach($outTraits as $trait => $path)
        {
            $require .= "require_once '" . __DIR__ . '/../../' . $path . "';\n";
            $use .= $trait . ', ' . "\n\t\t";
        }

        return ['use' => $use, 'require' => $require];
    }

    /**
     * @param string $what
     * @param array $cfg
     * @return string
     */
    public static function getPath($what = '' , array $cfg)
    {
        return isset($cfg['path'][$what]) ? $cfg['path'][$what] : '';
    }

    /**
     * @param array $data
     * @return array
     */
    public static function getTraits(array $data)
    {
        return isset($data['traits']) ? $data['traits'] : [];
    }

    /**
     * @param array $data
     * @param string $classBasePath
     * @return string
     */
    public static function getClasses(array $data, $classBasePath)
    {
        $libs = isset($data['class']) ? $data['class'] : [];

        $require = '';

        foreach($libs as $lib)
            $require .= "require_once '" . __DIR__ . '/../../' . $classBasePath . $lib . ".php';\n";

        return $require;
    }


    /**
     * @param array $data
     * @return string
     */
    public static function getName(array $data)
    {
        return isset($data['name']) ? $data['name'] : '';
    }

    /**
     * @param int $index
     * @param int $count
     * @return string
     */
    public static function quot($index = 0, $count = 0)
    {
        return ($index == $count) ? ';' . "\n\t" : ', ' . "\n\t";
    }

    /**
     * @param string $name
     * @param string $from
     * @param string $to
     * @return string
     */
    public static function convertName($name = '', $from = '_', $to = '/')
    {
        return (strpos($name, $from) !== false) ? str_replace($from, $to, $name) : $name;
    }
}
