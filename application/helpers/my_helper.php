<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_pagination_helper'))
{
    function my_pagination_helper($base_link ,$total_page, $current=1 , $view_range = 5)
    {
        if (empty($current)) {
            $current = 1;
        }
        
        if ($total_page <1 || $current<1|| $current>$total_page) 
            return;
        echo '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        if ( $current ==1) {
            echo "<li class='page-item'><a class='page-link' href='javascript:void(0);'>First</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='{$base_link}?page=1'>First</a></li>";
        }
        if ( $current ==1) {
            echo "<li class='page-item'><a class='page-link' href='javascript:void(0);'>Previous</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='{$base_link}?page=".($current-1)."'>Previous</a></li>";
        }
        $st = $view_range* floor($current/ $view_range); // 0, 5, 10 ,15
        $ed = ($st+$view_range) <= $total_page ? ($st+$view_range): $total_page; // 5, 10, 15
        for ($p = $st+1; $p <=$ed; $p++ ) {
            
            echo "<li class='page-item ".($current==$p?"active":"")."'><a class='page-link' href='{$base_link}?page={$p}'>".$p."</a></li>";
        }
        if ( $current ==$total_page) {
            echo "<li class='page-item'><a class='page-link' href='javascript:void(0);'>Next</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='{$base_link}?page=".($current+1)."'>Next</a></li>";
        }
        if ( $current ==$total_page) {
            echo "<li class='page-item'><a class='page-link' href='javascript:void(0);'>Last</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='{$base_link}?page={$total_page}'>Last</a></li>";
        }
        echo '</ul></nav>';
    }   
}
