<?php
require_once 'ParseXml.class.php';

class AlexaRank extends ParseXml {
    private $data;
    private $values = array();

    function __construct($domain) {
        $this->data = $this->fetchData($domain);
        $this->findValue();
    }

    private function fetchData($domain) {
        // http://data.alexa.com/data?cli=10&dat=snbamz&url=%YOUR_URL%
        $url = "http://data.alexa.com/data?cli=10&dat=snbamz&url=http://".trim($domain);
        $this->LoadRemote($url, 5);
        $dataArray = $this->ToArray();
        return $dataArray;
    }

    private function findValue() {
        $this->values = array(
                'rank' => (isset($this->data['SD'][1]['POPULARITY']['@attributes']['TEXT']) ? ($this->data['SD'][1]['POPULARITY']['@attributes']['TEXT']) : NULL),
                'created' => (isset($this->data['SD'][0]['CREATED']['@attributes']['DATE']) ? ($this->data['SD'][0]['CREATED']['@attributes']['DATE']) : NULL),
                'email' => (isset($this->data['SD'][0]['EMAIL']['@attributes']['ADDR']) ? ($this->data['SD'][0]['EMAIL']['@attributes']['ADDR']) : NULL),
                'linksin' => (isset($this->data['SD'][0]['LINKSIN']['@attributes']['NUM']) ? ($this->data['SD'][0]['LINKSIN']['@attributes']['NUM']) : NULL),
                'reach' => (isset($this->data['SD'][1]['REACH']['@attributes']['RANK']) ? ($this->data['SD'][1]['REACH']['@attributes']['RANK']) : NULL),
                'baseuri' => (isset($this->data['DMOZ']['SITE']['@attributes']['BASE']) ? ($this->data['DMOZ']['SITE']['@attributes']['BASE']) : NULL),
                'title' => (isset($this->data['DMOZ']['SITE']['@attributes']['TITLE']) ? ($this->data['DMOZ']['SITE']['@attributes']['TITLE']) : NULL),
                'description' => (isset($this->data['DMOZ']['SITE']['@attributes']['DESC']) ? ($this->data['DMOZ']['SITE']['@attributes']['DESC']) : NULL),
        );
    }

    public function get($value = NULL){
        if($value === NULL) {
            return $this->values; //Return the total Array
        } else {
            return (isset($this->values[$value]) ? $this->values[$value] : '"'.$value.'" does not exist.');
        }
    }
}
?>