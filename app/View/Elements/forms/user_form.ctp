<fieldset class="mt-sm">
                                <legend>Account Creation Form</legend>
                            </fieldset>
                            <fieldset>
                                <legend class="section">Personal Info</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Full Name <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
									<div class="col-sm-8"><?php echo $this->Form->input('name',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>
                               
                          </fieldset>
                            <fieldset>
                                <legend class="section">Account Info</legend>
                                <div class="form-group">
                                    <label id="email-label" for="email" class="control-label col-sm-4">Email <span class="required">*</span></label>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="input-group">
                                            <!--<input id="email" type="email" data-trigger="change" required="required" class="form-control input-transparent" name="email">!-->
											<?php echo $this->Form->input('email',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button">Write an email</button>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                               
                            </fieldset>