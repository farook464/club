<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>
<script src="/dist/admin/js/lib/jquery.Jcrop.min.js" type="text/javascript"></script>
<link href="/dist/admin/css/lib/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>

<div class="tab-pane" id="tab_4">



    <div class="col-md-12">

        <div class="progress" style="display: none">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                <span class="sr-only">45% Complete</span>
            </div>
        </div>

        <div class="errorImgUpload alert alert-danger" style="display: none"></div>
        <div class="doneImgUpload alert alert-success" style="display: none"></div>




    </div>

    <div class="col-md-4">


        <?php echo form_open_multipart('admin_jsessID/upload_tmp', array("id" => "uploads")); ?>

        <input type="file" name="userfile" size="20" />

        <br /><br />


        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />

        <input type="hidden" value="false" name="edit"/>


<!--    <img id="jcrop_target" src="/product_image_lib/11150159_861081417299017_7541406223351020366_n.jpg" alt=""/>

    <img class="pull-right" id="preview" src="/product_image_lib/11150159_861081417299017_7541406223351020366_n.jpg" alt=""/>-->

        <?php echo form_close() ?>

    </div>

    <div class="col-md-12">

        <div class="preview-cc"></div>

        <hr/>

        <span class="btn btn-primary" id="doUpload"> <span> Upload Image <span> </span>

    </div>




    <div class="col-md-12 root-files">





        <h4>Uploaded Files</h4>

        <hr/>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="uploadedImges">




            </tbody>
        </table>

    </div>





    <div class="clearfix"></div>



</div>





<!--
--><script>

    $(function () {
        var is_edit = $('input[name=edit]').val();
        var product_uid = null;
        var csrf = $('input[name=csrf_rt_secure]').val();

        if (is_edit === "false") {
            product_uid = rt_config.PRODUCT_ID;
        } else {
            product_uid = $("input[name=edit_product_id]").val();
        }

        function load_uploaded_images(product_uid) {
            $.ajax({
                url: rt_config.SITEURL + 'admin_jsessID/read_uploaded_images/',
                type: "POST",
                data: {uid: product_uid, csrf_rt_secure: csrf},
                dataType: 'json',
                success: function (data) {
                    var opt = '';
                    if (data.length != 0) {
                        for (var i = 0; i < data.length; i++) {

                            opt += '<tr>';
                            opt += '<td><img src="' + rt_config.IMG_ROOT + 'small/' + data[i].image_name + '" /></td>';
                            opt += '<td> upload completed</td>';
                            opt += '<td><span data-value="' + data[i].image_number + '" class=" btn delete-upload btn-danger"> Delete</span></td>';
                            opt += '</tr>';


                        }
                        
                        $('.root-files').show();

                    } else {
                        $('.root-files').hide();
                    }


                    $('#uploadedImges').html(opt);


                }

            });
        }

        $(document).on('click', '.delete-upload', function () {

            var did = $(this).data("value");
            var csrf = $('input[name=csrf_rt_secure]').val();

            $.ajax({
                url: rt_config.SITEURL + 'admin_jsessID/delete_upload_file/',
                type: "POST",
                dataType: 'json',
                data: {id: did, csrf_rt_secure: csrf, uid: product_uid},
                success: function (data) {
                    load_uploaded_images(product_uid);

                    $('.doneImgUpload').html('Image Successfully Deleted.').show();
                    setTimeout(function () {
                        $('.doneImgUpload').hide();
                    }, 5000);



                }

            });

        })



        load_uploaded_images(product_uid);


        $('#doUpload').click(function () {

            var file = $('input[name=userfile]').val();
            var uploadErrors = [];

            if (file === "") {
                $('.errorImgUpload').html('You did not select a file to upload').show();
                uploadErrors.push("no file");
            } else if( $('#w').val() === "" && $('#h').val() ===""){
                $('.errorImgUpload').html('Please Crop Image As You Want').show();
                uploadErrors.push("do crop");
            }else{
                 $('.errorImgUpload').hide();
            }

            if (uploadErrors.length === 0) {
				
				$('#doUpload span').html("Uploading...");


                var formData = new FormData($('#uploads')[0]);

                $.ajax({
                    url: "<?= base_url("admin_jsessID/upload_tmp"); ?>",
                    type: "POST",
                    data: formData,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {

                        if (data === "1") {

                            $('.preview-cc').html('');
                            $('input[name=userfile]').val("");
                            load_uploaded_images(product_uid);
                            $('.doneImgUpload').html('Image Successfully Uploaded.').show();
                            setTimeout(function () {
                                $('.doneImgUpload').hide();
                            }, 5000);

                        } else if (data === "2") {
                            //Upload Image Limit Exceeded.
                            
                            $('.errorImgUpload').html('Upload Image Limit Exceeded.').show();
                            
                            setTimeout(function () {
                                $('.errorImgUpload').hide();
                            }, 5000);
                            
                        }
                        
                        $('#x').val("");
                        $('#y').val("");
                        $('#w').val("");
                        $('#h').val("");
						
						$('#doUpload span').html("Upload Image");

                    }

                });

            }

        });


        $("input[name=userfile]").change(function () {

            //$('.jcrop-holder').remove();

            $('.preview-cc').html('');
            $('.errorImgUpload').hide();






            var opt = '<table cellpadding="0" cellspacing="0" border="0">'
                    + '<tr>'
                    + ' <td style=" max-width: 900px !important">'
                    + ' <img src="#" id="jcrop_target" />'
                    + '</td>'
                    + ' <td>'
                    + '  <div style="width:100px;height:100px;display:none;background:#ddd;overflow:hidden;margin-left:5px;">'
                    + '    <img src="#" id="preview" />'
                    + ' </div>'

                    + '  </td>'
                    + ' </tr>'
                    + ' </table>';

            $('.preview-cc').append(opt);

            readURL(this);



        });







        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    $('#jcrop_target , #preview ').attr('src', e.target.result);



                    $('#jcrop_target').Jcrop({
                        onChange: showPreview,
                        onSelect: updateCoords,
                        onRelease: hidePreview,
                        aspectRatio: 1
                    });

                    function updateCoords(c)
                    {
                        $('#x').val(c.x);
                        $('#y').val(c.y);
                        $('#w').val(c.w);
                        $('#h').val(c.h);
                    }
                    ;

                    var $preview = $('#preview');
                    // Our simple event handler, called from onChange and onSelect
                    // event handlers, as per the Jcrop invocation above
                    function showPreview(coords)
                    {
                        if (parseInt(coords.w) > 0)
                        {
                            var rx = 100 / coords.w;
                            var ry = 100 / coords.h;

                            $preview.css({
                                width: Math.round(rx * 500) + 'px',
                                height: Math.round(ry * 370) + 'px',
                                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                                marginTop: '-' + Math.round(ry * coords.y) + 'px'
                            }).show();
                        }
                    }

                    function hidePreview()
                    {
                        $preview.stop().fadeOut('fast');
                    }




                }

                reader.readAsDataURL(input.files[0]);


            }




        }


    });
</script>