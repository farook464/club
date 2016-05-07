<?php
/*
 *  RETAILGENIUS.COM - Team Innovation
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>


</head>
<body style="margin-top: 20px; background-color: black;">
    <!-- Site wrapper -->
    <div class="wrapper" style="min-height:0% !important ;">
        <?php $this->load->view("template/nav") ?>

    </div>

    <script>
        $(document).ready(function () {
            reserveTable(0, 0, -1);
            remainingTime = 0;
            $('.updateTime').hide();
            $('#updateTable').hide();
            $('.resume').hide();
            $('.stop').click(function () {
                $('#bookTable').show();
                $('#updateTable').hide();
                id = this.id.split('_');
                id = id[1];
                reserveTable(0, 0, id);
                $('#widget_' + id).css('background-color', '#536DFE');
                $('.nav-tabs').show();
                $('.tab-content').show();
            });
            $('.pause').click(function () {
                id = this.id.split('_');
                id = id[1];
                $('#pause_' + id).hide();
                $('#resume_' + id).show();
                $('#clock_' + id).countdown('pause');
                $('#widget_' + id).css('background-color', '#536DFE');
            });
            $('.resume').click(function () {
                id = this.id.split('_');
                id = id[1];
                $('#resume_' + id).hide();
                $('#pause_' + id).show();
                $('#clock_' + id).countdown('start');
                $('#widget_' + id).css('background-color', '#03A9F4');
            });
            $('.addTime').click(function () {
                id = this.id.split('_');
                id = id[1];
                if ($('#isupdate_' + id).val() !== '1') {
                    $('#bookTable').show();
                    $('#updateTable').hide();
                    $('.nav-tabs').show();
                    $('.tab-content').show();
                }

                $('#addTimeModal').modal('show');
            });
            $('#bookTable').click(function () {
                $('#isupdate_' + id).val(1);
                $('#addTime_' + id).hide();
                $('#updateTime_' + id).show();
                var memType = $('#selMemType').val();
                var cusID = $('#bookMemId').val();
                var existCus = 0;
                if (cusID > 1) {
                    existCus = 1;
                }
                else {
                    var cusName = $('#memName').val();
                    var phone = $('#memPhone').val();
                    var OtherNo = $('#memOtherNo').val();
                }


                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: "<?php echo base_url('home/playTable'); ?>",
                    data: {memType: memType, cusID: cusID, tableID: parseInt(id) + 1, existCus: existCus, cusName: cusName, phone: phone, OtherNo: OtherNo},
                    success: function (result) {
//                        console.log(result.cusID);
                        if (result.cusID) {
                            $('#bookMemId').val(result.cusID);
                        }
//                        console.log($('#bookMemId').val());
                        $('#updatePlayTable').val(result);
                        $('#widget_' + id).css('background-color', '#03A9F4');
                        reserveTable(parseInt($('#hrs').val()), parseInt($('#mnts').val()), id);
                    }
                });
            });
            $('.updateTime').click(function () {
                id = this.id.split('_');
                id = id[1];
                if ($('#isupdate_' + id).val() === '1') {
                    $('#bookTable').hide();
                    $('#updateTable').show();
                    $('.nav-tabs').hide();
                    $('.tab-content').hide();
                }
                $('#addTimeModal').modal('show');
            });
            $('#updateTable').click(function () {

                var memType = $('#selMemType').val();
                var cusID = $('#bookMemId').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: "<?php echo base_url('home/playTable'); ?>",
                    data: {memType: memType, cusID: cusID, tableID: parseInt(id) + 1},
                    success: function (result) {
                        $('#updatePlayTable').val(result);
                        UpdateTable(parseInt($('#hrs').val()), parseInt($('#mnts').val()), id);
                    }
                });
            });
        });
        function UpdateTable(hr, min, id) {
            var fixDate = function (date) {
                return date < 10 ? "0" + date : date;
            };
            var dateStr = new Date();
            currentDate = dateStr.getFullYear() + "/" + fixDate(dateStr.getMonth() + 1) + "/" + fixDate(dateStr.getDate());
            currentTime = fixDate(dateStr.getHours('hh')) + ":" + fixDate(dateStr.getMinutes('mm')) + ":" + fixDate(dateStr.getSeconds('ss'));
            //add extra time to remaining time
            rt = remainingTime.split(':');
            dateStr.setHours(parseInt(rt[0]));
            dateStr.setMinutes(parseInt(rt[1]));
            dateStr.setSeconds(parseInt(rt[2]));
            updatedTime = fixDate(dateStr.getHours('hh') + hr) + ":" + fixDate(dateStr.getMinutes('mm') + min) + ":" + fixDate(dateStr.getSeconds('ss'));
            remainingTime = updatedTime;
          
            if (id > -1) {
                $('#clock_' + id).countdown(currentDate + ' ' + updatedTime)
                        .on('update.countdown', function () {
                        })
                        .on('finish.countdown', function () {
                            $('#updateTime_' + id).hide();
                            $('#addTime_' + id).show();
                            $('#widget_' + id).css('background-color', '#F44336');
//                            $('.nav-tabs').show();
//                            $('.tab-content').show();
                            $('#bookMemId').val(0);
                        });
            }
            else {
                $('.clock').countdown(currentDate + ' ' + remainingTime, function (event) {
                    $(this).html(event.strftime('%H:%M:%S'));
                });
            }
        }

        function reserveTable(hr, min, id) {

            var fixDate = function (date) {
                return date < 10 ? "0" + date : date;
            };
            var dateStr = new Date();
            currentDate = dateStr.getFullYear() + "/" + fixDate(dateStr.getMonth() + 1) + "/" + fixDate(dateStr.getDate());
            currentTime = fixDate(dateStr.getHours('hh')) + ":" + fixDate(dateStr.getMinutes('mm')) + ":" + fixDate(dateStr.getSeconds('ss'));
            remainingTime = fixDate(dateStr.getHours('hh') + hr) + ":" + fixDate(dateStr.getMinutes('mm') + min) + ":" + fixDate(dateStr.getSeconds('ss'));
            
            console.log(currentDate + ' ' + remainingTime);
        
        if (id > -1) {
                $('#clock_' + id).countdown(currentDate + ' ' + remainingTime, function (event) {
                    $(this).html(event.strftime('%H:%M:%S'))
                })
                        .on('finish.countdown', function (event) {
                            $('#updateTime_' + id).hide();
                            $('#addTime_' + id).show();
                            $('#widget_' + id).css('background-color', '#F44336');
//                            $('.nav-tabs').show();
//                            $('.tab-content').show();
                            $('#bookMemId').val(0);
                        });
            }
            else {
                $('.clock').countdown(currentDate + ' ' + remainingTime, function (event) {
                    $(this).html(event.strftime('%H:%M:%S'));
                });
            }
        }

        $(document).on('change', '#selMemType', function () {
            var memID = $('#selMemType').val();
            var hr = $('#' + memID + '').data('hr');
            var min = $('#' + memID + '').data('min');
            var price = $('#' + memID + '').data('price');
            $('#hrs').val(hr);
            $('#mnts').val(min);
            $('#memPrice').html("");
            $('#memPrice').append('<span style = "color:#F44336; font-size:30px; margin-left:40px;"> Rs: ' + price + '</span>');
        });
        $(document).on('click', '#searchMem', function () {
            var searchElem = $('#memSearch').val();
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url('home/searchMember'); ?>",
                data: {searchElem: searchElem},
                success: function (result) {
                    $('#showExistMemName').html("");
                    if (result.length > 0) {
                        var memName = result[0].name;
                        $('#bookMemId').val(result[0].id);
                        $('#showExistMemName').append('<span style = "color:#F44336; font-size:30px; float:left;">' + memName + '</span>');
                    }
                    else {
                        $('#bookMemId').val(0);
                        $('#showExistMemName').append('<span style = "color:#F44336; font-size:16px; float:left;"> No records found! </span>');
                    }

                }
            });
            return false;
        });
    </script>


    <div class="container" style="width: 100%;">
        <?php for ($i = 0; $i < sizeof($tables); $i++) { ?>
            <div class="col-md-12" id='<?php echo 'widget_' . $i ?>' style="height: 300px; width: 100%; background-color: #536DFE ; margin-top: 15px;">
                <input type="hidden" id="<?php echo 'isupdate_' . $i ?>">
                <div class="col-md-4" style="height: 300px; border-right: 1px solid #ddd; font-size: 80px; color: #fff;">             
                    <?php echo $tables[$i]["name"]; ?>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <span class="clock" id="<?php echo'clock_' . $i ?>" style="color: #fff; font-size: 80px; float: right;"></span>
                    </div>
                    <div class="col-md-12">

                        <div class="col-md-3 addTime" id="<?php echo'addTime_' . $i ?>"> 
                            <i class="fa fa-plus" style="font-size: 80px; color: #fff; cursor: pointer; margin-top: 60px;"></i>
                            <BR>
                            <span style="font-size: 20px; color: #fff; cursor: pointer; margin-left: 20px;">ADD</span>
                        </div> 
                        <div class="col-md-3 updateTime" id="<?php echo 'updateTime_' . $i ?>"> 
                            <i class="fa fa-plus" style="font-size: 80px; color: #fff; cursor: pointer; margin-top: 60px;"></i>
                            <BR>
                            <span style="font-size: 20px; color: #fff; cursor: pointer; ">ADD MORE..</span>
                        </div> 
                        <div class="col-md-3 pause" id="<?php echo 'pause_' . $i ?>"> 
                            <i class="fa fa-pause-circle-o" style="font-size: 80px; color: #fff; cursor: pointer; margin-top: 60px;"></i>
                            <BR>
                            <span style="font-size: 20px; color: #fff; cursor: pointer; margin-left: 15px;">PAUSE</span>
                        </div>  
                        <div class="col-md-3 resume" id="<?php echo 'resume_' . $i ?>"> 
                            <i class="fa fa-play-circle-o" style="font-size: 80px; color: #fff; cursor: pointer; margin-top: 60px;"></i>
                            <BR>
                            <span style="font-size: 20px; color: #fff; cursor: pointer; margin-left: 5px;">RESUME</span>
                        </div>  
                        <div class="col-md-3 stop"  id="<?php echo 'stop_' . $i ?>"> 
                            <i class="fa fa-stop-circle-o" style="font-size: 80px; color: #fff; cursor: pointer; margin-top: 60px;"></i>
                            <BR>
                            <span style="font-size: 20px; color: #fff; cursor: pointer; margin-left: 15px;">STOP</span>
                        </div>  

                    </div>  
                </div>
            </div>
        <?php } ?>

        <!-------------------------------------------------MODAL --------------------------------------------------------------------------->

        <div id="addTimeModal" class="modal fade in" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="background-color: black;  color: #fff; opacity: 0.9;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" style="color: #F44336;">&times;</button>
                        <h4 class="modal-title">Select Package</h4>
                    </div>
                    <div class="modal-body" style="height: 550px;">
                        <div class="col-md-12">
                            <ul class="nav  nav-tabs responsive col-md-12">
                                <li class="active col-md-6"><a data-toggle="pill" href="#newMem">New Member</a></li>
                                <li class="col-md-6"><a data-toggle="pill" href="#exstMem">Existing Member</a></li>
                            </ul>
                            <div class="tab-content responsive col-md-12">
                                <div id="newMem" class="tab-pane fade in active col-md-6" style="margin-top: 10px; min-height: 220px;">
                                    <div class="form-group col-md-12">
                                        <label for="memName" style="float: left;">Name:</label>
                                        <br>
                                        <input type="text" id="memName" name="memName" class="form-control" style="color:black; float: left;">

                                    </div>
                                    <div class="form-group col-md-12"
                                         <label for="memPhone" style="float: right;">Phone:</label>
                                        <br>
                                        <input type="int" maxlength="10" placeholder="07XXXXXXXX" id="memPhone" name="memPhone" class="form-control" style="color:black; float: left;">

                                    </div>
                                    <div class="form-group col-md-12">

                                        <label for="memOtherNo" style="float: left;">Other No:</label>
                                        <br>
                                        <input type="int" maxlength="10" placeholder="XXXXXXXXXX" id="memOtherNo" name="memOtherNo" class="form-control" style="color:black; float: left;">

                                    </div>
                                </div>
                                <div id="exstMem" class="tab-pane fade in col-md-offset-6 col-md-6" style="margin-top: 10px; min-height: 220px;">
                                    <div class="form-group col-md-12">

                                        <label for="memSearch" style="float: left;">Search:</label>
                                        <br>
                                        <input type="text" maxlength="10" placeholder="Search.." id="memSearch" name="memSearch" class="form-control" style="color:black; float: left;">
                                        <span style="float: right; margin-top: 10px; margin-bottom: 10px;" class="btn btn-primary" id="searchMem" >Search</span>
                                        <div id="showExistMemName"></div>
                                        <input type="hidden" id="bookMemId">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-md-12">

                            <div class="col-md-3" >
                                <label for="usr" style="float: right;">Membership:</label>
                            </div>
                            <div class="col-md-4">
                                <select id="selMemType" class="form-control col-md-4 ">
                                    <option value="0"> Select</option>
                                    <?php
                                    for ($i = 0; $i < sizeof($mem_types); $i++) {
                                        echo ' <option class="memVal" id=' . $mem_types[$i]["id"] . ' value=' . $mem_types[$i]["id"] . ' data-hr =' . $mem_types[$i]["hours"] . ' data-min =' . $mem_types[$i]["minutes"] . ' data-price =' . $mem_types[$i]["price"] . '>' . $mem_types[$i]["name"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="memPrice">

                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-3">
                                <label for="hrs" style="float: right;">Hours:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="hrs" name="hrs" class="form-control" style="color:black;" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-3">
                                <label for="mnts" style="float: right;">Minutes:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="mnts" name="mnts" class="form-control"  style="color:black;" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span style="float: right;" class="btn btn-primary " id="bookTable" data-dismiss="modal">Book</span>
                            <span style="float: right;" class="btn btn-primary" id="updateTable" data-dismiss="modal">Update</span>
                            <input type="hidden" id="updatePlayTable">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-------------------------------------------------END OF MODAL --------------------------------------------------------------------------->




    </div>
