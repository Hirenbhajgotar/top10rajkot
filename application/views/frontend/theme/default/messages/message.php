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
                        <a onclick="get_lead_messages('<?php echo $value->bl_id ?>')" style="cursor: pointer">
                            <p>
                                <span><b>Product: </b><?= $value->p_product_name ?></span><br>
                                <span><b>seller: </b><?= $value->s_firstname . ' ' . $value->s_lastname ?></span>
                                <p><?= word_limiter($value->bl_description, 3) ?></p>
                            </p>
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
                    <hr>
                    <div id="display_chat_messages">
                        <!-- Display chat messages -->
                    </div>
                    <div style="margin-top: 20px">
                        <form id='chat_message_form' style="display: none">
                            <input type="text" class='form-control' name='ajax_message_field' id='message_field' rows='3' placeholder="Write messges" required>
                            <input type='hidden' name='ajax_chat_buyer_id' id="ajax_chat_buyer_id">
                            <input type='hidden' name='ajax_chat_seller_id' id="ajax_chat_seller_id">
                            <input type='hidden' name='ajax_chat_lead_id' id="ajax_chat_lead_id">
                            <button id='MessageSubmitAjax' type='submit' class='btn btn-primary'>Send</button>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div style="width: 100%; height: 300px">
                    <p class='text-center'>Leads not available</p>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<script src="<?php echo base_url("assets/js/jquery-3.4.1.min.js") ?>"></script>
<script>
    let set_interval_id = '';

    function autoload_messages(leadId) {
        set_interval_id = setInterval(function() {
            get_messages(leadId, set_interval_id);
        }, 3000);
    }


    // !chat messages
    let click = 0;

    function get_lead_messages(leadId) {
        click = 0;
        clearInterval(set_interval_id);
        $('#display_previous_msg').text("");
        get_messages(leadId);
        autoload_messages(leadId);
    }

    function get_messages(leadId = '', set_interval_id = '') {
        document.getElementById('load_previous_msg_link').setAttribute('onclick', "load_previous_msg(" + leadId + ")");
        $.ajax({
            type: 'post',
            url: '<?php echo base_url("chat") ?>',
            data: {
                leadId: leadId
            },
            success: function(data) {
                // console.log(data);
                let chatRes = JSON.parse(data);
                console.log(chatRes);
                if (chatRes.status == 'ok') {

                    // * set value on hidden fields
                    $('#ajax_chat_buyer_id').val(chatRes.buyerId);
                    $('#ajax_chat_seller_id').val(chatRes.sellerId);
                    $('#ajax_chat_lead_id').val(chatRes.leadId);

                    // * display header div
                    $("div#header_info").show();

                    // * display chat input field
                    $('#chat_message_form').show();

                    // * create image element and display it
                    let image = document.createElement("IMG");
                    image.alt = "Product Image";
                    image.setAttribute('class', 'img-responsive');
                    image.setAttribute('width', '100px');
                    image.src = `<?php echo base_url("assets/images/products/"); ?>${chatRes.header_info[0].product_image}`;
                    $("#show_header_img").html(image);

                    // * display seller name
                    $('#header_seller_name').html(`${chatRes.header_info[0].seller_firstname + ' '+ chatRes.header_info[0].seller_lastname}`);

                    // * dispaly lead message on header
                    let lead_msg = chatRes.header_info[0].lead_description;
                    $('#header_lead_msg').html(truncate(lead_msg, 4));

                    // * display chat messages
                    $('#display_chat_messages').html(chatRes.content);

                    if (chatRes.num_rows > 5) {
                        $('#read_preview_msg').show();
                    } else {
                        $('#read_preview_msg').hide();
                    }
                    // autoload_messages(leadId);
                    // clearInterval(set_interval_id);
                }
            },
            error: function(data) {
                console.log('error');
            }
        });
    }

    // * truncate string
    const truncate = (str, max = 10) => {
        const array = str.trim().split(' ');
        const ellipsis = array.length > max ? '...' : '';

        return array.slice(0, max).join(' ') + ellipsis;
    };


    // * send messages 
    $(function() {
        $('#chat_message_form').on('submit', function(e) {
            e.preventDefault();
            let chat_input_field = $('#message_field').val();
            if (chat_input_field != '') {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("set_messages") ?>',
                    data: $('form').serialize(),
                    success: function(data) {
                        // console.log(data);
                        let chatRes = JSON.parse(data);
                        // console.log(chatRes);
                        // console.log(chatRes.leadId);
                        let display_chat_messages = document.getElementById('display_chat_messages');

                        // * reset textarea field
                        $('#message_field').val('');
                        display_chat_messages.innerHTML = chatRes.content;
                        $('#message_field').focus();
                        if (chatRes.num_rows > 5) {
                            document.getElementById('read_preview_msg').style.display = "block";
                        } else {
                            document.getElementById('read_preview_msg').style.display = "none";
                        }
                        // autoload_messages(chatRes.leadId);
                        // clearInterval(set_interval_id);

                    },
                    error: function(data) {
                        console.log("error");
                    }
                });

            } else {
                console.log('null');
            }

        });

    })


    // * load previous messages
    function load_previous_msg(leadId) {
        click += 1;
        $.ajax({
            type: 'post',
            url: '<?php echo base_url("previous_messages") ?>',
            data: {
                leadId: leadId,
                click: click
            },
            success: function(data) {
                let chatResult = JSON.parse(data);
                // console.log(chatResult);
                $('#display_previous_msg').prepend(chatResult.content);

                // * remove 'load previous msg link'
                if (chatResult.content == '') {
                    document.getElementById('read_preview_msg').style.display = "none";
                }
            },
            error: function(data) {
                console.log('error');
            }
        });
    }
</script>