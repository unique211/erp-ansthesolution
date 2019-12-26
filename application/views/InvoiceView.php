<html>
    <head></head>
    <!-- <div><p><a style="text-decoration:none;color:black;" href="<?php echo base_url();?>Main/barcode_master" link display="block">Barcode</a></p></div> -->
    <body onload="window.print();">
       
        <div>
            <p> <?php 
                for($i=1;$i<=$qty;$i++){?>
                    <img style="margin-bottom:15px;margin-top:5px;"  class=" barcode" src="<?php echo base_url().'assets/barcode/'.$barcode.'.png'?>">
                    
                <?php }
            ?></p>
        </div>
    </body>
</html>
