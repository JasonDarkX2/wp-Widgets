<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Adsense_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'JDX2-adsense_widget', 

// Widget name will appear in UI
__('Adsense widget(powered by JDX2)', 'JDX2_Adsense_widget_domain'), 

// Widget description
array( 'description' => __( ' Adnse widgets allows you to easily place your ad sense Ad units ', 'JDX2_Adsense_widget_domain' ), ) 
);
}
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
    $this->get_adHeader($instance['adHeader']);
    echo '<div class="adwrap" style="text-align:center;">';
    $this->create_ad($instance);
    echo '</div>';
}
// Widget Backend 
    public function form($instance) {
        //admin form
        $title= $instance['title'];
        $text= $instance['content'];
        $adClient= $instance['adClient'];
        $adSlot= $instance['adSlot']
?>
<label for="options">Ad Header:</label>
 <select name="<?php echo$this->get_field_name( 'adHeader'); ?>" style="width:100%;">
        <option value="">Options:</option>
           <?php 
    $options=array('adc'=>'Advertisement(center)','adr'=>'Adertisement(right)','adl'=>'Advertisement(left)','sadc'=>'Sponsored Ads(center)','sadr'=>'Sponsored Ads(right)','sadl'=>'Sponsored Ads(left)');
    foreach($options as $value=> $title) {
    if(strcmp($instance['adHeader'],$value)==0){
   echo  '<option value="'. $value .'" selected>' . stripslashes($title) .'</option>';
    }else{
        echo  '<option value="'. $value .'">' . stripslashes($title) .'</option>';
    }
} ?>
    </select>
   <label for="title"> ad client id:</label>
   <input 
   id="<?php echo $this->get_field_id( 'adClient' ); ?>" 
   name="<?php echo $this->get_field_name( 'adClient' ); ?>" 
   type="text" 
   style="width:100%;"
   value="<?php echo esc_attr( $adClient ); ?>" 
   />
   <br/>
   <label for="title"> ad slot id:</label>
   <input 
   id="<?php echo $this->get_field_id( 'adSlot' ); ?>" 
   name="<?php echo $this->get_field_name( 'adSlot' ); ?>" 
   type="text" 
   style="width:100%;"
   value="<?php echo esc_attr( $adSlot ); ?>" 
   />
   <br/>
    <label for="options">Ad unit size:</label>
 <select name="<?php echo$this->get_field_name( 'adSize'); ?>" style="width:100%;">
        <option value="">Options</option>
           <?php 
    $options=array('300 x 250','336 x 280','728 x 90','160 x 600','300 x 600','responsive');
    foreach($options as $t) {
    if(strcmp($instance['adSize'],$t)==0){
   echo  '<option value="'. $t .'" selected>' . stripslashes($t) .'</option>';
    }else{
        echo  '<option value="'. $t .'">' . stripslashes($t) .'</option>';
    }
} ?>
    </select>
    <br/>
    <label for="options"> Wrap Ad:</label>
 <select name="<?php echo$this->get_field_name( 'adWrap'); ?>" style="width:100%;">
        <option value="">Options:</option>
           <?php 
    $options=array('Theme widgets','none', 'black box','white box');
    foreach($options as $t) {
    if(strcmp($instance['adWrap'],$t)==0){
   echo  '<option value="'. $t .'" selected>' . stripslashes($t) .'</option>';
    }else{
        echo  '<option value="'. $t .'">' . stripslashes($t) .'</option>';
    }
} ?>
    </select>
<?php }
public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? $new_instance['title'] : '';
        $instance['adClient'] = (!empty($new_instance['adClient']) ) ? $new_instance['adClient'] : '';
        $instance['adSlot'] = (!empty($new_instance['adSlot']) ) ? $new_instance['adSlot'] : '';
        $instance['adSize'] = ( ! empty( $new_instance['adSize'] ) ) ? strip_tags( $new_instance['adSize'] ) : '';
         $instance['adHeader'] = ( ! empty( $new_instance['adHeader'] ) ) ? strip_tags( $new_instance['adHeader'] ) : '';
         $instance['adWrap'] = ( ! empty( $new_instance['adWrap'] ) ) ? strip_tags( $new_instance['adWrap'] ) : '';
        return $instance;
}
function get_size($instance){
    
  switch($instance) {
      case '300 x 250':
          $size= "width:300px;height:250px";
          break;
      case '336 x 280':
           $size= "width:336px;height:280px";
          break;
      case '728 x 90':
      $size= "width:728px;height:90px";
          break;
      case  '160 x 600':
           $size= "width:160px;height:600px";
      case  '300 x 600':
           $size= "width:300px;height:600px";
          break;
      case 'responsive':
          $size="";
      default:
          
          }
          return $size;
}
  function get_adHeader($instance){
    switch($instance){
        case 'adc':
            echo '<p align="center">Advertisement</p>';
            break;
        case 'adr':
            echo '<p align="right">Advertisement</p>';
            break;
        case 'adl':
            echo '<p align="left">Advertisement</p>';
        case 'sadc':
            echo '<p align="center">Sponsored Ads</p>';
            break;
        case 'sadr':
            echo '<p align="right">Sponsored Ads</p>';
            break;
        case 'sadl':
            echo '<p align="left">Sponsored Ads</p>';
            break;
        default :
            echo '<p align="center">Advertisement</p>';
    }
}
function create_ad($instance){?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:inline-block; <?php echo $this->get_size($instance['adSize']); ?>"
         data-ad-client="<?php echo $instance['adClient']; ?>"
         data-ad-slot="<?php echo $instance['adSlot']; ?>"</ins>
         <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<?php }
}


function Adsense_widget() {
	register_widget( 'Adsense_widget' );
}
add_action( 'widgets_init', 'Adsense_widget' );
?>