<?php
class MY_Router extends CI_Router {
    function __construct() {
        parent::__construct();
    }
    
    function _validate_request($segments)
    {
        if (count($segments) == 0)
        {
            return $segments;
        }
    
        // Does the requested controller exist in the root folder?
        if (file_exists(APPPATH.'controllers/'.$segments[0].'.php'))
        {
            return $segments;
        }
    
        // Is the controller in a sub-folder?
        if (is_dir(APPPATH.'controllers/'.$segments[0]))
        {
            // Set the directory and remove it from the segment array
            $this->set_directory($segments[0]);
            $segments = array_slice($segments, 1);
    
            if (count($segments) > 0)
            {
                // Does the requested controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].'.php'))
                {
                    if ( ! empty($this->routes['404_override']))
                    {
                        $x = explode('/', $this->routes['404_override']);
    
                        $this->set_directory('');
                        $this->set_class($x[0]);
                        $this->set_method(isset($x[1]) ? $x[1] : 'index');
    
                        return $x;
                    }
                    else
                    {
                        show_404($this->fetch_directory().$segments[0]);
                    }
                }
            }
            else
            {
                // Is the method being specified in the route?
                if (strpos($this->default_controller, '/') !== FALSE)
                {
                    $x = explode('/', $this->default_controller);
    
                    $this->set_class($x[0]);
                    $this->set_method($x[1]);
                }
                else
                {
                    $this->set_class($this->default_controller);
                    $this->set_method('index');
                }
    
                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.'.php'))
                {
                    $this->directory = '';
                    return array();
                }
    
            }
    
            return $segments;
        }
    
    
        // If we've gotten this far it means that the URI does not correlate to a valid
        // controller class.  We will now see if there is an override
        if ( ! empty($this->routes['404_override']))
        {
            $x = explode('/', $this->routes['404_override']);
    
            $this->set_class($x[0]);
            $this->set_method(isset($x[1]) ? $x[1] : 'index');
    
            return $x;
        }
    
    
        // Nothing else to do at this point but show a 404
        $x = $this->general_mapping($segments);
        return $x;
        
        show_404($segments[0]);
    }
    
    function general_mapping($segments) {
        // $route['(:any)/(:num)/edit'] = 'general/edit/$1/$2';
        // $route['(:any)/(:num)/update'] = 'general/update/$1/$2';
        // $route['(:any)/(:num)/delete'] = 'general/delete/$1/$2';
        // $route['(:any)/add'] = 'general/add/$1';
        // $route['(:any)/save'] = 'general/save/$1';
        // $route['(:any)/list'] = 'general/list/$1';
        // $route['(:any)/index'] = 'general/index/$1';
        // $route['(:any)/(:num)'] = 'general/view/$1/$2';
        // $route['(:any)'] = 'general/index/$1';
        $this->set_directory('');
        $this->set_class('general');
        
        $x = array();
        $x[] = 'general';
        
        if (count($segments) == 3) {
            $this->set_method($segments[2]);
            $x[] = $segments[2];
        } else if (count($segments) == 2) {
            if (intval($segments[1]) > 0) {
                $this->set_method('view');
                $x[] = 'view';
                $x[] = $segments[0];
                $x[] = $segments[1];
            } else {
                $this->set_method($segments[1]);
                $x[] = $segments[1];
                $x[] = $segments[0];
            }
        } else {
            $this->set_method('index');
            $x[] = 'index';
            $x[] = $segments[0];
        }
        return $x;
    }
}