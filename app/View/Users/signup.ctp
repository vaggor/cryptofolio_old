<?php echo $this->Html->script(array('https://www.google.com/recaptcha/api.js')); ?>
<div class="row">
  <div class="col-md-7">
  				<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
                <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Account Profile <small>Create new or edit existing user</small></h4>
                    </header>
                    <div class="body">
                       <!-- <form id="user-form" class="form-horizontal form-label-left" novalidate="novalidate" method="post" data-parsley-priority-enabled="false" data-parsley-excluded="input[name=gender]">!-->
					   <?php echo $this->Form->create('User',array('url'=>'/users/signup','class'=>'form-horizontal form-label-left')); ?>
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
                                    <label class="control-label col-sm-4" for="first-name">Email Address <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><?php echo $this->Form->input('email',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Password <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><?php echo $this->Form->input('password',array('type'=>'password','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Confirm Password <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><?php echo $this->Form->input('cpass',array('type'=>'password','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name"></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
                                   <div class="col-sm-8"><div class="g-recaptcha" data-sitekey="6LcP3EsUAAAAAMWennriGnwgCgbg2qdI52xC_JBN"></div></div>
                                </div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Validate &amp; Submit</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
  </div>
            </div>
