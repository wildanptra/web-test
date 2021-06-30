<?php
//MyReport.php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."/third_party/vendor/koolreport/autoload.php");
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use \koolreport\processes\CopyColumn;
use \koolreport\processes\OnlyColumn;

class MyReport extends \koolreport\KoolReport
{
  // use \koolreport\clients\Bootstrap;
  public function settings()
  {
        $Url_assets = base_url("assets-koolreport");
        return array(
            "assets"=>array(
                "path"=> "assets-koolreport",

                "url"=> $Url_assets,
            ),
            "dataSources"=>array(
                "nuprioritassept2018"=>array(
                    "connectionString"=>"mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE'),
                    "username"=>getenv('DB_USERNAME'),
                    "password"=>getenv('DB_PASSWORD'),
                    "charset"=>"utf8"
                )
            )
        );
    }

    public function setup()
    {
        $this->src('nuprioritassept2018')
        ->query("Select bn.id,
                 bn.nama_barang,
                 bn.sku_supplier,
                 bn.spesifikasi,
                 bp.nama_produk,
                 bm.nama_merek,
                 bk.nama_kategori,
                 bkw.nama_kategori_web,
                 bn.status from barang_nama bn
                 LEFT JOIN barang_produk bp ON bn.produk_id=bp.id
                 LEFT JOIN barang_merek bm ON bm.id=bn.merek_id
                 LEFT JOIN barang_kategori bk ON bk.id=bn.kategori_id
                 LEFT JOIN barang_kategori_web bkw ON bkw.id=bn.kategori_web_id where bn.is_trash=:dihapus")
        ->params(array(":dihapus"=>"1"))
        ->pipe(new Group(array(
            "by"=>"nama_barang",
            "sum"=>"status"
        )))
        ->pipe(new Sort(array(
            "status"=>"desc"
        )))
        ->pipe($this->dataStore("barang_nama"));
    }
}
