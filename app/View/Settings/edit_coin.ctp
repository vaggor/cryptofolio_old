<div class="row">
  <div class="col-md-7">
  				<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
                <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Coin Profile <small>Edit coin</small></h4>
                    </header>
                    <div class="body">
                       <!-- <form id="user-form" class="form-horizontal form-label-left" novalidate="novalidate" method="post" data-parsley-priority-enabled="false" data-parsley-excluded="input[name=gender]">!-->
					   <?php echo $this->Form->create('Coin',array('url'=>'/settings/edit_coin','class'=>'form-horizontal form-label-left','type'=>'file'));
                    echo $this->Form->input('id',array('type'=>'hidden'));
              ?>
                          <?php echo $this->element('forms/coin_form') ?>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Validate &amp; Save</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
  </div>
            </div>
