<div class="mt-1 mb-4">
    <h3><?= $title ?></h3>
</div>
<p> <b>First name: </b><?= $buyer_data->first_name ?> </p>
<p> <b>Last name: </b><?= $buyer_data->last_name ?> </p>
<p> <b>Email: </b><?= $buyer_data->email ?> </p>
<p> <b>Mobie no.: </b><?= $buyer_data->mobile_no ?> </p>
<p> <b>Gender: </b><?= $buyer_data->gender ?> </p>
<br>
<p><a href="<?= base_url("change-password/{$buyer_data->id}") ?>">Change password</a></p>

<a href="<?= base_url("update-profile/{$buyer_data->id}") ?>" class="btn btn-primary">Update</a>