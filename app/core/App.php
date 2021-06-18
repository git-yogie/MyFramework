<?php


class App
{
    protected $Controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->pareUrl();

        //cek dan timpa controller jika $url tidak kosong
        if(isset($url[0])){
            if (file_exists('../app/controllers/' . $url[0].'.php' )) {
                $this->Controller = $url[0];
                unset($url[0]);
            }
        }

        //memanggil controller 
        require_once '../app/controllers/' . $this->Controller . '.php';
        //insialisasi controller # membuat objek baru
        $this->Controller = new $this->Controller;

        //menimpa method jika ada dan ada pada class
        if (isset($url[1])) {
            if (method_exists($this->Controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //menimpa parameter jika ada
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        //memanggil controller dan method serta mengirim parameternya
        call_user_func_array([$this->Controller,$this->method],$this->params);
    }

    public function pareUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        
    }
}
