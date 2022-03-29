//ajax crud for admin
//create product
$('#createproductform').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },
        success: function(data)
        {
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                console.log(data.data.id);
                $("#datatable tbody").append('<tr id ="row'+data.data.id+'"><td>'+ data.data.name +'</td><td>'+ formatCurrency(data.data.start_price) +'</td><td>'+ ' ' +'</td><td>'+ ' ' +'</td><td>'+ data.data.created_at +'</td><td>'+ data.data.auction_ends + '</td><td>' +
                    '<a href="javascript:void(0)" onclick="editProduct('+data.data.id+')" class="mr-2"><i class="far fa-edit text-info mr-1"></i></a>'+
                    '<a class="deleteproduct" data-toggle="modal" data-target="#deleteproduct" data-id="'+data.data.id+'" data-name="'+data.data.name+'"><i class="far fa-trash-alt text-danger"></i></a>'+
                    '</td></tr>');
                $('#createproduct').modal('hide');
                Swal.fire(
                    'Success!',
                    'Product has been listed',
                    'success'
                )
            }
        }
    })
});

//edit product

function editProduct(id){
    $.get('/admin/editproduct/'+id,function(product){
        $('#id').val(product.data.id);
        $('#name').val(product.data.name);
        $('#description').val(product.data.description);
        $('#start_price').val(product.data.start_price);
        $('#auction_ends').val(product.data.auction_ends);
        $('#editproduct').modal('toggle');
    })
}
$('#updateproductform').on('submit', function(event) {
    event.preventDefault();
    let id = $('#id').val();
    let user_id = $('#user_id').val();
    let name = $('#name').val();
    let description = $('#description').val();
    let start_price = $('#start_price').val();
    let auction_ends = $('#auction_ends').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:{
            id:id,
            user_id:user_id,
            name:name,
            description:description,
            start_price:start_price,
            auction_ends:auction_ends,
        },
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },
        success: function(data)
        {
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }
            else{
                console.log(data);
                $('#row'+ data.data.id + ' td:nth-child(1)').text(data.data.name);
                $('#row'+ data.data.id + ' td:nth-child(2)').text(formatCurrency(data.data.start_price));
                $('#row'+ data.data.id + ' td:nth-child(5)').text(data.data.created_at);
                $('#row'+ data.data.id + ' td:nth-child(6)').text(data.data.auction_ends);
                $('#editproduct').modal('hide');
                Swal.fire(
                    'Success!',
                    'Product has been updated',
                    'success'
                )
            }
        }
    })
});
//
// //delete product
//
$('.deleteproduct').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var delId = button.data('id')
    var name = button.data('name')
    var modal = $(this)

    modal.find('.modal-content #productid').val(delId);
    modal.find('.modal-body').html('<h1>You are about to delete product '+name+'<br> Are you sure?</h1>');
})
$('#deleteproductform').on('submit', function(event) {
    event.preventDefault();
    let id = $('#productid').val();
    let _token = $("input[name=_token]").val();
    $.ajax({
        url: '/admin/productdelete/'+id,
        type:'DELETE',
        data:{
            id:id,
            _token:_token
        },
        success:function(response){
            $('#row'+id).remove();
            $('#deleteproduct').modal('hide');
            Swal.fire(
                'Success!',
                'Product has been deleted',
                'success'
            )
        }
    });
});

$('#addfundsform').on('submit', function(event) {
    event.preventDefault();
    let balance = $('#balance').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:{
            balance:balance,
        },
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },
        success: function(data)
        {
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }
            else{
                $("#myBalance").text(formatCurrency(data));
            }
        }
    })
});
function formatCurrency(total) {
    var neg = false;
    if(total < 0) {
        neg = true;
        total = Math.abs(total);
    }
    return (neg ? "-$" : '$') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}

function sendMarkRequest(id = null) {
    let _token = $("input[name=_token]").val();
    return $.ajax("/readNotification", {
        method: 'POST',
        data: {
            _token:_token,
            id
        }
    });
}
$(function() {
    $('#read_all').click(function() {
        let request = sendMarkRequest();
        request.done(() => {
            $('div.alert').remove();
            $('#read_all').remove();
        })
    });
});
