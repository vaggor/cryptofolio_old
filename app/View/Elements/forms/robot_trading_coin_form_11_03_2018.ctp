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
                                    <?php echo $this->Form->input('limit',array('type'=>'text','label'=>false,'class'=>'form-control input-transparent','div'=>false,'placeholder'=>'Trading Amount')); ?>
                                    </div>
                              </td>
                              <td>
                              <label class="switch">
                                <!--<input type="checkbox"><span class="slider round"></span>!-->
                                <?php echo $this->Form->input('add_profit',array('type'=>'checkbox','label'=>false,'class'=>'slider round','div'=>false)); ?><span class="slider round"></span>
                              </label>
                              </td>
                              <td>
                
                                <div class="row" style=" margin-right:50px;margin-top:-18px;">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            
                </td>
                            </tr>
                          </table>