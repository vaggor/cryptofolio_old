<table width="100%" border="0">
                            <tr>
                              <td>
                              <div class="form-group" style=" margin-right:50px;margin-top:-18px;"><?php echo $this->Form->input('exchange_id', array('label'=>'','class'=>'form-control','div'=>false,'options' => array(''=>'Select Exchange',$exch))); ?></div>
                </td>
                              <td>
                <div class="form-group" style=" margin-right:50px;margin-top:0px;">
                                    <?php  echo $this->Form->input('trading_pair_id',array('label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                    </div>
                </td>
                              <td>
                              <div class="form-group" style=" margin-right:50px;margin-top:0px;">
                                    <?php echo $this->Form->input('limit',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false,'placeholder'=>'Trading Amount in BTC')); ?>
                                    </div>
                              </td>
                              <td>
                              <label class="switch">
                                <!--<input type="checkbox"><span class="slider round"></span>!-->
                                <?php echo $this->Form->input('add_profit',array('type'=>'checkbox','label'=>false,'class'=>'slider round','div'=>false)); ?><span class="slider round"></span>
                              </label>
                              </td>
                             
                            </tr>

                            <tr>
                              <td>
                              <div class="form-group" style=" margin-right:50px;margin-top:0px;">
                                    <?php echo $this->Form->input('threshold',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false,'placeholder'=>'Percentage Profit')); ?>
                                    Example 2 not 2%
                                    </div>
                              </td>
                              <td>
                                  <div class="form-group" style=" margin-right:50px;margin-top:0px;">
                                    <?php echo $this->Form->input('stop_loss',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false,'placeholder'=>'Percentage Stop Loss')); ?>
                                    Example -5 not -5%. Do not forget the (-) sign
                                    </div>
                              </td>
                               <td>
                              <div class="form-group" style=" margin-right:50px;margin-top:0px;">
                                    <?php echo $this->Form->input('rebuy_point2',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false,'placeholder'=>'Rebuy Price in BTC')); ?>
                                    </div>
                              </td>
                              <td>
                              <div class="row" style=" margin-right:50px;margin-top:-18px;">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                              </td>
                            
                              <td>
                                            
                              </td>
                            </tr>
                          </table>