//for status change from manage page
$(document).on('click', '.status', function(event) {
    var show_status=($(this).is(':checked')== true)?1:0;
    var value=$(this).val().split('^');
    var tableName=value[0];
    var ID=value[1];
    $.ajax({
        type: "POST",
        url: AJAX_URL+"changeStatus",
        data: {tableName: tableName,ID: ID,show_status: show_status},
        success: function(result) {	//console.log(result);
        }
    });
});
//end


//for delete data from manage page
$(document).on('click', '.single_delete', function(event) {
    if (confirm("Are you sure want to delete these records?")) {
        $('.action-message').fadeIn();
        var obj=$(this);
        var url=obj.attr('id');
        $.ajax({
            type: "POST",
            url: url,
            success: function(result) {
                myTable.row( $(obj).parents('tr') ).remove().draw();
                $('.action-message').html('<div id="alert_meg" class="col-xs-12 p-8 text-center alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+result+'</div>');
                $(".alert-dismissible").fadeTo(7000, 500).slideUp(1000, function(){
                    $(".alert-dismissible").alert('close');
                });
            }
        });
    }
});
//end

//for delete multiple data from manage page
$(document).on('click', '.bulk_delete', function(event) {
   $('.action-message').fadeIn();
   var checkRows= $('.checkRow:checked');
   var length=checkRows.length;
   var url=$(this).attr('id');
   if(length==0){
       $('.action-message').html('<div id="alert_meg" class="col-xs-12 p-8 text-center alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select at least one record.</div>');
   }
   else{
       if (confirm("Are you sure want to delete these records?")) {
           var url=$(this).attr('id');
           var IDS =checkRows.map(function(){
               myTable.row( $(this).parents('tr') ).remove().draw();
               return $(this).val();
           }).get();
           $.ajax({
               type: "POST",
               url: url,
               data:{IDS : IDS},
               success: function(result) {
                   $('.action-message').html('<div id="alert_meg" class="col-xs-12 p-8 text-center alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+result+'</div>');
                   $('#checkAllRows'). prop("checked", false);
                   $(".alert-dismissible").fadeTo(7000, 500).slideUp(1000, function(){
                       $(".alert-dismissible").alert('close');
                   });
               }
           });
       }
   }
});
// end