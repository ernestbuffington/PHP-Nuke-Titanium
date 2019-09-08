<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              template.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: template.php,v 1.10 2003/03/05 15:57:00 acydburn Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*
    Template class.

    Nathan Codding - Original version design and implementation
    Crimsonbane - Initial caching proposal and work
    psoTFX - Completion of file caching, decompilation routines and implementation of
    conditionals/keywords and associated changes
    Acyd Burn - adjusted to be 'standalone' and functional for the Statistics Mod 3

    The interface was inspired by PHPLib templates,  and the template file (formats are
    quite similar)

    The keyword/conditional implementation is currently based on sections of code from
    the Smarty templating engine (c) 2001 ispi of Lincoln, Inc. which is released
    (on its own and in whole) under the LGPL. Section 3 of the LGPL states that any code
    derived from an LGPL application may be relicenced under the GPL, this applies
    to this source
*/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

class Stats_template {

    var $classname = 'Stats_template';

    // variable that holds all the data we'll be substituting into
    // the compiled templates. Takes form:
    // --> $this->_tpldata[block.][iteration#][child.][iteration#][child2.][iteration#][variablename] == value
    // if it's a root-level variable, it'll be like this:
    // --> $this->_tpldata[.][0][varname] == value
    var $_tpldata = array();

    // Root dir and hash of filenames for each template handle.
    var $root = '';
    var $cachedir = '';
    var $files = array();
    var $compiled_data = '';

    // this will hash handle names to the compiled/uncompiled code for that handle.
    var $compiled_code = array();
    var $uncompiled_code = array();

    // Various counters and storage arrays
    var $block_names = array();
    var $block_else_level = array();
    var $include_counter = 1;
    var $block_nesting_level = 0;

    function set_template($stats_template = '')
    {
        global $directory_mode, $phpbb_root_path;
        $this->root = $phpbb_root_path . 'templates/' . $stats_template . '/stats_mod';
        $this->cachedir = $phpbb_root_path . 'modules/cache/templates/' . $stats_template . '/';
        $module_cache_dir = $phpbb_root_path . 'modules/cache';
        
        if (!file_exists($module_cache_dir))
        {
            @umask(0);
            mkdir($module_cache_dir, $directory_mode);
        }

        $template_cache_dir = $phpbb_root_path . 'modules/cache/templates';
        
        if (!file_exists($template_cache_dir))
        {
            @umask(0);
            mkdir($template_cache_dir, $directory_mode);
        }

        if (!file_exists($this->cachedir))
        {
            @umask(0);
            mkdir($this->cachedir, $directory_mode);
        }

        return true;
    }

    /**
     * Sets the template filenames for handles. $filename_array
     * should be a hash of handle => filename pairs.
     */
    function set_filenames($filename_array)
    {
        if (!is_array($filename_array))
        {
            return false;
        }

        $template_names = '';
        foreach ($filename_array as $handle => $filename)
        {
            if (empty($filename))
            {
                message_die(GENERAL_ERROR, "Template error - Empty filename specified for $handle");
            }

            $this->filename[$handle] = $filename;
            $this->files[$handle] = $this->make_filename($filename);
        }

        return true;
    }

    /**
     * Generates a full path+filename for the given filename, which can either
     * be an absolute name, or a name relative to the rootdir for this Template
     * object.
     */
    function make_filename($filename)
    {
        // Check if it's an absolute or relative path.
        return (substr($filename, 0, 1) != '/') ? $this->root . '/' . $filename : $filename;
    }

    /**
     * If not already done, load the file for the given handle and populate
     * the uncompiled_code[] hash with its code. Do not compile.
     */
    function loadfile($handle)
    {
        // If the file for this handle is already loaded and compiled, do nothing.
        if (!empty($this->uncompiled_code[$handle]))
        {
            return true;
        }

        // If we don't have a file assigned to this handle, die.
        if (!isset($this->files[$handle]))
        {
            message_die(GENERAL_ERROR, "Statistics Template->loadfile(): No file specified for handle $handle");
        }

        if (!($fp = @fopen($this->files[$handle], 'r')))
        {
            message_die(GENERAL_ERROR, "Statistics Template->loadfile(): Error - file " . $this->files[$handle] . " does not exist or is empty");
        }

        $str = '';
        $str = fread($fp, filesize($this->files[$handle]));
        @fclose($fp);

        $this->uncompiled_code[$handle] = trim($str);

        return true;
    }

    /**
     * Destroys this template object. Should be called when you're done with it, in order
     * to clear out the template data so you can load/parse a new template set.
     */
    function destroy()
    {
        $this->_tpldata = array();
    }

    // Only handled if the cached template file gets loaded. To prevent attacks through the cache directory.
    function security()
    {
        return true;
    }

    /**
     * Load the file for the handle, compile the file,
     * and run the compiled code. This will print out
     * the results of executing the template.
     */
    function display($handle)
    {
        $_str = '';

        if (!$this->compile_return_load($_str, $handle))
        {
            if (!$this->loadfile($handle))
            {
                message_die(GENERAL_ERROR, "Statistics Template->display(): Couldn't load template file for handle $handle");
            }

            // Actually compile the code now.
            $this->compiled_code[$handle] = $this->compile($this->uncompiled_code[$handle]);
            $this->compile_write($handle, $this->compiled_code[$handle]);

            if (!$this->compile_return_load($_str, $handle))
            {
                return '';
            }
            else
            {
                return ($_str);
            }
        }

        return ($_str);
    }

    /**
     * Inserts the uncompiled code for $handle as the
     * value of $varname in the root-level. This can be used
     * to effectively include a template in the middle of another
     * template.
     * Note that all desired assignments to the variables in $handle should be done
     * BEFORE calling this function.
     */
    function assign_var_from_handle($varname, $handle)
    {
        $_str = '';

        if (!($this->compile_load($_str, $handle, false)))
        {
            if (!$this->loadfile($handle))
            {
                message_die(GENERAL_ERROR, "Statistics Template->display(): Couldn't load template file for handle $handle");
            }

            $code = $this->compile($this->uncompiled_code[$handle], true, '_str');
            $this->compile_write($handle, $code);

            // evaluate the variable assignment.
            eval($code);
        }

        // assign the value of the generated variable to the given varname.
        $this->assign_var($varname, $_str);

        return true;
    }

    function assign_from_include($filename)
    {
        $handle = 'include_' . $this->include_counter++;

        $this->filename[$handle] = $filename;
        $this->files[$handle] = $this->make_filename($filename);
        $_str = '';

        if (!($this->compile_load($_str, $handle, false)))
        {
            if (!$this->loadfile($handle))
            {
                message_die(GENERAL_ERROR, "Statistics Template->display(): Couldn't load template file for handle $handle");
            }

            $this->compiled_code[$handle] = $this->compile($this->uncompiled_code[$handle]);
            $this->compile_write($handle, $this->compiled_code[$handle]);

            eval($this->compiled_code[$handle]);
        }
    }

    /**
     * Root-level variable assignment. Adds to current assignments, overriding
     * any existing variable assignment with the same name.
     */
    function assign_vars($vararray)
    {
        foreach ($vararray as $key => $val)
        {
            $this->_tpldata['.'][0][$key] = $val;
        }

        return true;
    }

    /**
     * Root-level variable assignment. Adds to current assignments, overriding
     * any existing variable assignment with the same name.
     */
    function assign_var($varname, $varval)
    {
        $this->_tpldata['.'][0][$varname] = $varval;

        return true;
    }

    /**
     * Block-level variable assignment. Adds a new block iteration with the given
     * variable assignments. Note that this should only be called once per block
     * iteration.
     */
    function assign_block_vars($blockname, $vararray)
    {
        if (strstr($blockname, '.'))
        {
            // Nested block.
            $blocks = explode('.', $blockname);
            $blockcount = count($blocks) - 1;

            $str = &$this->_tpldata; 
            for ($i = 0; $i < $blockcount; $i++) 
            {
                $str = &$str[ $blocks[$i].'.' ]; 
                $str = &$str[ count($str)-1 ]; 
            } 
            // Now we add the block that we're actually assigning to. 
            // We're adding a new iteration to this block with the given 
            // variable assignments. 
            $str[ $blocks[$blockcount].'.' ][] = $vararray; 
        }
        else
        {
            // Top-level block.
            // Add a new iteration to this block with the variable assignments
            // we were given.
            $this->_tpldata[$blockname . '.'][] = $vararray;
        }

        return true;
    }

    /**
     * Compiles the given string of code, and returns
     * the result in a string.
     * If "do_not_echo" is true, the returned code will not be directly
     * executable, but can be used as part of a variable assignment
     * for use in assign_code_from_handle().
     *
     * Parts of this where inspired by Smarty
     */
    function compile($code, $do_not_echo = false, $retvar = '')
    {
        // Pull out all block/statement level elements and seperate
        // plain text
        preg_match_all('#<!-- (.*?) (.*?)?[ ]?-->#s', $code, $blocks);
        $text_blocks = preg_split('#<!-- (.*?) (.*?)?[ ]?-->#s', $code);
        for($i = 0; $i < count($text_blocks); $i++)
        {
            $this->compile_var_tags($text_blocks[$i]);
        }

        $compile_blocks = array();

        for ($curr_tb = 0; $curr_tb < count($text_blocks); $curr_tb++)
        {
            switch ($blocks[1][$curr_tb])
            {
                case 'BEGIN':
                    $this->block_else_level[] = false;
                    $compile_blocks[] = '// BEGIN ' . $blocks[2][$curr_tb] . "\n" . $this->compile_tag_block($blocks[2][$curr_tb]);
                    break;
                case 'BEGINELSE':
                    $this->block_else_level[count($this->block_else_level) - 1] = true;
                    $compile_blocks[] = "// BEGINELSE\n}} else {\n";
                    break;
                case 'END':
                    $compile_blocks[] = ((array_pop($this->block_else_level)) ? "}\n" : "}}\n") . '// END ' . array_pop($this->block_names) . "\n";
                    break;
                case 'IF':
                    $compile_blocks[] = '// IF ' . $blocks[2][$curr_tb] . "\n" . $this->compile_tag_if($blocks[2][$curr_tb], false);
                    break;
                case 'ELSE':
                    $compile_blocks[] = "// ELSE\n} else {\n";
                    break;
                case 'ELSEIF':
                    $compile_blocks[] = '// ELSEIF ' . $blocks[2][$curr_tb] . "\n" . $this->compile_tag_if($blocks[2][$curr_tb], true);
                    break;
                case 'ENDIF':
                    $compile_blocks[] = "// ENDIF\n}\n";
                    break;
                case 'INCLUDE':
                    $compile_blocks[] = '// INCLUDE ' . $blocks[2][$curr_tb] . "\n" . $this->compile_tag_include($blocks[2][$curr_tb]);
                    break;
                default:
                    $this->compile_var_tags($blocks[0][$curr_tb]);
                    $trim_check = trim($blocks[0][$curr_tb]);
                    $compile_blocks[] = (!$do_not_echo) ? ((!empty($trim_check)) ? 'echo \'' . $blocks[0][$curr_tb] . '\';' : '') : ((!empty($trim_check)) ? $blocks[0][$curr_tb] : '');
                    break;
            }
        }

        $template_php = '';
        for ($i = 0; $i < count($text_blocks); $i++)
        {
            $trim_check_text = trim($text_blocks[$i]);
            $trim_check_block = trim($compile_blocks[$i]);
            $template_php .= (!$do_not_echo) ? ((!empty($trim_check_text)) ? 'echo \'' . $text_blocks[$i] . '\';' : '') . ((!empty($compile_blocks[$i])) ? $compile_blocks[$i] : '') : ((!empty($trim_check_text)) ? $text_blocks[$i] . "\n" : '') . ((!empty($compile_blocks[$i])) ? $compile_blocks[$i] . "\n" : '');
        }

        return  (!$do_not_echo) ? $template_php : '$' . $retvar . '.= \'' . str_replace("'", "\\'", $template_php) . '\';';
    }

    function compile_var_tags(&$text_blocks)
    {
        // change template varrefs into PHP varrefs
        $varrefs = array();

        $text_blocks = str_replace('\\', '\\\\', $text_blocks);
        $text_blocks = str_replace('\'', '\\\'', $text_blocks);

        // This one will handle varrefs WITH namespaces
        preg_match_all('#\{(([a-z0-9\-_]+?\.)+?)([a-z0-9\-_]+?)\}#is', $text_blocks, $varrefs);

        for ($j = 0; $j < count($varrefs[1]); $j++)
        {
            $namespace = $varrefs[1][$j];
            $varname = $varrefs[3][$j];
            $new = $this->generate_block_varref($namespace, $varname);

            $text_blocks = str_replace($varrefs[0][$j], $new, $text_blocks);
        }

        // This will handle the remaining root-level varrefs
        $text_blocks = preg_replace('#\{L_([a-z0-9\-_]*?)\}#is', "' . ((isset(\$this->_tpldata['.'][0]['L_\\1'])) ? \$this->_tpldata['.'][0]['L_\\1'] : ((isset(\$lang['\\1'])) ? \$lang['\\1'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', '\\1'))) . '     }')) . '", $text_blocks);
        $text_blocks = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . ((isset(\$this->_tpldata['.'][0]['\\1'])) ? \$this->_tpldata['.'][0]['\\1'] : '') . '", $text_blocks);

        return;
    }

    function compile_tag_block($tag_args)
    {
        $tag_template_php = '';
        array_push($this->block_names, $tag_args);

        if (count($this->block_names) < 2)
        {
            // Block is not nested.
            $tag_template_php = '$_' . $tag_args . '_count = (isset($this->_tpldata[\'' . $tag_args . '.\'])) ?  count($this->_tpldata[\'' . $tag_args . '.\']) : 0;' . "\n";
            $tag_template_php .= 'if ($_' . $tag_args . '_count) {' . "\n";
            $tag_template_php .= 'for ($_' . $tag_args . '_i = 0; $_' . $tag_args . '_i < $_' . $tag_args . '_count; $_' . $tag_args . '_i++)';
        }
        else
        {
            // This block is nested.

            // Generate a namespace string for this block.
            $namespace = implode('.', $this->block_names);

            // Get a reference to the data array for this block that depends on the
            // current indices of all parent blocks.
            $varref = $this->generate_block_data_ref($namespace, false);

            // Create the for loop code to iterate over this block.
            $tag_template_php = '$_' . $tag_args . '_count = (isset(' . $varref . ')) ? count(' . $varref . ') : 0;' . "\n";
            $tag_template_php .= 'if ($_' . $tag_args . '_count) {' . "\n";
            $tag_template_php .= 'for ($_' . $tag_args . '_i = 0; $_' . $tag_args . '_i < $_' . $tag_args . '_count; $_' . $tag_args . '_i++)';
        }

        $tag_template_php .= "\n{\n";

        return $tag_template_php;
    }

    //
    // Compile IF tags - much of this is from Smarty with
    // some adaptions for our block level methods
    //
    function compile_tag_if($tag_args, $elseif)
    {
        /* Tokenize args for 'if' tag. */
        preg_match_all('/(?:
                         "[^"\\\\]*(?:\\\\.[^"\\\\]*)*"         |
                         \'[^\'\\\\]*(?:\\\\.[^\'\\\\]*)*\'     |
                         [(),]                                  |
                         [^\s(),]+)/x', $tag_args, $match);

        $tokens = $match[0];
        $is_arg_stack = array();

        for ($i = 0; $i < count($tokens); $i++)
        {
            $token = &$tokens[$i];

            switch ($token)
            {
                case 'eq':
                    $token = '==';
                    break;

                case 'ne':
                case 'neq':
                    $token = '!=';
                    break;

                case 'lt':
                    $token = '<';
                    break;

                case 'le':
                case 'lte':
                    $token = '<=';
                    break;

                case 'gt':
                    $token = '>';
                    break;

                case 'ge':
                case 'gte':
                    $token = '>=';
                    break;

                case 'and':
                    $token = '&&';
                    break;

                case 'or':
                    $token = '||';
                    break;

                case 'not':
                    $token = '!';
                    break;

                case 'mod':
                    $token = '%';
                    break;

                case '(':
                    array_push($is_arg_stack, $i);
                    break;

                case 'is':
                    $is_arg_start = ($tokens[$i-1] == ')') ? array_pop($is_arg_stack) : $i-1;
                    $is_arg    = implode('    ', array_slice($tokens,    $is_arg_start, $i -    $is_arg_start));

                    $new_tokens    = $this->_parse_is_expr($is_arg, array_slice($tokens, $i+1));

                    array_splice($tokens, $is_arg_start, count($tokens), $new_tokens);

                    $i = $is_arg_start;

                default:
                    if (preg_match('#^(([a-z0-9\-_]+?\.)+?)?([A-Z]+[A-Z0-9\-_]+?)$#s', $token, $varrefs))
                    {
                        $token = (!empty($varrefs[1])) ? $this->generate_block_data_ref(substr($varrefs[1], 0, strlen($varrefs[1]) - 1), true) . '[\'' . $varrefs[3] . '\']' : '$this->_tpldata[\'.\'][0][\'' . $varrefs[3] . '\']';
                    }
                    break;
            }
        }

        return (($elseif) ? '} elseif (' : 'if (') . (implode(' ', $tokens) . ') { ' . "\n");
    }

    function compile_tag_include($tag_args)
    {
        return "\$this->assign_from_include('$tag_args');\n";
    }

    // This is from Smarty
    function _parse_is_expr($is_arg, $tokens)
    {
        $expr_end =    0;
        $negate_expr = false;

        if (($first_token = array_shift($tokens)) == 'not')
        {
            $negate_expr = true;
            $expr_type = array_shift($tokens);
        }
        else
        {
            $expr_type = $first_token;
        }

        switch ($expr_type)
        {
            case 'even':
                if (@$tokens[$expr_end] == 'by')
                {
                    $expr_end++;
                    $expr_arg =    $tokens[$expr_end++];
                    $expr =    "!(($is_arg    / $expr_arg) % $expr_arg)";
                }
                else
                {
                    $expr =    "!($is_arg % 2)";
                }
                break;

            case 'odd':
                if (@$tokens[$expr_end] == 'by')
                {
                    $expr_end++;
                    $expr_arg =    $tokens[$expr_end++];
                    $expr =    "(($is_arg / $expr_arg)    % $expr_arg)";
                }
                else
                {
                    $expr =    "($is_arg %    2)";
                }
                break;

            case 'div':
                if (@$tokens[$expr_end] == 'by')
                {
                    $expr_end++;
                    $expr_arg =    $tokens[$expr_end++];
                    $expr =    "!($is_arg % $expr_arg)";
                }
                break;

            default:
                break;
        }

        if ($negate_expr)
        {
            $expr =    "!($expr)";
        }

        array_splice($tokens, 0, $expr_end,    $expr);

        return $tokens;
    }

    /**
     * Generates a reference to the given variable inside the given (possibly nested)
     * block namespace. This is a string of the form:
     * ' . $this->_tpldata['parent'][$_parent_i]['$child1'][$_child1_i]['$child2'][$_child2_i]...['varname'] . '
     * It's ready to be inserted into an "echo" line in one of the templates.
     * NOTE: expects a trailing "." on the namespace.
     */
    function generate_block_varref($namespace, $varname)
    {
        // Strip the trailing period.
        $namespace = substr($namespace, 0, strlen($namespace) - 1);

        // Get a reference to the data block for this namespace.
        $varref = $this->generate_block_data_ref($namespace, true);
        // Prepend the necessary code to stick this in an echo line.

        // Append the variable reference.
        $varref .= '[\'' . $varname . '\']';

        $varref = '\' . ((isset(' . $varref . ')) ? ' . $varref . ' : \'\') . \'';

        return $varref;

    }

    /**
     * Generates a reference to the array of data values for the given
     * (possibly nested) block namespace. This is a string of the form:
     * $this->_tpldata['parent'][$_parent_i]['$child1'][$_child1_i]['$child2'][$_child2_i]...['$childN']
     *
     * If $include_last_iterator is true, then [$_childN_i] will be appended to the form shown above.
     * NOTE: does not expect a trailing "." on the blockname.
     */
    function generate_block_data_ref($blockname, $include_last_iterator)
    {
        // Get an array of the blocks involved.
        $blocks = explode('.', $blockname);
        $blockcount = count($blocks) - 1;
        $varref = '$this->_tpldata';

        // Build up the string with everything but the last child.
        for ($i = 0; $i < $blockcount; $i++)
        {
            $varref .= '[\'' . $blocks[$i] . '.\'][$_' . $blocks[$i] . '_i]';
        }

        // Add the block reference for the last child.
        $varref .= '[\'' . $blocks[$blockcount] . '.\']';

        // Add the iterator for the last child if requried.
        if ($include_last_iterator)
        {
            $varref .= '[$_' . $blocks[$blockcount] . '_i]';
        }

        return $varref;
    }

    //
    // Compilation stuff
    //
    function compile_load(&$_str, &$handle, $do_echo)
    {
        global $phpEx;

        $filename = $this->cachedir . $this->filename[$handle] . '.' . $phpEx;

        // Recompile page if the original template is newer, otherwise load the compiled version
        if (file_exists($filename) && @filemtime($filename) >= @filemtime($this->files[$handle]))
        {
            $_str = '';
            include($filename);

            if ($do_echo && $_str != '')
            {
                echo $_str;
            }

            return true;
        }
        return false;
    }

    function echo_data($data)
    {
        $this->compiled_data .= $data;
    }

    function compile_return_load(&$_str, &$handle)
    {
        global $phpEx, $file_mode;

        $filename = $this->cachedir . $this->filename[$handle] . '.' . $phpEx;

        // Recompile page
        if (file_exists($filename) && @filemtime($filename) >= @filemtime($this->files[$handle]))
        {
            // Now let us really decompile the page... :D
            // These things are fun.
            $_str = '';
            $_str = implode("", file($filename));

            $_str = preg_replace("/echo '(.*?)';/s", "\$this->echo_data('\\1');", $_str);

            $filename = $this->cachedir . 'decompiled.php.html';
            $fp = fopen($filename, 'wt');
            fwrite($fp, $_str);
            fclose($fp);

            touch($filename, filemtime($this->files[$handle]));
            @chmod($filename, $file_mode);

            $this->compiled_data = '';
            include($this->cachedir . 'decompiled.php.html');
            $_str = $this->compiled_data;

            return true;
        }
        return false;
    }

    function compile_write(&$handle, $data)
    {
        global $phpEx, $file_mode;

        $filename = $this->cachedir . $this->filename[$handle] . '.' . $phpEx;

        $data = '<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/' . "\nif (\$this->security()) {\n" . $data . "\n}\n?".">";

        $fp = fopen($filename, 'w+');
        fwrite ($fp, $data);
        fclose($fp);

        touch($filename, filemtime($this->files[$handle]));
        @chmod($filename, $file_mode);

        return;
    }

    function compile_cache_clear($file = 'modules/cache') 
    {
        global $directory_mode, $phpbb_root_path;

        if (file_exists($phpbb_root_path . $file)) 
        {
            chmod($phpbb_root_path . $file, $directory_mode);
            
            if (is_dir($phpbb_root_path . $file))
            {
                $dir = opendir($phpbb_root_path . $file); 
                while ($filename = readdir($dir)) 
                {
                    if ($filename != '.' && $filename != '..') 
                    {
                        $this->compile_cache_clear($file . '/' . $filename);
                    }
                }
                closedir($dir);
                rmdir($phpbb_root_path . $file);
            } 
            else 
            {
                unlink($phpbb_root_path . $file);
            }
        }
    }

    function compile_cache_show(&$template, $decompile = false)
    {
        global $phpbb_root_path;

        $template_cache = array();

        $dp = opendir($this->cachedir);
        while ($file = readdir($dp))
        {
            if (strstr($file, '.tpl') && is_file($this->cachedir . '/' . $file))
            {
                array_push($template_cache, $file);
            }
        }
        closedir($dp);
        
        for ($i = 0; $i < count($template_cache); $i++)
        {
            if ($decompile)
            {
                $contents = file($this->cachedir . '/' . $template_cache[$i]);
                $str = '';
                for ($j = 0; $j < count($contents); $j++)
                {
                    $str .= $contents[$j];
                }
                $decompiled = $this->decompile($str);
                echo $decompiled;
            }
            else
            {
                echo $template_cache[$i].'<br />';
            }
        }

        return;
    }

    function decompile(&$_str, $savefile = false)
    {

        $match_tags = array(
            "#(<\?php\nif \(.?this\->security\(\) \) \{\n)|(\n\}\n\?".">)#",
            "#echo '(.*?)';#s",
            "#\/\/ (INCLUDE .*?)\n.?this\->assign_from_include\('.*?'\);\n#s",
            "#\/\/ (IF .*?)\nif \(.*?\) \{[ ]?\n#",
            "#\/\/ (ELSEIF .*?)\n\} elseif \(.*?\) \{[ ]?\n#",
            "#\/\/ (ELSE)\n\} else \{\n#",
            "#\/\/ (ENDIF)\n}\n#",
            "#\/\/ (BEGIN .*?)\n.?_.*? = \(.*?\) : 0;\nif \(.*?\) \{\nfor \(.*?\)\n\{\n#",
            "#\}\}?\n\/\/ (END .*?)\n#",
            "#\/\/ (BEGINELSE)\n\}\} else \{\n#",
            "#' \. \(\(isset\(.?this\->_tpldata\['\.'\]\[0\]\['([A-Z0-9_]+?)'\]\) \) \? .?this\->_tpldata\['\.'\]\[0\]\['([A-Z0-9_]+?)'\] : '' \) \. '#s",
            "#' \. \(\(isset\(.?this\->_tpldata\['([a-z0-9_]+?\.)'\]\[.?_[a-z0-9_]+?\]\['([A-Z0-9_]+)'\]\) \) \? .?this\->_tpldata\['[a-z0-9_]+?\.'\]\[.?_[a-z0-9_]+?\]\['[A-Z0-9_]+'\] : '' \) \. '#s",
            "#' \. \(\(isset\(.?this\->_tpldata\['([a-z0-9_]+?\.)'\]\[.?_[a-z0-9_]+?\]\['([a-z0-9_]+?\.)'\]\[.?_[a-z0-9_]+?\]\['([A-Z0-9_]+)'\]\) \) \? .?this\->_tpldata\['[a-z0-9_]+?\.'\]\[.?_[a-z0-9_]+?\]\['[a-z0-9_]+?\.'\]\[.?_[a-z0-9_]+?\]\['[A-Z0-9_]+'\] : '' \) \. '#s",
            "#' \. \(\(isset\(.?this\->_tpldata\['([a-z0-9_]+?\.)'\]\[.?_[a-z0-9_]+?\]\['([a-z0-9_]+?\.)'\]\[.?_[a-z0-9_]+?\]\['([a-z0-9_]+?\.)'\]\[.?_[a-z0-9_]+?\]\['([A-Z0-9_]+)'\]\) \) \? .?this\->_tpldata\['[a-z0-9_]+?\.'\]\[.?_[a-z0-9_]+?\]\['[a-z0-9_]+?\.'\]\[.?_[a-z0-9_]+?\]\['[a-z0-9_]+?\.'\]\[.?_[a-z0-9_]+?\]\['[A-Z0-9_]+'\] : '' \) \. '#s"
        );

        $replace_tags = array(
            '',
            "\\1",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "<!-- \\1 -->",
            "{\\1}",
            "{\\1\\2}",
            "{\\1\\2\\3}",
            "{\\1\\2\\3\\4}"
        );

        $_str = preg_replace($match_tags, $replace_tags, $_str);

        $tmpfile = '';
        if ($savefile)
        {
            $tmpfile = tmpfile();
            fwrite($tmpfile, $_str);
            return $tmpfile;
        }
        else
        {
            return $_str;
        }
    }
}

?>