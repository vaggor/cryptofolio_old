<h2 class="page-title">Dashboard <small>Statistics and more</small></h2>
        <section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs">
                            <li class="active">
							<?php echo $this->Html->link('Buying',array('controller'=>'transactions','action'=>'buy_txns')); ?>                          
							</li>
                            <li>
                               <?php echo $this->Html->link('Selling',array('controller'=>'transactions','action'=>'sell_txns')); ?>                          
							   </li>
                        </ul>
                    </header>
                    <div class="body tab-content">
                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget1">
            
            <div class="body">
                <p>
                    Column sorting, live search, pagination. Built with
                    <a href="http://www.datatables.net/" target="_blank">jQuery DataTables</a>
                </p>
                <div class="mt">
                    <table id="datatable-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th class="no-sort hidden-xs">Info</th>
                            <th class="hidden-xs">Description</th>
                            <th class="hidden-xs">Date</th>
                            <th class="no-sort">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><span class="fw-semi-bold">Algerd</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; JPEG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 200x150
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Palo Alto</a></td>
                            <td class="hidden-xs">June 27, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 29%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><span class="fw-semi-bold">Vitaut</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; PNG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 6433x4522
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Vilnia</a></td>
                            <td class="hidden-xs">January 1, 1442</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 19%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><span class="fw-semi-bold">Honar</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; AVI
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 1440x980
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Berlin</a></td>
                            <td class="hidden-xs">August 6, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 49%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><span class="fw-semi-bold">Jack</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; PNG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 12x43
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">San Francisco</a></td>
                            <td class="hidden-xs">August 19, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar" style="width: 69%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><span class="fw-semi-bold">Leon</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; MP4
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 800x480
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Brasilia</a></td>
                            <td class="hidden-xs">October 1, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 9%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><span class="fw-semi-bold">Max</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; TXT
                                </small>
                                <br>

                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; -
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Helsinki</a></td>
                            <td class="hidden-xs">October 29, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-warning" style="width: 38%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><span class="fw-semi-bold">Pol</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; MOV
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 640x480
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Radashkovichi</a></td>
                            <td class="hidden-xs">November 11, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 83%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><span class="fw-semi-bold">Chrishna</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; DOC
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; -
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Mumbai</a></td>
                            <td class="hidden-xs">December 2, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-info" style="width: 40%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td><span class="fw-semi-bold">Leslie</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; AVI
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 4820x2140
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Singapore</a></td>
                            <td class="hidden-xs">December 6, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-warning" style="width: 18%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td><span class="fw-semi-bold">David</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; XML
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; -
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Portland</a></td>
                            <td class="hidden-xs">December 13, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 54%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td><span class="fw-semi-bold">Andrej</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; VOB
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 6433x4522
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Minsk</a></td>
                            <td class="hidden-xs">December 14, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar" style="width: 25%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td><span class="fw-semi-bold">Julia</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; JPEG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 40x40
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Hrodna</a></td>
                            <td class="hidden-xs">July 9, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td><span class="fw-semi-bold">Ihnat</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; JAVA
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; -
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Los Angeles</a></td>
                            <td class="hidden-xs">August 2, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 8%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td><span class="fw-semi-bold">Abraham</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; DOCX
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; -
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Panama</a></td>
                            <td class="hidden-xs">September 3, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 80%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td><span class="fw-semi-bold">Tomas</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; JPEG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 1800x1420
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Amsterdam</a></td>
                            <td class="hidden-xs">November 13, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 10%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td><span class="fw-semi-bold">Scott</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; PNG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 240x460
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Sluck</a></td>
                            <td class="hidden-xs">December 5, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar" style="width: 93%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td><span class="fw-semi-bold">Pham</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; MAIL
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; -
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Tokyo</a></td>
                            <td class="hidden-xs">December 8, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 44%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td><span class="fw-semi-bold">Peter</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; PNG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 8320x6400
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Cape Town</a></td>
                            <td class="hidden-xs">December 29, 2012</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 5%;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td><span class="fw-semi-bold">Uladz'</span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Type:</span>
                                    &nbsp; JPEG
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Dimensions:</span>
                                    &nbsp; 2200x1600
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#">Mahileu</a></td>
                            <td class="hidden-xs">December 7, 2013</td>
                            <td class="width-150">
                                <div class="progress progress-sm mt-xs">
                                    <div class="progress-bar progress-bar-gray-light" style="width: 0%;"></div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
                    
              