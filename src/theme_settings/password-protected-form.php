<?php 
function be_passwordform( $output ) {
  $post = get_post();
  $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form text-center max-w-[540px] mx-auto" method="post">
  <h2 class="h2">' . __( 'Password protected content' , '_themename' ) . '</h2>
  <p>' . __( 'This content is protected by password. Please enter password below.' , '_themename' ) . '</p>
  <div class="mt-3 flex flex-col gap-2 max-w-[400px] mx-auto"><input placeholder="*****" class="text-black bg-transparent text-center border border-gray-100 rounded-none min-h-[40px] w-full leading-snug py-3 transition-all duration-300 font-normal text-sm" name="post_password" type="password" size="20" /></label> <input class="btn btn-fill-tertiary mx-auto !w-full" type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" /></div></form>
  ';
  return $output;
}
add_filter( 'the_password_form', 'be_passwordform' );
?>