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
        $traitsCount = count($traits)-1;

        foreach($traits as $index => $traitName)
        {
            $quot = ($index == $traitsCount) ? ';' : ', ';
            $use .= $traitName . $quot;
            $traitName = self::convertName($traitName);
            $require .= "require_once '" . $traitBasePath . $traitName . ".php';\n";
        }



        $result = "<?php\n\n" . $require . "\nclass " . $resultClassName . "\n{\n\t" . $use . "\n}";

        echo "\n\n" . $result . "\n\n";

        file_put_contents($resultClassName . '.php', $result);
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
