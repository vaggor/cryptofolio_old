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

                               
                          </fieldset>