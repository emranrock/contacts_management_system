<footer class="text-muted footer">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>© <?= ucfirst($sitename); ?></p>
    </div>
    <input type="hidden" id="user_time" value="" />
</footer>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Modal title</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-1">
                            <img src="" id="product_image" height="550px" class="rounded float-left">
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-1">
                            <p>Store:- <span id="store_name"></span></p>
                            <p>Product Id <span id="product_id"></span></p>
                            <span id="product_desc"></span>
                            <br/>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-1 ">
                            <form method="post" id="tags">
                                <input type="hidden" name="product_id" id="hdn_pid" value="" />
                                <input type="hidden" name="tags" id="hdn_tags" value="" />
                                <input type="hidden" name="store_name" id="hdn_store_name" value="" />
                                <input type="hidden" name="product_title" id="hdn_product_title" value="" />
                                <input type="hidden" name="handel" id="hdn_handel" value="" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Fabric:</label>
                                        </div>
                                        <?php 
                                        
                                        if($options[0]['option_name'] == "Fabric"){
                                                 //$output = '';
                                                foreach (json_decode($options[0]['option_values'],true) as $val) {
                                                    echo '<div class="form-check form-check-inline">
                                                        <input  type="checkbox" class="form-check-input"  name="fabric[]" id="' . $val . '" value="' . $val . '">
                                                        <label class="form-check-label" for="' . $val . '"> ' . $val . '</label>
                                                    </div>';
                                                }
                                        } ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="color_tag" class="col-form-label">Pick Color: </label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="color-picker">
                                                    <label for="colorPicker">
                                                        <input type="color" value="#1DB8CE" id="colorPicker">
                                                    </label>
                                                </span>
                                            </div>
                                            <select name="color[]" class="form-control select2color" id="color_tag" required multiple="multiple">
                                            <?php 
                                            foreach ($options as $key => $value) {
                                                if($value['option_name'] == "Colors"){
                                                    $colors_arr = json_decode($value['option_values'],true);
                                                    foreach ($colors_arr as $key=>$val) {
                                                        echo '<option value="'.$key.'">'.$key.'</option>';
                                                    }
                                                } 
                                            }
                                           ?>
                                            </select>
                                        </div>
                                        <div id="color_errors"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Season" class="col-form-label">Season:</label>
                                            <select name="Season[]" class="form-control select2" id="Season" multiple="multiple">
                                            <?php 
                                            foreach ($options as $key => $value) {
                                                if($value['option_name'] == "Season"){
                                                   foreach (json_decode($value['option_values'],true) as $val) {
                                                       echo '<option value="'.$val.'">'.$val.'</option>';
                                                   }
                                               }
                                            }
                                             ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Occasion" class="col-form-label">Occasion:</label>
                                            <select name="occasion[]" class="form-control select2" id="occasion" multiple="multiple">
                                            <?php 
                                            foreach ($options as $key => $value) {
                                            if($value['option_name'] == "Occasion"){
                                                 //$output = '';
                                                foreach (json_decode($value['option_values'],true) as $val) {
                                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                                }
                                            } }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="status  float-left"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save_tags">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="login_modal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <form action="" method="post" id="login_form">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <div class="clearfix">
                            <label>Password</label>
                        </div>
                        <input type="password" name="password" class="form-control" required="required">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="status  float-left"></div>
                    <input type="submit" class="btn btn-primary logins" id="login_btn" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .modal.custom {
        outline: none;

    }

    .modal.custom .modal-dialog {
        width: 130%;
        margin: 0 auto;
    }

    input#colorPicker {
        height: 31px;
        border-radius: 30;
        width: 40px;
    }

    img#product_image {
        -ms-flex: 0 0 230px;
        flex: 0 0 230px;
        /* background-color: #adff2f; */
        max-width: 350px;
    }

    .modal-xl{
        max-width: 1280px !important;
    }
</style>
<!-- moving text js -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo base_url('admin_assets/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/ColourAlgo.js'); ?>"></script>
<script>
    var colors_arr = <?= json_encode($colors_arr)?>;
    var colors = colors_arr != undefined || colors_arr != NULL ? colors_arr:{
        'Red': '#ff0000',
        'Maroon': '#800000',
        'Coral': '#ff7f50',
        'Copper': '#b87333',
        'Golden': '#d4af37',
        'Orange': '#ffa500',
        'Yellow': '#ffff00',
        'Green': '#008000',
        'Emerald': '#5ac878',
        'Olive': '#808000',
        'Khaki': '#f0e68c',
        'Aqua': '#00ffff',
        'Black': '#000000',
        'Silver': '#c0c0c0',
        'Blue': '#0000ff',
        'Grey': '#808080',
        'White': '#ffffff',
        'Pearl White': '#f5f7e3',
        'Light blue': '#add8e6',
        'Purple': '#800080',
        'Lilac': '#c8a2c8',
        'Violet': '#ee82ee',
        'Pink': '#f224d4',
        'Plum': '#dda0dd',
        'SandyBrown': '#f4a460',
        'LightPink': '#ffb6c1',
        'Peach': '#ffcba4',
        'LightGreen': '#90ee90'
    };
    $(document).ready(function() {
        $('.select2').select2();
        $(".tags_btn").on("click", function() {
            var data = $(this).data();
            $('#myModal .select2').select2({
                width: '100%',
            });
            loadProduct(data);
        });
        $("#login_form").on("submit", function(e) {
            e.preventDefault();
            var form = $('#login_form').serialize();
            $.ajax({
                'url': baseUrl + 'home/login',
                type: "POST",
                dataType: "json",
                data: form,
                beforeSend: function() {
                    $("#login_modal").find(".modal-footer .logins").text('Please Wait..');
                    $("#login_modal").find(".modal-footer .status").html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>`);
                },
                success: function(response) {
                    //console.log(response);
                    if (response && response == 'Login Successfully') {
                        $("#login_modal").find(".modal-footer .logins").text('Save Changes');
                        $("#login_modal").find(".modal-footer .status").html(`<p>${response}</p>`);
                        setTimeout(function() {
                            $('#login_modal').modal('hide');
                            location.reload(true);
                        }, 1000);
                    } else {
                        $("#login_modal").find(".modal-footer .logins").text('Save Changes');
                        $("#login_modal").find(".modal-footer .status").html(`<p>${response}</p>`);
                    }
                },
                error: function(err) {
                    $("#login_modal").find(".modal-footer .status").html(`<p>${err.msg}</p>`);
                }
            });
        });
        $("#tags").on("submit", function(e) {
            e.preventDefault();
            var pro_id = $(this).find('#hdn_pid').val();
            var form = $('#tags').serialize();
            $.ajax({
                'url': baseUrl + 'home/addTags',
                type: "POST",
                dataType: "json",
                data: form,
                beforeSend: function() {
                    $("#myModal").find(".modal-footer .save_tags").text('Please Wait..');
                    $("#myModal").find(".modal-footer .status").html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>`);
                },
                success: function(response) {

                    if (response) {
                        $("#myModal").find(".modal-footer .save_tags").text('Save Changes');
                        $("#myModal").find(".modal-footer .status").html(`<p>${response.msg}</p>`);
                        setTimeout(function() {
                            var next_product = $(".products").find('.' + pro_id).next().find(".tags_btn").data();
                            if (next_product != undefined) {
                                $('#myModal .select2color').val(null).trigger('change');
                                $('.select2').val(null).trigger('change');
                                $("input[name='fabric']").prop('checked', false);
                                $('#myModal .form-check-input').iCheck('uncheck');;
                                loadProduct(next_product);
                            } else {
                                $('#myModal').modal('hide');
                            }
                        }, 1000);
                    }

                },
                error: function(err) {
                    //console.log(err);
                    $("#myModal").find(".modal-footer .status").html(`<p>${err.msg}</p>`);
                }
            });
        });
        $('#myModal').on('show.bs.modal', function(e) {

            $('#myModal .select2color').select2({
                width: '100%',
                tags: true,
                templateResult: function(data, container) {
                    if (data.element) {
                        $(container).css({
                            "background-color": colors[data.text]
                        });
                    }
                    return data.text;
                },
                templateSelection: function(data, container) {
                    var selection = $('#color_tag').select2('data');
                    $(container).css("background-color", colors[data.text]);
                    return data.text;
                },
                data: colors
            });

            $(".form-check-input").iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue',
            });
        });
        $("#myModal").on('hidden.bs.modal', function() {
            $('#myModal .select2color').select2('destroy');
        });

        function loadProduct(data_attr) {
            var description = null;
            $('#color_errors').html('');
            $("#myModal").find(".modal-footer .status").html(``);
            var product_id = data_attr.id;
            var store = data_attr.store;
            var title = data_attr.title;
            var tags = data_attr.tags;
            var img_src = data_attr.img;
            var handel = data_attr.handle;
            //var description = data_attr.desc;
            js_array.forEach(element => {
                for (const [key, value] of Object.entries(element)) {
                    if (key == product_id)
                        description = value;
                }
            });
            $('#myModal').modal('show');
            $('#myModal').find("#modal_title").text(title);
            $('#myModal').find("#product_desc").html(description);
            $('#myModal').find("#product_id").html(`${product_id}`);
            $('#myModal').find("#store_name").html(`${store}`);
            //$('#myModal').find("#tags").html(`${tags}`);
            $('#myModal').find("#product_image").attr('src', img_src);
            $('#myModal').find("#tags #hdn_pid").val(product_id);
            $('#myModal').find("#tags #hdn_tags").val(tags);
            $('#myModal').find("#tags #hdn_store_name").val(store);
            $('#myModal').find("#tags #hdn_product_title").val(title);
            $('#myModal').find("#tags #hdn_handel").val(handel);
        }
        
        $("#colorPicker").on('change', function() {
            var chosen_color = $(this).val();
            $('#color_errors').html('');
            //https://stackoverflow.com/questions/13586999/color-difference-similarity-between-two-values-with-js
            // var chosen_rgb = hexToRgb(chosen_color);
            var selected_color = [];
            var c = 0;
            let new_deltaE;
            var result_array = [];
            for (var k in colors) {
                const secondColor = colors[k];
                const [L1, A1, B1] = Colour.hex2lab(chosen_color, 1);
                const [L2, A2, B2] = Colour.hex2lab(secondColor, 2);
                const deltaE = Colour.deltaE00(L1, A1, B1, L2, A2, B2);
                new_deltaE = ~~deltaE;
                console.log(new_deltaE);

                if (new_deltaE && new_deltaE <= 12) {
                    //console.log(new_deltaE);

                    /*if (selected_color.length == 0) {
                        while (new_deltaE <= 12 && new_deltaE > 20) {
                            if (new_deltaE == 20) {
                                break;
                            }
                            selected_color[c] = k;
                        }
                    }*/
                    selected_color[c] = k;
                } else if (new_deltaE <= 20) {
                    selected_color[c] = k;
                }
                c++;
            }
            if (selected_color.length > 0) {
                $('#myModal .select2color').val(selected_color).trigger('change');
            } else {
                $('#color_errors').html('<p class="small">No Color Found In Palette Choose Manually</p>');
                $('#myModal .select2color').val(null).trigger('change');
            }
        });
        // user tracking code 
        var INITIAL_WAIT = 3000;
        var INTERVAL_WAIT = 10000;
        var ONE_SECOND = 1000;
        var events = ["mouseup", "keydown", "scroll", "mousemove"];
        var startTime = Date.now();
        var endTime = startTime + INITIAL_WAIT;
        var totalTime = 0;
        var clickCount = 0;
        var buttonClickCount = 0;
        var linkClickCount = 0;
        var keypressCount = 0;
        var scrollCount = 0;
        var mouseMovementCount = 0;
        var linkClickCount = 0;
        setInterval(function() {
            if (!document.hidden && startTime <= endTime) {
                startTime = Date.now();
                totalTime += ONE_SECOND;
                $("#timer").html(formatTime(totalTime));
                $("#user_time").val(formatTime(totalTime));
            }
        }, ONE_SECOND);
        events.forEach(function(e) {
            document.addEventListener(e, function() {
                endTime = Date.now() + INTERVAL_WAIT;
                //console.log(endTime, startTime);
                if (e === "mouseup") {
                    clickCount++;
                    $("#click").html(clickCount);
                    if (event.target.nodeName === 'BUTTON') {
                        buttonClickCount++;
                        $("#button").html(buttonClickCount);
                    } else if (event.target.nodeName === 'A') {
                        linkClickCount++;
                        $("#link").html(linkClickCount);
                    }
                } else if (e === "keydown") {
                    keypressCount++;
                    $("#keypress").html(keypressCount);
                } else if (e === "scroll") {
                    scrollCount++;
                    $("#scroll").html(scrollCount);
                } else if (e === "mousemove") {
                    mouseMovementCount++;
                    $("#mouse").html(mouseMovementCount);
                }
            });
        });
        $(".logout_btn").on('click', function(e) {
            e.preventDefault();
            var working_time = $('.footer').children("#user_time").val();

            $.ajax({
                'url': baseUrl + 'home/saveTime',
                type: "POST",
                dataType: "json",
                data: {
                    time: working_time
                },
                success: function(response) {
                    if (response) {
                        $(location).prop('href', baseUrl + 'home/' + response);
                    }
                },
                error: function(err) {
                    $("#login_modal").find(".modal-footer .status").html(`<p>${err.msg}</p>`);
                }
            });
        });
    });

    function formatTime(ms) {
        var seconds = Math.floor(ms / 1000);
        seconds = seconds < 10 ? "0" + seconds : seconds;

        var minutes = Math.floor(ms / (1000 * 60));
        minutes = minutes < 10 ? "0" + minutes : minutes;

        var hours = Math.floor(ms / (1000 * 60 * 60));
        hours = hours < 10 ? "0" + hours : hours;
        2

        return hours + ":" + minutes + ":" + seconds;
    }
</script>
</body>

</html>