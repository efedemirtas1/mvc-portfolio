<!DOCTYPE html>
<html lang="tr">

    <?php $this->load->view("tema/includes/ust");  ?>

    <body class="<?=$ayarlar->tema?>">
        <?php $this->load->view("tema/includes/menu");  ?>
        
        <?php $this->load->view("tema/{$viewModel}"); ?>
        
        <?php $this->load->view("tema/includes/footer");  ?>
        <?php $this->load->view("tema/includes/alt");  ?>

    </body>

</html>