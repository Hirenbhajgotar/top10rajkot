<!-- https://stackoverflow.com/questions/24450304/load-data-on-scroll-up-like-facebook-chatting-system
http://jsfiddle.net/holoverse/sP72b/3/


https://www.webslesson.info/2017/03/load-content-while-scrolling-with-jquery-ajax-php.html -->


<div class="page-bread mb70">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Messages</h3>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>

<div>
    <div class="container">
        <div class="row">
            <?php if ($total_num_rows > 0) { ?>
                <!-- display all leads -->
                <div class="col-sm-4 col-md-4">
                    <h3>Leads</h3>
                    <?php foreach ($buyer_lead as $value) { ?>
                        <a onclick="get_messages('<?php echo $value->bl_id ?>')" style="cursor: pointer">
                            <span><b>Product: </b><?= $value->p_product_name ?></span><br>
                            <span><b>seller: </b><?= $value->s_firstname . ' ' . $value->s_lastname ?></span>
                            <p><?= word_limiter($value->bl_description, 3) ?></p>
                        </a>
                        <hr>
                    <?php } ?>
                </div>
                <!-- display header -->
                <div class="col-sm-8 col-md-8">
                    <div id="header_info" style="display: none">
                        <div class="jumbotron">
                            <div class="row">
                                <div class="col-sm-3 col-md-3" id="show_header_img">
                                </div>
                                <div class="col-sm-9 col-md-9">
                                    <h5 id="header_seller_name"></h5>
                                    <p class='text-small' id="header_lead_msg"></p>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div id="read_preview_msg" style="display: none">
                            <p href="#" class='text-center' style="cursor: pointer" id="load_previous_msg_link" onclick="load_previous_msg()">Read Previous Messages</p>
                        </div>
                    </div>
                    <div id="display_previous_msg">
                        <!-- Display previous chat messages -->
                    </div>
                    <div id="display_chat_messages">
                        <!-- Display chat messages -->
                    </div>
                    <br><br>
                    <form id='chat_message_form' style="display: none">
                        <textarea class='form-control' name='ajax_message_field' id='message_field' rows='3'></textarea>
                        <input type='hidden' name='ajax_chat_buyer_id' id="ajax_chat_buyer_id">
                        <input type='hidden' name='ajax_chat_seller_id' id="ajax_chat_seller_id">
                        <input type='hidden' name='ajax_chat_lead_id' id="ajax_chat_lead_id">
                        <button id='MessageSubmitAjax' type='submit' class='btn btn-primary'>Send</button>
                    </form>
                </div>
            <?php } else { ?>
                <div style="width: 100%; height: 300px">
                    <p class='text-center'>Leads not available</p>
                </div>
            <?php } ?>

        </div>
    </div>
</div>