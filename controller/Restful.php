<?php

class Restful
{
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
    /** 
     * @return array 
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        return $uri;
    }
    /**
     * @param array $query
     * @return void
     */
    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }
    /** 
     * @param mixed $data 
     * @param string $httpHeader 
     */
    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
}
