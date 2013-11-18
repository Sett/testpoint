<?php
/**
 * For choosing which modules needs for the TestPoint
 */
class TestPoint_Manager
{
    /**
     * @param string $resultClassName
     * @param string $cfgPath
     * @param string $traitBasePath
     */
    public static function compile($resultClassName = '', $cfgPath = '', $traitBasePath = '/')
    {
        $cfg = json_decode(file_get_contents($cfgPath), true);
        $traits = isset($cfg['traits']) ? $cfg['traits'] : [];

        $use = 'use ';
        $require = '';
        $count = count($traits)-1;

        foreach($traits as $index => $trait)
        {
            $quot = ($count == $index) ? ';' : ', ' . "\n\t";
            $sub = self::subTraits($trait);

            $use .= $sub['use'] . $quot;
            $require .= $sub['require'];
        }

        $result = "<?php\n\n" . $require . "\nclass " . $resultClassName . "\n{\n\t" . $use . "\n}";

        echo "\n\n" . $result . "\n\n";

        file_put_contents($resultClassName . '.php', $result);
    }

    /**
     * @param string|array $traits
     * @param string $traitBasePath
     * @return string
     */
    public static function subTraits($traits, $traitBasePath = '')
    {
        $use = '';
        $require = '';

        if(is_array($traits))
        {
            $name = self::getName($traits);
            $subTraits = self::getTraits($traits);

            foreach($subTraits as $trait)
            {
                $sub = self::subTraits($trait, $traitBasePath . $name . '/');// send a parent in the path
                $use .= $name . '_' . $sub['use'] . ', ' . "\n\t";// Name_SubTrait,
                $require .= $sub['require'];
            }

            $use .= $name ? $name : '';
            $require .= $name ? "require_once '" . $traitBasePath . $name . ".php';\n" : '';
        }
        elseif(is_string($traits))
        {
            $use = $traits;
            $require = "require_once '" . $traitBasePath . $traits . ".php';\n";
        }

        return ['use' => $use, 'require' => $require];
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
