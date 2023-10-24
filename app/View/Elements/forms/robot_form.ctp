<fieldset class="mt-sm">
                                <legend>Robot Creation Form</legend>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Name <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
									<div class="col-sm-8"><?php echo $this->Form->input('name',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">API Key <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('api_key',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">API Secret <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('api_secret',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Exchange <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('exchange_id', array('label'=>'','class'=>'form-control','options' => array(''=>'Select Exchange',$exch))); ?></div>
                                </div>
                               
                          </fieldset>