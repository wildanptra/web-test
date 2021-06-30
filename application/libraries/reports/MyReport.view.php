<?php
    //MyReport.view.php
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\BarChart;

?>

<div class="text-center">
    <h1>Sales Report</h1>
    <h4>This report shows top 10 sales by customer</h4>
</div>
<hr/>

<?php
  BarChart::create(array(
        "dataStore"=>$this->dataStore('barang_nama'),
        "width"=>"100%",
        "height"=>"500px",
        "columns"=>array(
            "nama_barang"=>array(
                "label"=>"nama_barang"
            ),
      "status"=>array(
                "type"=>"number",
                "label"=>"Amount",
                "prefix"=>"$",
                "emphasis"=>true
            )
        ),
        "options"=>array(
            "title"=>"Sales By Customer",
        )
    ));
?>

<?php
    Table::create(array(
        "dataStore"=>$this->dataStore("barang_nama"),
        // "showHeader"=>false,
        "cssClass"=>array(
            "table"=>"table table-hover table-bordered"
        )
    ));
?>
