<?php
namespace Theme\Service;

/**
 * Quick And Dirty Theme Storage Using Browser Cookies
 * @author slavey
 *
 */
class ThemeStorageInvokable
{
    public function get()
    {
        if(isset($_COOKIE['theme']))
            return $_COOKIE['theme'];
        else   
            $this->set('default');
    }

    public function set($name)
    {
        $_COOKIE['theme'] = $name;
        setcookie('theme',$name, 0, "/");
    }
}
