<?php 
if(!function_exists('admininfo')){
    function admininfo(){
        return Auth::guard('admin')->user();
    }
}
if(!function_exists('expertinfo')){
    function expertinfo(){
        return Auth::guard('expert')->user();
    }
}
if(!function_exists('userinfo')){
    function userinfo(){
        return Auth::user();
    }
}

if(!function_exists('defaultcurrency')){
    function defaultcurrency(){
        return "INR";
    }
}
if(!function_exists('project')){
    function project(){
        return "Expertbells";
    }
}
if(!function_exists('myipaddress')){
    function myipaddress(){
        return request()->ip();
    }
}
if(!function_exists('adminmail')){
    function adminmail(){
        return "support@expertbells.com";
    }
}
if(!function_exists('ccadminmail')){
    function ccadminmail(){
        // return "info@expertbells.com";
        return 'mithun.sws@gmail.com';
    }
}
if(!function_exists('mailsupportemail')){
    function mailsupportemail(){
        return "help@expertbells.com";
    }
}
if(!function_exists('generateotp')){
    function generateotp($n){
        $generator = "1357902468";
        $result = "";  
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }    
        return $result;
    }
}
if(!function_exists('generateuserno')){
    function generateuserno(){
        $numnber = mt_rand(0,999999);
        $checkuser = \App\Models\User::where('user_id',$numnber)->count();
        if($checkuser>0){
            $this->generateuserno();
        }else{
            if(strlen($numnber)<4){ $this->generateuserno(); }
            else{ return $numnber; }            
        }
    }
}
if(!function_exists('generatebookingno')){
    function generatebookingno(){
        $numnber = mt_rand(0,999999);
        $checkuser = \App\Models\SlotBook::where('booking_id',$numnber)->count();
        if($checkuser>0){
            $this->generatebookingno();
        }else{
            if(strlen($numnber)<4){ $this->generatebookingno(); }
            else{ return $numnber; }            
        }
    }
}
if(!function_exists('generateexpertno')){
    function generateexpertno(){
        $numnber = mt_rand(0,999999);
        $checkuser = \App\Models\Expert::where('user_id',$numnber)->count();
        if($checkuser>0){
            $this->generateexpertno();
        }else{
            if(strlen($numnber)<4){ $this->generateexpertno(); }
            else{ return $numnber; }
        }
    }
}
if(!function_exists('generateexpertvideoid')){
    function generateexpertvideoid(){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_';
        $result='';
        for ($i = 0; $i < 11; $i++){
            $result .= $characters[mt_rand(0, 63)];
        }
        $checkuser = \App\Models\ExpertVideo::where('video_id',$result)->count();        
        if($checkuser>0){
            $this->generateexpertvideoid();
        }else{            
            return $result;         
        }
    }
}

if(!function_exists('viewcounts')){
    function viewcounts($count){
        for($A=$count;$A<=999;$A++){
            return $A;
        }
        if($count>999 && $count<99999){ 
            for($A=$count;$A<=99999;$A++){
                if(strlen($count)==4){ 
                    $string = substr($A,0,2); 
                    return floatval(substr_replace($string,'.', 1, 0)).'K';
                }
                if(strlen($count)==5){ 
                    $string = substr($A,0,3); 
                    return floatval(substr_replace($string,'.', 2, 0)).'K';
                }        
           }
        }
        if($count>99999 && $count<9999999){ 
            for($A=$count;$A<=9999999;$A++){
                if(strlen($count)==6){ 
                    $string = substr($A,0,2); 
                    return floatval(substr_replace($string,'.', 1, 0)).'M';
                }
                if(strlen($count)==7){ 
                    $string = substr($A,0,3); 
                    return floatval(substr_replace($string,'.', 2, 0)).'M';
                }        
           }
        }
    }
}
if(!function_exists('checkimagetype')){
    function checkimagetype($image){
        $explode = explode('.',$image);     
        return strtoupper(end($explode));
    }
}
if(!function_exists('datetimeformat')){
    function datetimeformat($date){
        return date('d M, Y h:i A',strtotime($date));
    }
}
if(!function_exists('dateformat')){
    function dateformat($date){
        return date('d M, Y',strtotime($date));
    }
}
if(!function_exists('timeformat')){
    function timeformat($date){
        return date('H:s A',strtotime($date));
    }
}
if(!function_exists('directFile')){
    function directFile($path,$image){
        $name = $image->getClientOriginalName(); 
        $fileName = date("Y-m-d").rand(1111111,9999999).$name;
        $image->move(public_path($path),$fileName);
        return $fileName;
    }
}
if(!function_exists('autoheight')){
    function autoheight($path,$width,$image){
        $name = $image->getClientOriginalName(); 
        $fileName = date("Y-m-d").rand(1111111,9999999);        

        /** webp **/
        $imagesource = public_path($path.$fileName.'.webp'); 
        \Image::make($image->getRealPath())->encode('webp', 90)->resize($width,null,function ($constraint) {
            $constraint->aspectRatio();
        })->brightness(1)->save($imagesource);

         
        /** jpg **/
        $imagesource2 = public_path($path.'jpg/'.$fileName.'.jpg'); 
        \Image::make($image->getRealPath())->encode('jpg', 90)->resize($width,null,function ($constraint) {
            $constraint->aspectRatio();
        })->brightness(1)->save($imagesource2);
       
        return $fileName;
    }
}
if(!function_exists('generatealias')){
    function generatealias($table,$field,$title){

        $table=$table;

        $field=$field; 

        $slug = $title; 

        $slug = Str::slug($title, "-");

        $key=NULL;

        $value=NULL;

        $i = 0;

        $params = array ();

        $params[$field] = $slug;

        if($key)$params["$key !="] = $value;

        while (DB::table($table)->where($params)->get()->count()){

            if (!preg_match ('/-{1}[0-9]+$/', $slug ))

                $slug .= '-' . ++$i;

            else

                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );

                $params [$field] = $slug;

        }

        return  $alias=$slug;

    }
}
?>