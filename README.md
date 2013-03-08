theme_bootstrap_creation
========================

This theme is Based on the Bootstrap CSS framework

Latest bugfixes:

1. Add some part 

{
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



}

in general.php from (https://github.com/bmbrands/theme_bootstrap/) theme



2. Responsive on mobile and tab devices. 

3. Add bootstrap drop-down menu in this theme.

4. Improved login page view.

5. Improved sitetopic view (heading,btn-custom etc, ).

6. Forum view (user pic).

7. Add footer banner.

8. Improved block Tags view.

9. Course page heading

10. Improved tab view.

11. Manage private files view.

12. Workshop main page.

13. Tested for Moodle 2.4

14. Tested on different browsers and devices.

15. Changes in only general.php layout (One layout).

16. All buttons and over all look view.


This is available on GitHub:

https://github.com/susmita123/theme_bootstrap_creation


Feel free to modify / improve / share


Author:  Susmita Dhar
Contact: susmita@vidyamantra.com
Website: https://www.vidyamantra.com/




















