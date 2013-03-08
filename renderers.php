<?php

class theme_bootstrap_creation_core_renderer extends core_renderer {
    /**
     * Renders a custom menu object (located in outputcomponents.php)
     *
     * The custom menu this method override the render_custom_menu function
     * in outputrenderers.php
     * @staticvar int $menucount
     * @param custom_menu $menu
     * @return string
     */
    protected function render_custom_menu(custom_menu $menu) {
        // If the menu has no children return an empty string
        if (!$menu->has_children()) {
            return '';
        }
        // Initialise this custom menu
        $content = html_writer::start_tag('ul', array('class'=>'dropdown dropdown-horizontal bootstrap_creation-custom-menu'));
        // Render each child
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item);
        }
        // Close the open tags
        $content .= html_writer::end_tag('ul');
        // Return the custom menu
        return $content;
    }

    /**
     * Renders a custom menu node as part of a submenu
     *
     * The custom menu this method override the render_custom_menu_item function
     * in outputrenderers.php
     *
     * @see render_custom_menu()
     *
     * @staticvar int $submenucount
     * @param custom_menu_item $menunode
     * @return string
     */
    protected function render_custom_menu_item(custom_menu_item $menunode) {
        // Required to ensure we get unique trackable id's
        static $submenucount = 0;
        $content = html_writer::start_tag('li');
        if ($menunode->has_children()) {
            // If the child has menus render it as a sub menu
            $submenucount++;
            $extra = '';
            if ($menunode->get_url() === null) {
                $extra = ' customitem-nolink';
            }
            $content .= html_writer::start_tag('span', array('class'=>'customitem'.$extra));
            if ($menunode->get_url() !== null) {
                $content .= html_writer::link($menunode->get_url(), $menunode->get_text(), array('title'=>$menunode->get_title()));
            } else {
                $content .= $menunode->get_text();
            }
            
            $content .= html_writer::end_tag('span');
            $content .= html_writer::start_tag('ul');
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode);
            }
            $content .= html_writer::end_tag('ul');
        } else {
            // The node doesn't have children so produce a final menuitem

            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#';
            }
            $content .= html_writer::link($url, $menunode->get_text(), array('title'=>$menunode->get_title(), 'class'=>'customitem-no-children'));
        }
        $content .= html_writer::end_tag('li');
        // Return the sub menu
        return $content;
    }

    // Copied from core_renderer with one minor change - changed $this->output->render() call to $this->render()
    protected function render_navigation_node(navigation_node $item) {
        $content = $item->get_content();
        $title = $item->get_title();
        if ($item->icon instanceof renderable && !$item->hideicon) {
            $icon = $this->render($item->icon);
            $content = $icon.$content; // use CSS for spacing of icons
        }
        if ($item->helpbutton !== null) {
            $content = trim($item->helpbutton).html_writer::tag('span', $content, array('class'=>'clearhelpbutton'));
        }
        if ($content === '') {
            return '';
        }
        if ($item->action instanceof action_link) {
            //TODO: to be replaced with something else
            $link = $item->action;
            if ($item->hidden) {
                $link->add_class('dimmed');
            }
            $content = $this->render($link);
        } else if ($item->action instanceof moodle_url) {
            $attributes = array();
            if ($title !== '') {
                $attributes['title'] = $title;
            }
            if ($item->hidden) {
                $attributes['class'] = 'dimmed_text';
            }
            $content = html_writer::link($item->action, $content, $attributes);

        } else if (is_string($item->action) || empty($item->action)) {
            $attributes = array();
            if ($title !== '') {
                $attributes['title'] = $title;
            }
            if ($item->hidden) {
                $attributes['class'] = 'dimmed_text';
            }
            $content = html_writer::tag('span', $content, $attributes);
        }
        return $content;
    }
}


/*For display navigation bar with various menu*/
class theme_bootstrap_creation_topsettings_renderer extends plugin_renderer_base {
	public function settings_tree(settings_navigation $navigation) {
        global $CFG;
        $content = $this->navigation_node($navigation, array('class' => 'dropdown  dropdown-horizontal'));
       /* if (has_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM))) {
            $content .= $this->search_form(new moodle_url("$CFG->wwwroot/$CFG->admin/search.php"), optional_param('query', '', PARAM_RAW));
        }
        $content .= html_writer::empty_tag('br', array('clear' => 'all'));*/
        return $content;
    }
	
    
    public function home_link() {
        global $CFG;
        $content = html_writer::start_tag('ul', array('id' => 'awesomeHomeMenu', 'class' => 'dropdown  dropdown-horizontal'));
        $content .= html_writer::start_tag('li');
        $content .= html_writer::start_tag('a', array('href' => "$CFG->wwwroot", 'id' =>'home'));
      	$content .= html_writer::start_tag('span', array('id' => 'imageContainer'));
       	$content .= text_to_html("&nbsp;", '', false); 
       	$content .= text_to_html("&nbsp;", '', false);
       	$content .= text_to_html("&nbsp;", '', false);
       	$content .= text_to_html("&nbsp;", '', false);
       	$content .= text_to_html("&nbsp;", '', false);
       	$content .= text_to_html("&nbsp;", '', false);
        $content .= html_writer::end_tag("span");
        $content .= html_writer::end_tag('a');
        $content .= html_writer::end_tag('li');
   		$content .= html_writer::end_tag('ul');
        return $content;
    }
    
    
    
	public function display_date() {
        global $CFG;
        $content = html_writer::start_tag('ul', array('id' => 'awesomedatetime','class' => 'dropdown  dropdown-horizontal'));
        $content .= html_writer::start_tag('li');
        $content .= html_writer::start_tag('a', array('href' => new moodle_url('/calendar/view.php'), 'title'=>get_string('today')));
      //  $content .= strftime("%I:%M %p, %d-%m-%Y");
        
        $content .= userdate(time(), "%I:%M %p, %d-%m-%Y");
        $content .= html_writer::end_tag('a');
        $content .= html_writer::end_tag('li');
   		$content .= html_writer::end_tag('ul');
        return $content;
    }
    
    public function navigation_tree(global_navigation $navigation) {
        global $CFG;
      
    	 $content = html_writer::start_tag('ul', array( 'class' => 'dropdown  dropdown-horizontal'));
        $content .= html_writer::start_tag('li');
       // $content .= html_writer::start_tag('span', array('id' =>'awesomeNavMenu'));
        $content .= html_writer::start_tag('span');
        $content .= 'Navigation';//html_writer::empty_tag('img', array('alt' => '', 'src' =>$this->pix_url('menu/user_silhouette', 'theme')));
        $content .= html_writer::end_tag('span');
        $content .= $this->navigation_node($navigation, array());
        $content .= html_writer::end_tag('li');
        $content .= html_writer::end_tag('ul');
        return $content;
    }

    protected function navigation_node(navigation_node $node, $attrs=array()) {
    	global $PAGE;
        $items = $node->children;

        // exit if empty, we don't want an empty ul element
        if ($items->count() == 0) {
            return '';
        }

        // array of nested li elements
        $lis = array();
        $dummypage = new bootstrap_creation_dummy_page();
        $dummypage->set_context(get_context_instance(CONTEXT_SYSTEM));
        $dummypage->set_url($PAGE->url);
        foreach ($items as $item) {
            if (!$item->display) {
                continue;
            }

            $isbranch = ($item->children->count() > 0 || $item->nodetype == navigation_node::NODETYPE_BRANCH);
            $hasicon = (!$isbranch && $item->icon instanceof renderable);

            if ($isbranch) {
                $item->hideicon = true;
            }

            $content = $this->output->render($item);
            if(substr($item->id, 0, 17)=='expandable_branch' && $item->children->count()==0) {
                // Navigation block does this via AJAX - we'll merge it in directly instead
                $subnav = new bootstrap_creation_expand_navigation($dummypage, $item->type, $item->key);
                if (!isloggedin() || isguestuser()) {
                    $subnav->set_expansion_limit(navigation_node::TYPE_COURSE);
                }
                $branch = $subnav->find($item->key, $item->type);
                if($branch!==false) $content .= $this->navigation_node($branch);
            } else {
                $content .= $this->navigation_node($item);
            }


            if($isbranch && !(is_string($item->action) || empty($item->action))) {
                $content = html_writer::tag('li', $content, array('class' => 'clickable-with-children'));
            } else {
                $content = html_writer::tag('li', $content);
            }
            $lis[] = $content;
        }

        if (count($lis)) {
            return html_writer::nonempty_tag('ul', implode("\n", $lis), $attrs);
        } else {
            return '';
        }
    }
       
}

