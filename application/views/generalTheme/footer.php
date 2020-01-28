	</div><!-- /Page Content -->
	</div><!-- /Page Container -->

	<!-- Javascripts -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.1.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
	<script src="<?php echo base_url("assets/plugins/datatables/js/jquery.datatables.min.js") ?>"></script>

	<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script> -->

	<script src="<?php echo base_url(); ?>assets/plugins/d3/d3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/nvd3/nv.d3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/pages/form-wizard.js"></script>

	<!-- category page validation js file -->
	<?php if (
		base_url() . "Category/addCategory" === base_url(uri_string()) or
		base_url() . "Category/updateCategoryData/" . $this->uri->segment('3') === base_url(uri_string()) or
		base_url() . "Category/updateCategory/" . $this->uri->segment('3') === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/category_validation.js") ?>"></script>
	<?php } ?>

	<!-- product page validaton js file -->
	<?php if (
		base_url() . "Products/addProducts" === base_url(uri_string()) or
		base_url() . "Products/updateProduct/" . $this->uri->segment('3') === base_url(uri_string()) or
		base_url() . "Products/updateProductData/" . $this->uri->segment('3') === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/product_validation.js") ?>"></script>
	<?php } ?>

	<!-- buyer page validation js file -->
	<?php if (
		base_url() . "Buyer/addBuyer" === base_url(uri_string()) or
		base_url() . "Buyer/updateBuyer/" . $this->uri->segment('3') === base_url(uri_string()) or
		base_url() . "Buyer/updateBuyerData/" . $this->uri->segment('3') === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/buyer_validation.js") ?>"></script>
	<?php } ?>

	<!-- cms page validation js file -->
	<?php if (
		base_url() . "CmsPage/addCmsPage" === base_url(uri_string()) or
		base_url() . 'CmsPage/updateCms/' .  $this->uri->segment('3') === base_url(uri_string()) or
		base_url() . 'CmsPage/updateCmsData/' .  $this->uri->segment('3') === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/cms_page_validation.js") ?>"></script>
	<?php } ?>

	<!-- mail template validation js file -->
	<?php if (
		base_url() . "MailTemplate/addMailTemplate" === base_url(uri_string()) or
		base_url() . "MailTemplate/updateMailTemplate/" .  $this->uri->segment('3') === base_url(uri_string()) or
		base_url() . "MailTemplate/updateMailTemplateData/" .  $this->uri->segment('3') === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/mail_template_validation.js") ?>"></script>
	<?php } ?>

	<!-- settings validaton -->
	<?php if (
		base_url() . "Setting" === base_url(uri_string()) or
		base_url() . "Setting/index" === base_url(uri_string()) or
		base_url() . "Setting/editSettings" === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/settings_validation.js") ?>"></script>
	<?php } ?>

	<!-- banner->seller validaton -->
	<?php if (
		base_url() . "Banner/select_seller" === base_url(uri_string()) OR
		base_url() . "Banner/banner_list" === base_url(uri_string())
		// base_url() . "Setting/editSettings" === base_url(uri_string())
	) { ?>
		<script src="<?= base_url("assets/js_validation/seller_validation.js") ?>"></script>
	<?php } ?>

	<script src="<?php echo base_url(); ?>assets/js/ecaps.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/pages/dashboard.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.datatables.min.js"></script>

	<!-- ck editor -->
	<script src="http://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
	<!-- category description -->

	<!-- product description -->
	<script>
		CKEDITOR.replace('product_description');
	</script>


	</body>

	</html>