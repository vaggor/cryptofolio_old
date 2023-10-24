
        <h2 class="page-title">Invoice <small>Make payment against this invoice</small></h2>
        <p class="lead"><strong>Please transfer the exact amount to the Bitcoin wallet provided. Click on "Proceed with Payment" after the transfer has been done.</strong></p>
        <section class="widget">
            <div class="body no-margin">
                <div class="row">
                    <div class="col-sm-6 col-print-6">
                        <div class="logo">
							<h4><strong>Cryptofolio</strong></h4>
						</div>
                    </div>
                    <div class="col-sm-6 col-print-6">
                        <div class="invoice-number text-align-right">
                            #<?php echo $invoice_no; ?> / <?php echo date('d M,Y',strtotime($date)); ?>
                        </div>
                        <div class="invoice-number-info text-align-right">
                            Invoice payment
                        </div>
                    </div>
                </div>
                <hr>
                <section class="invoice-info well">
                    <div class="row">
                        <div class="col-sm-6 col-print-6">
                            <h4 class="details-title">Company Information</h4>
                            <h3 class="company-name">
                                CryptoFolio
                            </h3>
                            <address>
                                <strong>P.O Box CT 684</strong><br>
                                Cantoment Accra<br>
                                Ghana<br>
                                <abbr title="Work email">e-mail:</abbr> <a href="mailto:#">vaggor44@gmail.com</a><br><br><br>
                            </address>
                        </div>
                        <div class="col-sm-6 col-print-6 client-details">
                            <h4 class="details-title">Payment Information</h4>
                            <h3 class="client-name">
                                <?php echo $address; ?>
                            </h3>
                            <address>
							<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $address; ?>" title="Link to Google.com">
                                <div class="separator line"></div>
                               
                            </address>
                        </div>
                    </div>
                </section>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th class="hidden-xs">BTC Address</th>
                        <th>Amount (BTC)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Deposit for trading fees</td>
                        <td class="hidden-xs"><?php echo $address; ?></td>
                        <td><?php echo $amount; ?></td>
                    </tr>
                   
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-6 col-print-6">
                        <blockquote class="blockquote-sm">
                            <strong>Note:</strong> Pay <?php echo $amount; ?> BTC to the address <?php echo $address; ?>
                        </blockquote>
                    </div>
                    <div class="col-sm-6 col-print-6">
                        <div class="row text-align-right">
                            <div class="col-xs-6"></div> <!-- instead of offset -->
                            <div class="col-xs-3">
                                <p class="no-margin"><strong>Total</strong></p>
                            </div>
                            <div class="col-xs-3">
                                <p class="no-margin"><strong><?php echo $amount; ?> BTC</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="btn-toolbar mt-lg text-align-right hidden-print">
                    <!--<button id="print" class="btn btn-default">
                        <i class="fa fa-print"></i>
                        &nbsp;&nbsp;
                        Print
                    </button>!-->

                    <?php echo $this->Form->create('Invoice',array('url'=>'/tradings/payment_success','class'=>'form-horizontal form-label-left')); 
                        echo $this->Form->input('invoice_no',array('type'=>'hidden','value'=>$invoice_no));
                        echo $this->Form->input('address',array('type'=>'hidden','value'=>$address));
                        echo $this->Form->input('date',array('type'=>'hidden','value'=>$date));
                        echo $this->Form->input('amount',array('type'=>'hidden','value'=>$amount));
                    ?>
                    <button class="btn btn-danger">
                        Proceed with Payment
                        &nbsp;
                        <i class="fa fa-arrow-right"></i>
                    </button>
                    </form>
                </div>
          