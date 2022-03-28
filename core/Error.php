<?php
class Erorr {
    //put your code here
    public static function alert($type){
        /*
         * if find 503 page show this page else show Errors
        */
        if(file_exists('app/views/Erorrs/503.blade.php')){
            /*
             * show 503 page
             */
            require_once 'app/views/Erorrs/503.blade.php';
        }else{
            print_r('<html><head><style>body{overflow: hidden; background:#2c3e50; direction:rtl;text-align:center;}div{ background:#ecf0f1;color:#e74c3c; width:100%; padding:10px 0px;}</style></head><body><div>ASSET_ERROR_COR[]'.$type.'</div></body></html>');
        }
    }
}
?>