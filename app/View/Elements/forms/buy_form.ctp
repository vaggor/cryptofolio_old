<fieldset class="mt-sm">
                                <legend>Market Order Form</legend>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Exchange <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('exchange_id', array('label'=>'','class'=>'form-control','options' => array(''=>'Select Exchange',$exch))); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Trading Pair <span class="required">*</span></label>
									<div class="col-sm-8">
                                    <?php //echo $this->Form->input('trading_pair_id',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                    <?php  echo $this->Form->input('trading_pair_id',array('label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Quantity<span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('buy_qty',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Expected Profit %</label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('threshold',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                        You can leave this filed empty. By default the bot will make 1% and above profit. You can also specify your prefered percentage profit. Example 2 not 2%
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Stop Lose %</label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('stop_loss',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                        You can leave this field empty. By default the bot keeps your coin in trade even when in the negative till it turns around and makes you 1% profit and above. You can also put in a percentage lose at which the bot should exit your trade when in negative. <br>Example -5 not -5%. Do not forget the (-) sign
                                    </div>
                                </div>

                               
                          </fieldset>