<!-- Display the plugin inside a widget -->

<?php

  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<p>
  <label>Title</label> 
  <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
