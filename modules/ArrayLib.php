<?php
/**
 * Class ArrayLib
 */
trait ArrayLib
{
    /**
     * @param array $array source array
     * @param string $kvGlue
     * @param string $startElGlue
     * @param string $endElGlue
     * @return string
     */
    public function array_glue(array $array, $kvGlue = '', $startElGlue = '', $endElGlue = '')
    {
        $result = '';

        foreach($array as $key => $value)
            $result .= $startElGlue . $key . $kvGlue . $value . $endElGlue;

        return $result;
    }
}
