<?php



$html = '<section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> GlobalXtreme ISP
                                <small class="pull-right"><tr>
        <td width="73%"><div align="right"><span class="stylelogoindosat">powered by <strong>IFONE</strong> </span></div></td>
        <td width="27%"><div align="center"><span class="stylelogoindosat"><img src="http://192.168.182.10/software/beta/img/logo-indosat.png"  height="25" /></span></div></td>
      </tr></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>GlobalXtreme Malang</strong><br>
                                Ruko Istana Dinoyo E4-E5<br>
                                Jl. MT Haryono 1A, Malang<br>
                                Phone: (0341) 573 222<br/>
                                Email: info@globalxtreme.net
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>Bejo Marpaung</strong><br>
                                Jl Raya Kembar 3<br>
                                Lowokwaru, Malang<br>
                                Phone: (0341) 539-1037<br/>
                                Email: bejo@marpaung.com
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Date: 2/10/2014<br/>
			    <b>Invoice #007612</b><br/>
                            <b>Order ID:</b> 4F3S8J<br/>
                            <b>Payment Due:</b> 2/22/2014<br/>
                            <b>Account:</b> 968-34567
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Internet</td>
                                        <td>455-981-221</td>
                                        <td>Internet Periode Agustus 2014</td>
                                        <td>Rp. 1000.000</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>VoIP</td>
                                        <td>247-925-726</td>
                                        <td>Abonemen Periode Agustus 2014</td>
                                        <td>Rp. 60.000</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>VOD</td>
                                        <td>735-845-642</td>
                                        <td>Abonemen Periode Agustus 2014</td>
                                        <td>Rp. 60.000</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="http://192.168.182.10/software/beta/img/credit/visa.png" alt="Visa"/>
                            <img src="http://192.168.182.10/software/beta/img/credit/mastercard.png" alt="Mastercard"/>
                            
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                *Note :
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Amount Due 09/22/2014</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>Rp. 1.120.000</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (10%)</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>Rp. 1.120.000</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                   
                </section>';
//==============================================================
//==============================================================
//==============================================================
include("../mpdf.php");

$mpdf=new mPDF('c','A4','','',5,5,5,5,0,0); 

$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage','two');

// LOAD a stylesheet
$stylesheet = file_get_contents('http://192.168.182.10/software/beta/css/bootstrap.min.css');
$stylesheet2 = file_get_contents('http://192.168.182.10/software/beta/css/font-awesome.min.css');
$stylesheet3 = file_get_contents('http://192.168.182.10/software/beta/css/ionicons.min.css');
$stylesheet4 = file_get_contents('http://192.168.182.10/software/beta/css/AdminLTE.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($stylesheet3,1);
$mpdf->WriteHTML($stylesheet4,1);
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
//==============================================================
//==============================================================


?>