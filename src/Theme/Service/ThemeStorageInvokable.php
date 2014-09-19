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
        return $_COOKIE['theme'];
    }

    public function set($name)
    {
        $_COOKIE['theme'] = $name;
        setcookie('theme',$name, 0, "/");
    }
}
