<section class="page-content" style="padding-top: 0;">
	<div class="container">
        <div class="row">
            <div class="title-accent" style="padding-left: 15px; margin-bottom: 15px;">
                <h3><a href="<?php echo Yii::app()->baseUrl.'/'?>"><img src="<?php echo Yii::app()->baseUrl.'/images/arrr_icon.jpg'?>" style="vertical-align: top;" /></a>Repair Status</h3>
            </div>
        	<div class="col-12" style="margin-top: 0; padding: 0 20px;">
                   <table class="devices">
                    <tr>
                        <th style="width: 3%;">No</th>
                        <th style="width: 20%;">Repair Code (S/N)</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 60%;">Comments</th>
                    </tr>
                    <?php if(!empty($models)){
                        $i = 1;
                        foreach($models as $r){
                    ?>
                    <tr style="border-bottom: 1px solid #fbd6bb;">
                        <td><?php echo $i;?></td>
                        <td style="font-weight: 900; font-size: 18px;"><?php echo $r['device_serial'];?></td>
                        <td style="color: <?php echo (is_numeric($r['status']))?Yii::app()->params['colorStatusDevice'][$r['status']]:'#fff;background:red; height:100%';?>;">
                                            <?php echo (is_numeric($r['status']))?Yii::app()->params['statusdevice'][$r['status']]:$r['status'];?></td>
                        <td><?php echo $r['comments'];?></td>
                    </tr>
                    <?php  $i++;      
                        }
                    }?>
                    <tr>
                        
                    </tr>
                   </table>
            </div>
          <div class="clr"></div>
         </div>
    </div>
</div>