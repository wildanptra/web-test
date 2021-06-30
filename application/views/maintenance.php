<style>
    .error {
        text-align: center;
        padding: 30px;
        padding-top: 10%;
        padding-bottom: 10%;
    }
    .error h4 {
        margin: 0px;
        margin-bottom: 20px;
        padding: 0px;
    }

</style>

<div class="error">
    <h4>Module "<?=strtoupper($this->router->fetch_module());?>" sedang dalam pembaharuan</h4>
    <p>
        Silahkan hubungi Admin untuk informasi lebih lanjut.
    </p>
</div>