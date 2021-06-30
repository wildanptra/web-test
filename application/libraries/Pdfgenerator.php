<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once(APPPATH."/third_party/vendor/autoload.php");

class Pdfgenerator {

  public $title = '';

  public function pemesananAnalist($file_name="", $data="")
  {
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'default_font_size' => 9]);
    // $style = file_get_contents(baslse_url("assets/modules/css/pdf_generator/bootstrap.table.css"));
    $url = base_url("assets/modules/css/pdf_generator/bootstrap.table.css");
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
      $style = curl_exec($ch);
      $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch) ;
    $mpdf->AddPage('P','','','','',8,8,8,8,12,12);
    $mpdf->WriteHTML($style, 1);
    $html = '
    <body class="theme-default">
    <section class="page-content">
    <div class="page-content-inner">

        <!-- Pricing Tables -->
        <div class="panel">
            <div class="panel-heading text-right">
                <small>Rekap Analist</small>
            </div>
            <div class="panel-body">
                <div class="margin-bottom-50">
                    <div class="invoice-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    <br />
                                    <img class="margin-right-10" src="'.("http://prioritas-group.com/assets/common/img/logo-inverse.png").'" height="50" alt="Amazon">
                                </h4>
                                <address>
                                    Unit Bisnis :
                                    <b>'.$data["nama_unitbisnis"].'</b>
                                    <br />
                                    Kode Unit Bisnis :
                                    <b>'.$data["kd_unitbisnis"].'</b>
                                    <br />
                                    Analist :
                                    <b>'.$data["nama_analist"].'</b>
                                    <br />
                                </address>
                            </div>
                        </div>
                        <div class="table-responsive table-font">
                            <table class="table table-hover text-right">
                                <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">#</th>
                                    <th colspan="2" class="text-center" style="vertical-align:middle">Description</th>
                                    <th class="text-center" style="vertical-align:middle">Cicilan<br><small>(Bulan)</small></th>
                                    <th class="text-center" style="vertical-align:middle">Cicilan/Bulan</th>
                                    <th class="text-center" style="vertical-align:middle">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                  '.$data["dataRow_pdf"].'
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <table style="width:300px" class="table table-hover text-center">
                              <thead>
                                <tr>
                                  <th>Total Order</th>
                                  <th>Total Nilai Order</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td>'.$data["total_mo"].'</td>
                                    <td>'.myNum($data["subTotalAkhir"], "Rp. ").'</td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Pricing Tables -->
    </div>
    </section>
    </div>
    <div class="main-backdrop"><!-- --></div>
    </body>
      ';
    $mpdf->WriteHTML($html, 2);
    $mpdf->Output($file_name, 'F');
  }


  public function pemesananAnalist_email($data)
  {
    // $arr = $data["arr"];
    // $listbarang = implode(" ", $data["list_barang"][$arr]);
    $style = file_get_contents(base_url("assets/modules/css/email/pemesananAnalist.email.css"));
    $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <title>Optimasi SEO dalam Sepuluh Menit</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
          '.$style.'
        </style>
      </head>
      <body style="background-color: #f1f1f1; margin:0; padding:0; line-height:1.2em; font-family:arial, verdana, helvetica">
      <div style="width: 670px; background: white; margin: auto; padding: 10px;">
      <table width="650" cellpadding="0" cellspacing="0" align="center" border="0">
        <tr>
          <td valign="top">
            <!-- BEGIN HEADER -->
            <table width="650" cellpadding="0" cellspacing="0" align="center" border="0" style="margin-top:18px; margin-bottom:21px; font-size:11px; color: #909090">
            </table>
            <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#ffffff">
                <td>
                  <a href="https://www.prioritas-group.com" target="_blank"><img src="http://prioritas-group.com/assets/common/img/logo-inverse.png" border="0" width="210" alt="PRIOTIRAS-GROUP" style="display:block;height:auto;"></a>
                </td>
                <td align="right" width="385" style="padding-right:20px; font-size:18px; color: #202020; line-height:1.3em">&nbsp;
                </td>
                <td width="20">
                </td>
              </tr>
              <tr>
                <td height="30">
                </td>
              </tr>
            </table>
            <!-- END EADER -->
            <!-- START BODY -->
            <table width="650" style="background-color:#ffffff">
              <tr>
                <td width="300">
                  <table style="font-size: 12px; color: #444">
                    <tr>
                      <td>Unit Bisnis</td>
                      <td>: <b>'.$data["nama_unitbisnis"].'</b></td>
                    </tr>
                    <tr>
                      <td>Kd. Unit Bisnis</td>
                      <td>: <b>'.$data["kd_unitbisnis"].'</b></td>
                    </tr>
                    <tr>
                      <td>Analist</td>
                      <td>: <b>'.$data["nama_analist"].'</b></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <h4>List Barang Order</h4>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center" style="vertical-align:middle">#</th>
                    <th style="vertical-align:middle" colspan="2">Description</th>
                    <th class="text-center" style="vertical-align:middle">Cicilan<br><small>(Bulan)</small></th>
                    <th class="text-center" style="vertical-align:middle">Cicilan/Bulan</th>
                    <th class="text-center" style="vertical-align:middle">Total</th>
                </tr>
                </thead>
                <tbody>
                '.$data["dataRow_email"].'
                </tbody>
            </table>
            <br/>
            <br/>
            <div style="text-align: center">
                <table style="width:200px" class="table table-hover margin: auto">
                  <thead>
                    <tr>
                      <th width="50">Total<br />Order</th>
                      <th>Total Nilai Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>'.$data["total_mo"].'</td>
                        <td>'.myNum($data["subTotalAkhir"], "Rp. ").'</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <!-- END BODY -->
            <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="font-size:11px; color: #7c7c7c; margin-bottom:20px;margin-top: 10px;">
    <!--           <tr>
                <td class="a2" align="center">
                  Untuk berhenti berlangganan klik <a href="http://newsletter.srs-x.net/unsubscribe/37073ee40eefff478d56bae43394c5cc0ba18f754c9ac5b22ff1b88d355e6547ad890c2b2881d8e53722160e73d5d51742a83a089987f01bfa68f3833d3249d9b5d277de0af5df5c"><u>di sini</u></a> - Copyright &copy; 2018 CV. Rumahweb Indonesia
                </td>
              </tr> -->
            </table>
            <!-- END FOOTER -->
          </td>
        </tr>
      </table>
    </div>
      </body>
    </html>
    ';
    return $html;
    // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    // $mpdf->WriteHTML($html);
    // $mpdf->Output();
  }


  public $htmlFooter = '';
  public $htmlHeader = '';
  public $marginTop  = 8;
  public $marginBottom  = 8;

  function cetak_pdf($html='Hello Dani', $oriented='P', $LoadCss='', $paperSize='A4', $footer=false, $filename=null)
  {

      // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [215,139], 'default_font_size' => 9]);
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $paperSize, 'default_font_size' => 9]);
      $mpdf->showImageErrors = true;
      // @import url(".base_url()."assets/common/css/source/components/tables.css);
      $css = "        ;
          @import url(".base_url()."assets/common/css/source/helpers/fonts.css);

          @page{
              margin: 0;
              background: white;
          }
          ";
      // $url = "http://identitas.online/cdn/pdf_generator/bootstrap.table.css";
      $url = base_url()."assets/modules/css/penjualan/penjualan_sewa_beli_faktur.css";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
      $style = curl_exec($ch);
      $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch) ;

      if($this->htmlHeader != '') $mpdf->SetHTMLHeader($this->htmlHeader);

      $mpdf->AddPage($oriented,'','','','',8,8,$this->marginTop,$this->marginBottom,8,8);
      
      $mpdf->SetTitle($this->title ?? 'Cetak');
            
      if($footer && $this->htmlFooter == '') {
        $mpdf->setFooter($footer);
      }


      if($LoadCss) {
        $mpdf->WriteHTML($LoadCss, 1);
      } else {
        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($css, 1);
      }
      $mpdf->WriteHTML($html, 2);

      if($this->htmlFooter != '') $mpdf->SetHTMLFooter($this->htmlFooter);


      $filename = $filename ?? "faktur_penjualan".time().".pdf";
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    // echo $style;
  }

  function cetak_excel($html='Hello Dani', $oriented='P', $LoadCss='', $paperSize='A4', $footer=false, $filename=null)
  {

      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $paperSize, 'default_font_size' => 9]);
      $mpdf->showImageErrors = true;
      // @import url(".base_url()."assets/common/css/source/components/tables.css);
      $css = "        ;
          @import url(".base_url()."assets/common/css/source/helpers/fonts.css);

          @page{
              margin: 0;
              background: white;
          }
          ";
      // $url = "http://identitas.online/cdn/pdf_generator/bootstrap.table.css";
      $url = base_url()."assets/modules/css/penjualan/penjualan_sewa_beli_faktur.css";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
      $style = curl_exec($ch);
      $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch) ;

      $mpdf->AddPage($oriented,'','','','',8,8,8,15,8,8);
      
      $mpdf->SetTitle($this->title ?? 'Cetak');
      
      if($footer) {
        $mpdf->setFooter($footer);
      }
      if($LoadCss) {
        $mpdf->WriteHTML($LoadCss, 1);
      } else {
        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($css, 1);
      }
      $mpdf->WriteHTML($html, 2);



      $filename = $filename ?? "faktur_penjualan".time().".pdf";
      $mpdf->Output($filename,\Mpdf\Output\Destination::INLINE);
    // echo $style;
  }


}
