<div>
		<?php if($status == 7){ ?>
        <div><strong>Processing...</strong></div>
        <div><?php echo $this->Html->image('img/ajax-load.gif'); ?></div>
        <?php }elseif($status == 8){ ?>
        <div><strong>Transaction Confirmed and balance updated</strong></div>
        <?php } ?>
</div>