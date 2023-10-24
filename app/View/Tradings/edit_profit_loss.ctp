<div class="row">
  <div class="col-md-7">
  				<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
                <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Trades <small>Edit Profit/Lose</small></h4>
                    </header>
                    <div class="body">
                       <!-- <form id="user-form" class="form-horizontal form-label-left" novalidate="novalidate" method="post" data-parsley-priority-enabled="false" data-parsley-excluded="input[name=gender]">!-->
					   <?php echo $this->Form->create('RobotTrade',array('url'=>'/tradings/edit_profit_loss','class'=>'form-horizontal form-label-left')); 
                     echo $this->Form->input('id',array('type'=>'hidden'));
              ?>
                          <fieldset class="mt-sm">
                                <legend>Profit/Lose Form</legend>
                            </fieldset>
                            <fieldset>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Expected Profit %</label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('threshold',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                        You can leave this filed empty. By default the bot will make 1% and above profit. You can also specify your prefered percentage profit. Example 2
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Stop Lose %</label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('stop_loss',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                        You can leave this field empty. By default the bot keeps your coin in trade even when in the negative till it turns around and makes you 1% profit and above. You can also put in a percentage lose at which the bot should exit your trade when in negative. Example 5
                                    </div>
                                </div>

                               
                          </fieldset>
                           
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
  </div>
            </div>
