<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."/third_party/vendor/autoload.php");

class Pdfgenerator {

  //LAPORAN PEMESANAN SEWA BELI -------------------------------------------------------------------------------------------------
  function print_rekap_pdf($html='')
  {
      $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L',
        'default_font_size' => 9
      ]);
      $mpdf->showImageErrors = true;
      $css = "        ;
          @import url(".base_url()."assets/common/css/source/helpers/fonts.css);

          @page{
              margin: 0;
              background: white;
          }
          ";
      // $url = base_url()."assets/modules/css/laporan/lap_pemesanan_sewa_beli_rekap_html.css";
      $url = base_url()."assets/addons_css/invoice.css";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
      $style = curl_exec($ch);
      $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch) ;

      $mpdf->AddPage('L','','','','',8,8,8,8,8,8);
      $mpdf->WriteHTML($style, 1);
      $mpdf->WriteHTML($css, 1);
      $mpdf->WriteHTML($html, 2);
      $mpdf->Output("LoadPemesananSewaBeli".time().".pdf",\Mpdf\Output\Destination::INLINE);

  }
  //END -------------------------------------------------------------------------------------------------------------------------

}
