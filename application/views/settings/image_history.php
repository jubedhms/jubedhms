<?php   
    $files = array(); $i=1;
    $files = glob('data/app/'.$image_dir."/*.*"); 
        for ($i=0; $i<count($files); $i++) { // $i mean to start first files names.
        $num = $files[$i];
        $file_name=explode('/',$num);
        if($recent==1){
            $date=date("Y-m-d", filemtime($num));
            if($date==date('Y-m-d')){
        ?>
    <div class="col-md-3">
            <button type="button" data-src="<?php echo $num;?>" class="close remove_history_image" aria-hidden="true" style=" top: -42px; left: 37px; ">×</button>
            <div class="border"><a href="javascript:void(0);"  ><img class="history_image" src="<?php echo $num;?>" class="card-img-top" wth="500" hth="500" width="100" height="100"></a></div>
        <div class="pleft" ><?php echo date("M d, Y", filemtime($num)); ?></div>
    </div>     
            <?php } }else{  ?>
           
    <div class="col-md-3">
            <button type="button" data-src="<?php echo $num;?>" class="close remove_history_image" aria-hidden="true" style=" top: -42px; left: 37px; ">×</button>
            <div class="border"><a href="javascript:void(0);"  ><img class="history_image" src="<?php echo $num;?>" class="card-img-top" wth="500" hth="500" width="100" height="100"></a></div>
        <div class="pleft" ><?php echo date("M d, Y", filemtime($num)); ?></div>
    </div> 
            
        <?php } } ?>