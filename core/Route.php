<?php

class Route
{
    private $uri;
    public function handleRoute($url)
    {
        global $routesConfig;
        unset($routesConfig['default_controller']);
        $url = trim($url, '/');
        $handleUrl = $url;
        if (!empty($routesConfig)) {
            foreach ($routesConfig as $key => $value) {
                // Check đường dẫn có khớp
                if (preg_match('~' . $key . '~is', $url)) {
                    // Thay thế
                    $handleUrl = preg_replace('~' . $key . '~is', $value, $url);
                    $this->uri = $key;
                }
            }
        }
        return $handleUrl;
    }
    public function getUri()
    {
        return $this->uri;
    }
}
