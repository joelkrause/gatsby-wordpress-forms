<?php
add_action( 'rest_api_init', 'wp_api_add_posts_endpoints' );
function wp_api_add_posts_endpoints(){
  register_rest_route( 'send/v1', '/email', array(
    'methods' => 'POST',
    'callback' => 'post_form'
  ));
}

function post_form(WP_REST_Request $request){
    $options = get_option( 'gatsby_form_settings' );
    $to = $options['gatsby_email_to_address'];;
    $body = '';

    $body.='<table>';
    foreach ($request->get_params() as $key => $value){
        $field_name = str_replace('_',' ',$key);
        $body.='<tr>';
            $body.='<td>';
                $body.=$field_name;
            $body.='</td>';
            $body.='<td>';
                $body.=$value;
            $body.='</td>';
        $body.='</tr>';
        if(strpos($key, 'email') !== false){
            $reply_to = $key;
        }
    }
    $body.='</table>';

    $subject = 'New Enquiry';
    $headers[] = 'Reply-To: Name Name <ijk@lmn.op>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    echo $body;
    wp_mail( $to, $subject, $body, $headers );
}