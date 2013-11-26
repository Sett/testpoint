<?php
/**
 * @use Log
 */

/*
 --log-json|tap|junit <fileToSave>
 --filter <pattern>
 --group <group name>
 --exclude-group <group name>
 --list-groups List available test groups
 --testdox-html|text <fileToSave>
 --coverage-clover|html|php|text <file>|<dir> for html

 --loader <loader>         TestSuiteLoader implementation to use.
 --printer <printer>       TestSuiteListener implementation to use.
 --repeat <times>          Runs the test(s) repeatedly.

 --process-isolation       Run each test in a separate PHP process.
 --no-globals-backup       Do not backup and restore $GLOBALS for each test.
 --static-backup           Backup and restore static attributes for each test.

 --bootstrap <file>        A "bootstrap" PHP file that is run before the tests.
 --configuration <file> Read configuration from XML file.
 --no-configuration        Ignore default configuration file (phpunit.xml).
 --include-path <path(s)>  Prepend PHP's include_path with given path(s).

 -d key[=value]            Sets a php.ini value.
*/

trait PHPUnit
{
    /**
     * @param array $result
     * @return mixed
     */
    public function getResultLine(array $result)
    {
        $resultLine  = array_pop($result);

        $start = time();

        while(strpos($resultLine, 'tests') === false)
        {
            $resultLine = array_pop($result);
            if((time() - $start) > 30)
                break;
        }

        return $resultLine;
    }

    /**
    * @param $test
    * @param array $flags
    * @return mixed
    */
    public function exec($test, $flags = [])
    {
        $flagsResult = '';

        $flags = empty($flags) ? $this->config['phpunit'] : $flags;

        foreach($flags as $flag => $data)
            $flagsResult .= method_exists($this, $flag . 'ApplyFlag') ? $this->{$flag . 'ApplyFlag'}() . ' ' : '';

        $this->say('Launch ' . $this->colorText('phpunit ' . $flagsResult . $test, 'bold'));

        exec('phpunit ' . $flagsResult . $test, $output);
        return $output;
    }

    /**
     * DRY func
     * @param string $name
     * @return string
     */
    public function getFileTypeFlag($name = '')
    {
        $flag = $this->getFlagInfo($name, '', true);

        if(isset($flag['turn']) && ($flag['turn'] == 'on'))
            return '--' . $name . '-' . $flag['type'] . ' ' . $flag['fileName'];

        return '';
    }

    /**
     * DRY func
     * @param string $name
     * @param bool $useFlag for flags like "loader"
     * @return string
     */
    public function getSelfFlag($name = '', $useFlag = true)
    {
        $value  = $this->getFlagInfo('self', $name);// "phpunit" : { "self" : {$name : $value} }
        $result = ($value != '') ? '--' . $name : '';

        return $useFlag ? $result . ' ' . __DIR__ . '/../' . $value . ' ' : $result . ' ';
    }

    /**
     * @return string
     */
    public function selfApplyFlag()
    {
        $result = '';

        if(isset($this->config['phpunit']['self']))
        {
            $args = [
                'loader'            => true,
                'printer'           => true,
                'repeat'            => true,
                'bootstrap'         => true,
                'configuration'     => true,

                'process-isolation' => false,
                'no-global-backup'  => false,
                'static-backup'     => false,
                'no-configuration'  => false
            ];

            foreach($this->config['phpunit']['self'] as $arg => $value)
            {
                if(isset($args[$arg]))
                    $result .= $this->getSelfFlag($arg, $args[$arg]);
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function coverageApplyFlag()
    {
        return $this->getFileTypeFlag('coverage');
    }

    /**
     * @return string
     */
    public function testdoxApplyFlag()
    {
        return $this->getFileTypeFlag('testdox');
    }

    /**
     * @return string
     */
    public function filterApplyFlag()
    {
        $filter = $this->getFlagInfo('filter', '', true);
        $result = '';

        if(isset($filter['turn']) && ($filter['turn'] == 'on'))
        {
            if($filter['pattern'])
                $result .= '--filter ' . $filter['pattern'];

            if($filter['group'])
                $result .= ' --group ' . $filter['group'];

            if(isset($filter['exclude-group']) && $filter['exclude-group'])
                $result .= ' --exclude-group ' . $filter['exclude-group'];

            if(isset($filter['list-groups']) && $filter['list-groups'])
                $result .= '--list-groups ' . implode(',', $filter['list-groups']);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function logApplyFlag()
    {
        return $this->getFileTypeFlag('log');
    }

    /**
     * @return string
     */
    public function includePathApplyFlag()
    {
        return (($includePaths = $this->getFlagInfo('self', 'includePath')) != '')
            ? '--include-path ' . implode(',', $includePaths)
            : '';
    }

    /**
     * @return string
     */
    public function dApplyFlag()
    {
        return (($d = $this->getFlagInfo('d', '', true)) == []) ? '' : $this->array_glue($d, '=', ' -d ');
    }

    /**
     * @param string $section
     * @param string $flagName
     * @param bool $returnSection
     * @return string|array
     */
    public function getFlagInfo($section = '', $flagName = '', $returnSection = false)
    {
        if($returnSection)
            return isset($this->config['phpunit'][$section]) ? $this->config['phpunit'][$section] : '';

        return isset($this->config['phpunit'][$section][$flagName]) ? $this->config['phpunit'][$section][$flagName] : '';
    }
}
