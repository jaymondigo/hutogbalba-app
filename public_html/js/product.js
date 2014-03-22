baseUrl = $('[base-url]').attr('base-url');

$(document).on('click', '#addProduct', function() {
    $.get(baseUrl + '/product/create', function(data) {
        $('[add-product]').html(data);
    });
});

$(document).on('click', '[edit-product]', function() {
    id = $(this).attr('edit-product');
    $.get(baseUrl + '/product/' + id + '/edit', function(data) {
        console.log(data);
        $('[data-edit-product]').html(data);
    });
});

$(document).on('click', '.deleteProduct', function() {
    id = $(this).attr('product-id');
    $.get(baseUrl + '/product/delete/' + id, function(data) {
        $('[delete-con-modal]').html(data);
    });
});

$(document).on('click', '[view-product]', function() {
    id = $(this).attr('view-product');
    $.get(baseUrl + '/product/' + id, function(data) {
        $('[view-product-con]').html(data);
    });
});
// $(document).on('submit', '#addProductForm', function() {
//     alert('submit data');
//     $data = $(this).searialize();
//     $.post(baseUrl + 'product', data, function(data) {
//         console.log(data);
//     });
// });
// function submitAddProduct() {
//     data = {
//         name: $('input[name="name"]').val(),
//         productID: $('input[name="productID"]').val(),
//         type: $('select[name="type"]').val(),
//         vendor: $('select[name="vendor"]').val(),
//         availability: $('select[name="availability"]').val(),
//         price: $('input[name="price"]').val()
//     }

//     $.post(baseUrl + '/product', data, function(data) {
//         console.log(data);
//         document.location.href = baseUrl + '/product';
//     });
// }

// function updateProduct() {
//     data = {
//         id: $('[name="id"]').val(),
//         name: $('input[name="name"]').val(),
//         productID: $('input[name="productID"]').val(),
//         type: $('select[name="type"]').val(),
//         vendor: $('select[name="vendor"]').val(),
//         availability: $('select[name="availability"]').val(),
//         price: $('input[name="price"]').val()
//     }

//     $.post(baseUrl + '/product', data, function(data) {
//         console.log(data);
//         document.location.href = baseUrl + '/product';
//     });
// }

// function deleteProduct() {
//     id = $('[name="id"]').val();
//     $.delete(baseUrl + '/product/' + id, {
//         id: id
//     }, function(data) {
//         console.log(data);
//     });
// }