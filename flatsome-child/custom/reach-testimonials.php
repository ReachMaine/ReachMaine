<?php
// [reach_testimonial]
function shortcode_reach_testimonial($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"pos" => '',
		"name" => '',
    	"image_align" => 'alignleft',
		"company" => '',
		"title" => '',
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);


    if (strpos($image,'http://') !== false || strpos($image,'https://') !== false) {
      $image = $image;
    }
     else {
      $image = wp_get_attachment_image_src($image, 'thumbnail');
      $image = $image[0];
    }


 	$testimonial = '<div class="reach_testimonial_wrapper">';
	if($image) {
		$testimonial .= '<div class="reach_testimonial_image '.$image_align.'"><img src="'.$image.'" alt="'.$name.'" /></div><!-- .testimonial_image -->';
	}	
	$testimonial .= 	'<div class="reach_testimonial_text_wrapper"> ';
	if ($title) {
		$testimonial .= 	'<i class="fa fa-quote-left fa-pull-left"></i>'; 
		$testimonial .= 	'<h4 class="test_title">'.$title.'</h4>';
	}
	$testimonial .= 		'<div class="test_content">'.$content.'</div>';
	if ($title) {
		$testimonial .= 	'<i class="fa fa-quote-right fa-pull-right"></i>'; 
	}
	$testimonial .= 		'<div class="tx-div small"></div>';
	$testimonial .= 		'<div class="test_name">'.$name.'</div>';
	$testimonial .= 		'<div class="test_company">'.$company.'</div>';
	$testimonial .= 	'</div><!-- text_wrapper -->';
	$testimonial .= '</div><!-- reach_testimonial_wrapper --> ';
	return $testimonial;
}

add_shortcode('reach_testimonial','shortcode_reach_testimonial');