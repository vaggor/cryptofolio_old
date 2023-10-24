<fieldset class="mt-sm">
                                <legend>Coin Creation Form</legend>
                            </fieldset>
                           
                            <fieldset>
                                <legend class="section">Coin Info</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Name <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><?php echo $this->Form->input('name',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Symbol <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><?php echo $this->Form->input('symbol',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Image <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><?php echo $this->Form->input('image',array('type'=>'file','label'=>false,'class'=>'form-control input-transparent','div'=>false));?></div>
                                </div>
                            </fieldset>