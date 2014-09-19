This is a "Theme" module for Zend Framework 2.

It allows you to have different themes for your application and switch between them.

In order to describe a new theme in the module config file that provides the new theme, or extends and existing one,
you should have a definition like this one:

```
'themes' => array (
        '<theme-name>' => array (
            'description' => '<Your description>',
            'screenshot' => 'Optional link pointing to a screenshot of the theme',
            'template_map'=> array (
            	'key' => 'path/to/template.phtml',
            	// ...
            ),
            'template_path_stack' => array(
            	'/path/to/theme-templates/'
            ),
        )
    )
```

For more details see http://learnzf2.com/themes-in-zend-framework-2/
