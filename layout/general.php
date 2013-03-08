<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';
if (empty($PAGE->layout_options['nocourseheaderfooter'])) {
    $courseheader = $OUTPUT->course_header();
    $coursecontentheader = $OUTPUT->course_content_header();
    if (empty($PAGE->layout_options['nocoursefooter'])) {
        $coursecontentfooter = $OUTPUT->course_content_footer();
        $coursefooter = $OUTPUT->course_footer();
    }
}

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    if (!right_to_left()) {
        $bodyclasses[] = 'side-pre-only';
    }else{
        $bodyclasses[] = 'side-post-only';
    }
} else if ($showsidepost && !$showsidepre) {
    if (!right_to_left()) {
        $bodyclasses[] = 'side-post-only';
    }else{
        $bodyclasses[] = 'side-pre-only';
    }
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}
if (!empty($PAGE->theme->settings->tagline)) {
    $tagline = '<span>'.$PAGE->theme->settings->tagline.'</span>';
} else {
    $tagline = '<!-- There was no custom tagline set -->';
}

if(!empty($PAGE->theme->settings->displaylogo)){
	$displaylogo = $PAGE->theme->settings->displaylogo;

	if (!empty($PAGE->theme->settings->logo)) {
    	$logourl = $PAGE->theme->settings->logo;
	}else{
		$logourl =$OUTPUT->pix_url('images/header-logo', 'theme');
	}
	
}else{
	$displaylogo =null;
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
        
<?php echo $OUTPUT->standard_head_html();
	if (!empty($PAGE->theme->settings->backtotop)) {
       $PAGE->requires->js('/theme/bootstrap_creation/yui/bttotop.js');
	}
    ?>

</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page">

   

<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">Site Name</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
          <li class="dropdown open">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
           
<ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li class="nav-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>

          </li>
        </ul>
        <!--
<p class="navbar-text pull-right">
           <?php
          if ($haslogininfo) {
                echo $OUTPUT->login_info();
            }?>
        </p>
-->
      </div>
    </div>
  </div>
</div>


<!--  
<?php if ($hascustommenu) { ?>
        <div id="custommenu"><?php echo $custommenu; ?></div>
         <?php } ?>

-->
<div class="clr"></div>

<?php if ($hasheading || $hasnavbar || !empty($courseheader)) { ?>
   <header id="overview" class="jumbotron subhead">
   <div id="page-header-con">

   <div class="modal-header">
        <!-- header logo -->
			<?php  if ($displaylogo) { ?>
				<h1 class="headermain-logo"><img src="<?php echo $logourl?>" alt="" />
				
				<div><?php echo $tagline; ?></div>
				
				</h1>
				
		   <?php }else{?>
				<h1 class="headermain <?php echo " $headerclass" ?>" ><?php echo $PAGE->heading ?></h1>
		   <?php }?>
		   <!-- header logo -->
        
    
        
        <div class="headermenu">
        <?php echo $OUTPUT->lang_menu(); ?>
</div><?php } ?>
        <?php if (!empty($courseheader)) { ?>
            <div id="course-header"><?php echo $courseheader; ?></div>
        <?php } ?>
                       
                        
      <div class="clr"></div>
  
      </div></div>               
    </header>
    
    <?php if ($hasnavbar) { ?>
            <div class="navbar clearfix">
            <div class="navbar-inner-con">
                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                <div class="navbutton"> <?php echo $PAGE->button; ?></div>
            </div>
            </div>

<?php } ?>
<!-- END OF HEADER -->

    <div id="page-content" class="row-fluid">
        <?php if ($hassidepre) { ?>
	<div id=region-pre class="span3 block-region">
    <div class=region-content>
	<?php echo $OUTPUT->blocks_for_region('side-pre') ?>
    </div>
	</div>
<?php } ?>


<?php if ($hassidepre && $hassidepost) { ?>
	<div class="span6">
<?php } elseif ($hassidepre || $hassidepost) { ?>
	<div class="span9">
<?php } else { ?>
    <div class="span12">
<?php };?>
    <?php echo $coursecontentheader; ?>
	<?php echo $OUTPUT->main_content() ?>
	<?php echo $coursecontentfooter; ?>
	</div>
             
<?php if ($hassidepost) { ?>                
	<div id=region-post class="span3 block-region">
    <div class=region-content>
	<?php echo $OUTPUT->blocks_for_region('side-post') ?>
    </div>
    </div>
<?php }; ?>          
</div>
   

<!-- START OF FOOTER -->
<!--
<div id="Sitelink">
<div class="inner">
<ul>
<li><a href="#">On the other  </a>
<ul>
<li><a href="#">We denounce with</a></li>
<li><a href="#">Righteous </a></li>
<li><a href="#">Indignation</a></li>
<li><a href="#">Trouble that </a></li>
<li><a href="#">Are bound</a></li>
<li><a href="#">Equal blame belongs</a></li>
</ul>
</li>

<li><a href="#">Ipsum used since  </a>
<ul>
<li><a href="#"> The 1500s is</a></li>
<li><a href="#">Which don't look </a></li>
<li><a href="#">Even slightly believable.</a></li>
<li><a href="#">If you are going to</a></li>
<li><a href="#">Use a passage of</a></li>
<li><a href="#">Lorem Ipsum?</a></li>
</ul>
</li>


<li><a href="#">Contrary to popular </a>
<ul>
<li><a href="#">Belief, Lorem </a></li>
<li><a href="#">Ipsum is </a></li>
<li><a href="#">Not simply random text.</a></li>
<li><a href="#">It has roots</a></li>
<li><a href="#">In a piece of classical</a></li>
<li><a href="#">The standard</a></li>
</ul>
</li>


<li class="last"><a href="#">But I must explain </a>
<ul>
<li><a href="#">To you how all this mistaken </a></li>
<li><a href="#">Idea of denouncing pleasure </a></li>
<li><a href="#">And praising pain </a></li>
<li><a href="#">Was born and </a></li>
<li><a href="#">Will give you a </a></li>
<li><a href="#">At explorer of the truth</a></li>
</ul>
</li>


<div class="clr"></div>
</ul>

</div>

</div>
-->

<div class="last-banner-tag"><p><img src="<?php echo $OUTPUT->pix_url('icon', 'theme'); ?>" alt="" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut orci erat, laoreet aliquam porta a, tempor eget velit. Ut scelerisque …</p></div>
    <?php if (!empty($coursefooter)) { ?>
        <div id="course-footer"><?php echo $coursefooter; ?></div>
    <?php } ?>
    <?php if ($hasfooter) { ?>
    <div class="modal-footer-con" class="clearfix">
    <div class="modal-footer" class="clearfix">
        <p class="helplink">
        <?php echo page_doc_link(get_string('moodledocslink')) ?>
        </p>

        <?php
        echo $OUTPUT->login_info();
        if (empty($PAGE->theme->settings->hidemoodlelogo)) {
        		echo $OUTPUT->home_link();
        }
        echo $OUTPUT->standard_footer_html();
        ?>
        <div id="moodlethemes"><a href="http://www.moodlethemes.com/">Moodle Themes</a></div>    </div>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>







</div>


<?php echo $OUTPUT->standard_end_of_body_html();
// -----code for back to top----------------------
if (!empty($PAGE->theme->settings->backtotop)) {
?>
<div id="back-to-top" style="display: none;"> 
    <a class="arrow" href="#" title="<?php echo get_string('backtotop', 'theme_bootstrap_creation')?>">▲</a> 
</div>
<?php }?>


<script src="<?php echo $CFG->wwwroot;?>/theme/bootstrap_creation/js/jquery.js"></script>
<script src="<?php echo $CFG->wwwroot;?>/theme/bootstrap_creation/js/bootstrap.js"></script>


</body>
</html>