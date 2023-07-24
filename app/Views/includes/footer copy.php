<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Album example is © Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
    </div>
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
                <div class="row">
                    <div class="col-md-6">
                        <img src="" id="product_image" height="300px" width="450px" class="rounded float-left">
                    </div>
                    <div class="col-md-6">
                        <p id="product_id"></p>
                        <p id="store_name"></p>
                        <p id="product_desc"></p>
                    </div>
                </div>
                <form method="post" id="tags">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="color_tag" class="col-form-label">Color:</label>
                                <select name="color[]" class="form-control select2color" id="color_tag" required multiple="multiple">
                                    <option style="background-color: #ff0000;" value="Red">Red</option>
                                    <option style="background-color: #800000;" value="Maroon">Maroon</option>
                                    <option style="background-color: #ff7f50;" value="Coral">Coral</option>
                                    <option style="background-color: #b87333;" value="Copper">Copper</option>
                                    <option style="background-color: #d4af37;" value="Golden">Golden</option>
                                    <option style="background-color: #ffa500;" value="Orange">Orange</option>
                                    <option style="background-color: #ffff00;" value="Yellow">Yellow</option>
                                    <option style="background-color: #008000;" value="Green">Green</option>
                                    <option style="background-color: #50c878;" value="Emerald">Emerald</option>
                                    <option style="background-color: #808000;" value="Olive">Olive</option>
                                    <option style="background-color: #f0e68c;" value="Khaki">Khaki</option>
                                    <option style="background-color: #00ffff;" value="Aqua">Aqua</option>
                                    <option style="background-color: #000000;" value="Black">Black</option>
                                    <option style="background-color: #c0c0c0;" value="Silver">Silver</option>
                                    <option style="background-color: #0000ff;" value="Blue">Blue</option>
                                    <option style="background-color: #808080;" value="Grey">Grey</option>
                                    <option style="background-color: #ffffff;" value="White">White</option>
                                    <option style="background-color: #f5f7e3;" value="Pearl White">Pearl White</option>
                                    <option style="background-color: #add8e6;" value="Light blue">Light blue</option>
                                    <option style="background-color: #800080;" value="Purple">Purple</option>
                                    <option style="background-color: #c8a2c8;" value="Lilac">Lilac</option>
                                    <option style="background-color: #ee82ee;" value="Violet">Violet</option>
                                    <option style="background-color: #f224d4;" value="Pink">Pink</option>
                                    <option style="background-color: #dda0dd;" value="Plum">Plum</option>
                                    <option style="background-color: #f4a460;" value="SandyBrown">SandyBrown</option>
                                    <option style="background-color: #ffb6c1;" value="LightPink">LightPink</option>
                                    <option style="background-color: #ffcba4;" value="Peach">Peach</option>
                                    <option style="background-color: #90ee90;" value="LightGreen">LightGreen</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Fabric" class="col-form-label">Fabric:</label>
                                <select name="fabric[]" class="form-control select2" id="Fabric" multiple="multiple">
                                    <option value="Lawn">Lawn</option>
                                    <option value="Cotton">Cotton</option>
                                    <option value="Chiffon">Chiffon</option>
                                    <option value="Silk">Silk</option>
                                    <option value="Linen">Linen</option>
                                    <option value="Woolen">Woolen</option>
                                    <option value="Net">Net</option>
                                    <option value="Tissue">Tissue</option>
                                    <option value="Velvet">Velvet</option>
                                    <option value="Khaddar">Khaddar</option>
                                    <option value="Jacquard">Jacquard</option>
                                    <option value="Karandi">Karandi</option>
                                    <option value="Sateen">Sateen</option>
                                    <option value="Zardozi">Zardozi</option>
                                    <option value="Georgette">Georgette</option>
                                    <option value="Banarsi">Banarsi</option>
                                    <option value="Pashmina">Pashmina</option>
                                    <option value="Slub Leather">Slub Leather</option>
                                    <option value="Organza">Organza</option>
                                    <option value="Cambric">Cambric</option>
                                    <option value="Jamawar">Jamawar</option>
                                    <option value="Masoori">Masoori</option>
                                    <option value="Swiss Voile">Swiss Voile</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Season" class="col-form-label">Season:</label>
                                <select name="Season[]" class="form-control select2" id="Season" multiple="multiple">
                                    <option value="Spring/Summer">Spring Summer</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Pre-Fall">Pre-Fall</option>
                                    <option value="Winter">Winter</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Occasion" class="col-form-label">Occasion:</label>
                                <select name="occasion[]" class="form-control select2" id="occasion" multiple="multiple">
                                    <option value="Party Wear/Wedding Wear">Party Wear/Wedding Wear</option>
                                    <option value="Festive Wear">Festive Wear</option>
                                    <option value="Casual Wear">Casual Wear</option>
                                    <option value="Daily Wear">Daily Wear</option>
                                </select>
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
<!-- moving text js -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var colors = {
        'Red': '#ff0000',
        'Maroon': '#800000',
        'Coral': '#ff7f50',
        'Copper': '#b87333',
        'Golden': '#d4af37',
        'Orange': '#ffa500',
        'Yellow': '#ffff00',
        'Green': '#008000',
        'Emerald': '#50c878',
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
        'Pink': '#dda0dd',
        'Plum': '#f4a460',
        'SandyBrown': '#ffb6c1',
        'LightPink': '#ffcba4',
        'Peach': '#90ee90'
    };
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
        });
        $(".tags_btn").on("click", function() {

            $("#myModal").find(".modal-footer .status").html(``);
            var product_id = $(this).data('id');
            console.log($(".products").find('.' + product_id).next().find(".tags_btn").data());
            var store = $(this).data('store');
            var title = $(this).data('title');
            var tags = $(this).data('tags');
            var img_src = $(this).data('img');
            var description = $(this).data('desc');
            //console.log(description);
            $('#myModal').modal('show');

            $('#myModal').find("#modal_title").text(title);
            $('#myModal').find("#product_desc").html('Description:- ' + description);
            //store_name
            $('#myModal').find("#product_id").html(`<h3>${product_id}</h3>`);
            $('#myModal').find("#store_name").html(`<h3>${store}</h3>`);
            $('#myModal').find("#product_image").attr('src', img_src);
            $('#myModal').find(".modal-body #tags").append(`<input type="hidden" name="product_id" value="${product_id}"/>`);
            $('#myModal').find(".modal-body #tags").append(`<input type="hidden" name="tags" value="${tags}"/>`);
            $('#myModal').find(".modal-body #tags").append(`<input type="hidden" name="store_name" value="${store}"/>`);
            $('#myModal').find(".modal-body #tags").append(`<input type="hidden" name="product_title" value="${title}"/>`);

            //console.log(product_id);
        });
        $('#myModal').on('shown.bs.modal', function(e) {

            $('#myModal .select2color').select2({
                width: '100%',

                templateResult: function(data, container) {
                    //alert(0);
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
        })
        $("#tags").on("submit", function(e) {

            e.preventDefault();
            var form = $('#tags').serialize();
            $.ajax({
                'url': baseUrl + 'home/addTags',
                data: form,
                type: "POST",
                beforeSend: function() {
                    $("#myModal").find(".modal-footer .save_tags").text('Please Wait..');
                    $("#myModal").find(".modal-footer .status").html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>`);
                },
                success: function(data) {
                    console.log(data);
                    $("#myModal").find(".modal-footer .save_tags").text('Save Changes');
                    $("#myModal").find(".modal-footer .status").html(`<p>Updated Product Successfully </p>`);

                },
                error: function(err) {
                    console.log(err);
                    $("#myModal").find(".modal-footer .status").html(`<p>${err}</p>`);
                }
            });
        });
    });
</script>
</body>

</html>