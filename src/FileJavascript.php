<?php

namespace PedagangAmanah;

class FileJavascript
{
    protected $filename;
    protected $variableName;
    protected $variableValue;
    
    /**
     * 
     */
    public function __construct($filename, $variableName, $variableValue)
    {
        $this->filename = $filename;
        $this->variableName = $variableName;
        $this->variableValue = $variableValue;
    }
    
    /**
     * 
     */
    public function save()
    {        
        $print = json_encode($this->variableValue, JSON_PRETTY_PRINT);
        $print = preg_replace('/",\n[ ]+"/','","', $print);
        $print = preg_replace('/\[\n[ ]+(.*)\n[ ]+\]/','[$1]', $print);
        $js = <<<JS
var $this->variableName = $print
JS;
        file_put_contents($this->filename, $js);
    }
    
    
    
    
}
