<?php
/**
 * Nice Dump helper.
 *
 * Simple Function to dump variables to the screen, in a nicley formatted manner.
 * you can use this small function to dump your data in nicley formatted manner
 * instead of using default var_dump or print_r functions
 * i.e nice_dump( array() );
 *
 * @param array $data your data that you want to dump.
 * @param array $options array of custom options (i.e label, echo, etc...)
 * @return mixed you can set return type as (echo OR return) in options array.
 *
 * @package    Dump data
 * @author     Ead Hassan <eadhassan55@gmail.com>
 * @author     Forward Web <info@forward-web.com>
 * @copyright  2019 Forward web
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @version    1.0
 * @link       https://github.com/eadhassan/nice_dump
 */
if (!function_exists('nice_dump')) {
    function nice_dump ($data, $options = array())
    {
        # List of all default options
    	extract(dump_atts(array(
    		'label'		=> 'Dump data',
    		'json'      	=> FALSE,
    		'return'	=> 'echo',
    		'color'		=> '#aaa',
    		'bg_color'	=> '#222'
    	), $options));
    	
    	if($json == FALSE) {
            # Store dump in variable
            ob_start();
            var_dump($data);
            $output = ob_get_clean();
    	} else {
    	    $output = json_encode($data, JSON_PRETTY_PRINT);
    	}
        
        # Get the URL of this file
        # It's only needed if the jQuery not defined
        # So we will include the included jquery.min.js file
        $current_location = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? 'https://' : 'http://';
        $current_location = $current_location.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(__DIR__)).'/';
        
        // Add formatting to the output
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre>' . $label . ' => ' . $output . '</pre>';


        # check if the jQuery is loaded otherwise we will load our included jquery.min.js
        $script = '
        <script>window.jQuery || document.write(\'<script src="'.$current_location.'jquery.min.js"><\/script>\');</script>
        ';

        # javascript function for the toggle button
        $script .= '
        <script>
            function niceDumpToggle(elem)
            {
                $(elem).next(".dump_data").slideToggle();
            }
        </script>
        ';
        
        # custom css styles
        $style = '<style>.dump {position: relative;min-height: 30px;display: block;text-align: left;margin: 20px; padding:0 10px;color: '.$color.'; background-color: '.$bg_color.';white-space: pre; text-shadow: 0 1px 0 #000;border-radius: 15px;overflow:hidden; border-bottom: 1px solid #555;box-shadow: 0 1px 5px rgba(0,0,0,0.4) inset, 0 0 20px rgba(0,0,0,0.2) inset;font: 16px/24px "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;}.dump button {outline: none;box-shadow: none;position: absolute;top: 0;right: 0;background-color: #555;border: none;color: white;padding: 0 10px;line-height: 30px;text-align: center;text-decoration: none;display: block;font-size: 16px;}.dump pre {background-color:transparent;border:none;color: '.$color.' !important;margin: 0 @important; padding: 0 @important;}</style>';

        $result = $style.
        '<div class="dump"><button type="button" onclick="niceDumpToggle(this)">&uarr;</button><div class="dump_data">'.$output.'</div></div>'.
        $script;

        # Output
        if ($return == 'echo' or $return == 'json') {
            
            # remove all empty line and echo the dump data
            echo preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $result);
        }
        else {
            
            # remove all empty line and return the dump data
            return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $result);
        }
    }
}

/**
 * Combine user attributes with known attributes and fill in defaults when needed.
 *
 * The defaults should be considered to be all of the attributes which are
 * supported by the caller and given as a list. The returned attributes will
 * only contain the attributes in the $defaults list.
 *
 * If the $atts list has unsupported attributes, then they will be ignored and
 * removed from the final returned list.
 *
 *
 * @param array $defaults Entire list of supported attributes and their defaults.
 * @param array $atts User defined attributes in nice_dump function.
 * @return array Combined and filtered attribute list.
 *
 * @package    Dump data
 * @author     Ead Hassan <eadhassan55@gmail.com>
 * @author     Forward Web <info@forward-web.com>
 * @copyright  2019 Forward web
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @version    1.0
 * @link       https://github.com/eadhassan/nice_dump
 */
if (!function_exists('dump_atts')) {
	function dump_atts($defaults, $atts) {
	    $atts = (array) $atts;
	    $out = array();
	    foreach ($defaults as $name => $default) {
	        if (array_key_exists($name, $atts))
	            $out[$name] = $atts[$name];
	        else
	            $out[$name] = $default;
	    }
	    return $out;
	}
}
