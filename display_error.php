 <?php 
 function display_error($errors){
    $display = '<ul class ="bg-danger text-center text-white clearfix">';
    foreach ($errors as $error) {
        $display .= '<li class="text-white">'.$error. '</li>';
    }
    $display .= '</ul>';
    return $display;
}

 ?>