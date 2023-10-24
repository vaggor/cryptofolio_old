<div class="row">
  <div class="col-md-7">
  				<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
                <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Password Change <small>Change your password</small></h4>
                    </header>
                    <div class="body">
                       <!-- <form id="user-form" class="form-horizontal form-label-left" novalidate="novalidate" method="post" data-parsley-priority-enabled="false" data-parsley-excluded="input[name=gender]">!-->
					   <?php echo $this->Form->create('User',array('url'=>'/users/change_password','class'=>'form-horizontal form-label-left')); ?>
                          <fieldset class="mt-sm">
                                <legend>Password Change Form</legend>
                            </fieldset>
                            <fieldset>
                                <legend class="section">Account Info</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Old Password <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="first-name" name="first-name" required="required" class="form-control input-transparent" ></div>!-->
									<div class="col-sm-8"><?php echo $this->Form->input('opass',array('type'=>'password','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="last-name">New Password <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="last-name" name="last-name" required="required" class="form-control input-transparent" ></div>!-->
									<div class="col-sm-8"><?php echo $this->Form->input('password',array('type'=>'password','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="last-name">Confirm Password <span class="required">*</span></label>
                                    <!--<div class="col-sm-8"><input type="text" id="last-name" name="last-name" required="required" class="form-control input-transparent" ></div>!-->
                                    <div class="col-sm-8"><?php echo $this->Form->input('cpass',array('type'=>'password','label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?></div>
                                </div>
                          </fieldset>
                           
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
  </div>
            </div>
