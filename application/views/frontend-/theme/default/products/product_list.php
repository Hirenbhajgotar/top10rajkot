<div class="mt-4">
    <br>
    <p><span>Seller: <?= $seller_info->seller_firstname . ' ' . $seller_info->seller_lastname ?></span></p>
    <p>
        <span>Emal: <?= $seller_info->seller_email ?> </span>
    </p>
    <p>
        <span>Gst no.: <?= $seller_info->seller_gst_number ?> </span>
    </p>
    <p>
        <span>Last login: <?= date("M d,Y", strtotime($seller_info->seller_last_login))  ?> </span>
    </p>
</div>
<div class="row">
    <h4><?= $title ?></h4>

    <?php
    if ($products) {
        foreach ($products as $item) { ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?= base_url("assets/images/products/{$item->product_image}") ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->product_name ?></h5>
                        <h5>Model: <?= $item->product_model ?></h5>
                        <p class="card-text">
                            <?= $item->product_description ?>
                        </p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <h4>Nothing to show</h4>
    <?php } ?>
</div>